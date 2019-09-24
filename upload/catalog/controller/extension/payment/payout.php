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
    protected $payout_config;

    public function index() {
        $this->load->language('extension/payment/payout');

        $data['text_license'] = sprintf($this->language->get('text_license'), date("Y"));
        $data['text_testmode'] = $this->language->get('text_testmode');
        $data['button_confirm'] = $this->language->get('button_confirm');

        $data['testmode'] = $this->config->get('payment_payout_test');

        $this->loadConfiguration();

        $this->load->model('checkout/order');

        $order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);

        if ($order_info) {
            $checkout_data = array(
                "amount" => $this->currency->format($order_info['total'], $order_info['currency_code'], false, false),
                "currency" => $order_info['currency_code'],
                "customer" => [
                    "first_name" => $order_info['firstname'],
                    "last_name" =>  $order_info['lastname'],
                    "email" =>  $order_info['email']
                ],
                "external_id" => $this->session->data['order_id'],
                "redirect_url" => $this->url->link($this->payout_config['routes']['redirect'], '', true)
            );

            // Config Payout API Client PHP Library
            $config = array(
                'client_id' => $this->config->get('payment_payout_client_id'),
                'client_secret' => $this->config->get('payment_payout_client_secret')
            );

            try {
                $payout = new Client($config);
                $data['payout_php_ver'] = $payout->getLibraryVersion();
                $data['payout_oc_ver'] = $this->payout_config['version'];

                $response = $payout->createCheckout($checkout_data);
                print_r($response);
            } catch (Exception $e) {
                $data['payout_error'] = $e->getMessage();
            }

            return $this->load->view('extension/payment/payout', $data);
        }
    }

    private function loadConfiguration() {
        $this->payout_config = unserialize($this->config->get('payment_payout_config'));
    }

    public function redirect() {
        // TODO handle checkout response
        header("Location: " . $this->url->link('checkout/success'));
        die();
    }

    public function notification() {
        // TODO handle checkout notification
    }
}
