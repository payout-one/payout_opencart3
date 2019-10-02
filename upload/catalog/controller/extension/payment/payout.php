<?php
/*
 * The MIT License
 *
 * Copyright (c) 2019 Payout, s.r.o. (https://payout.one/)
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

// Load Payout API Client PHP Library
require_once(DIR_SYSTEM . 'library/Payout/init.php');
use Payout\Client;

/**
 * Class ControllerExtensionPaymentPayout
 *
 * The Payout payment module for OpenCart 3
 * Catalog controller.
 * https://postman.payout.one/
 *
 * @copyright  2019 Payout, s.r.o.
 * @author     Neotrendy s. r. o.
 * @link       https://github.com/payout-one/payout_opencart3
 */
class ControllerExtensionPaymentPayout extends Controller {
    protected $payout, $payout_config, $payout_error;

    public function __construct($registry)
    {
        parent::__construct($registry);

        $this->payout_config = unserialize($this->config->get('payment_payout_config'));

        try {
            // Config Payout API Client PHP Library
            $config = array(
                'client_id' => $this->config->get('payment_payout_client_id'),
                'client_secret' => $this->config->get('payment_payout_client_secret'),
                'sandbox' => $this->config->get('payment_payout_sandbox')
            );

            // Initialize Payout API Client PHP Library
            $this->payout = new Client($config);
        } catch (Exception $e) {
            $this->payout_error = $e->getMessage();
        }
    }

    public function index()
    {
        $this->load->language('extension/payment/payout');

        $data['text_license'] = sprintf($this->language->get('text_license'), date('Y'));
        $data['text_testmode'] = $this->language->get('text_testmode');
        $data['button_confirm'] = $this->language->get('button_confirm');

        $data['testmode'] = $this->config->get('payment_payout_sandbox');

        $this->load->model('checkout/order');

        $order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);

        if ($order_info && $this->payout) {
            try {
                $data['payout_php_ver'] = $this->payout->getLibraryVersion();
                $data['payout_oc_ver'] = $this->payout_config['version'];
            } catch (Exception $e) {
                $data['payout_error'] = $e->getMessage();
            }

            $data['checkout_url'] = $this->config->get('config_url');
            $data['checkout_route'] = $this->payout_config['routes']['checkout'];
        } else {
            $data['payout_error'] = $this->payout_error;
        }

        return $this->load->view('extension/payment/payout', $data);
    }

    public function checkout()
    {
        $this->load->model('checkout/order');

        $order_id = $this->session->data['order_id'];
        $order_info = $this->model_checkout_order->getOrder($order_id);

        if ($order_info && $order_info['order_status_id'] == 0)  {
            $checkout_data = array(
                'amount' => $this->currency->format($order_info['total'], $order_info['currency_code'], false, false),
                'currency' => $order_info['currency_code'],
                'customer' => [
                    'first_name' => $order_info['firstname'],
                    'last_name' =>  $order_info['lastname'],
                    'email' =>  $order_info['email']
                ],
                'external_id' => $order_id,
                'redirect_url' => $this->url->link('checkout/success')
            );

            try {
                $response = $this->payout->createCheckout($checkout_data);

                if (isset($response->checkout_url) && isset($response->external_id) && $response->external_id == $order_id) {
                    if ($this->config->get('payment_payout_debug')) {
                        $this->log->write('Payout :: CHECKOUT: Order ID = ' . $order_id . '; Checkout status: ' . $response->status);
                    }

                    if ($response->status == 'expired') {
                        $this->model_checkout_order->addOrderHistory($order_id, $this->config->get('payment_payout_expired_status_id'));

                        header('Location: ' . $this->url->link('checkout/checkout'));
                    } else {
                        $this->model_checkout_order->addOrderHistory($order_id, $this->config->get('payment_payout_processing_status_id'));

                        header('Location: ' . $response->checkout_url);
                    }
                }
            } catch (Exception $e) {
                $result = $e->getMessage();

                $this->log->write('Payout :: WARNING: Payment failed! Result = ' . $result . '; Order ID = ' . $order_id);

                $this->language->load('extension/payment/payout');

                $this->session->data['error'] = sprintf($this->language->get('error_payment'), $result);

                header('Location: ' . $this->url->link('checkout/checkout'));
            }

            die();
        }
    }

    public function notification()
    {
        $notification = json_decode(file_get_contents('php://input'));

        if (isset($notification->external_id) && isset($notification->data->status)) {
            if (!$this->payout->verifySignature(array($notification->external_id, $notification->type, $notification->nonce), $notification->signature)) {
                $this->log->write('Payout :: WARNING: Invalid signature in API notification.');
                die();
            }

            $this->load->model('checkout/order');

            $order_info = $this->model_checkout_order->getOrder($notification->external_id);

            if ($notification->data->status == 'succeeded' || $notification->data->status == 'successful') {
                $order_status_id = $this->config->get('payment_payout_success_status_id');
            } elseif ($notification->data->status == 'expired') {
                $order_status_id = $this->config->get('payment_payout_expired_status_id');
            } elseif ($notification->data->status == 'in_transit' || $notification->data->status == 'processing') {
                $order_status_id = $this->config->get('payment_payout_processing_status_id');
            } elseif ($notification->data->status == 'failed') {
                $order_status_id = $this->config->get('payment_payout_failed_status_id');
            } else {
                $order_status_id = $this->config->get('config_order_status_id');
            }

            // Update order history if order status is not complete and notify customer.
            if ($order_info['order_status_id'] !=  $this->config->get('config_complete_status_id')) {
                $notify = $this->config->get('payment_payout_notify') ? true : false;

                $this->model_checkout_order->addOrderHistory($notification->external_id, $order_status_id, '', $notify);
                if ($this->config->get('payment_payout_debug')) {
                    $this->log->write('Payout :: UPDATE: Order ID = ' . $notification->external_id . '; New Order Status ID = ' . $order_status_id);
                }
            } else {
                $this->log->write('Payout :: WARNING: Trying to edit completed order! Order ID = ' . $notification->external_id . '; New Order Status ID = ' . $order_status_id);
            }
        }

        if ($this->config->get('payment_payout_debug') && isset($notification->data)) {
            $this->log->write('Payout :: NOTIFICATION: ' . json_encode($notification->data));
        }
    }
}
