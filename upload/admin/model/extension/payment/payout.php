<?php
class ModelExtensionPaymentPayout extends Model {
    public function getMethod($address, $total) {
        $this->load->language('extension/payment/paymate');

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone_to_geo_zone WHERE geo_zone_id = '" . (int)$this->config->get('payment_paymate_geo_zone_id') . "' AND country_id = '" . (int)$address['country_id'] . "' AND (zone_id = '" . (int)$address['zone_id'] . "' OR zone_id = '0')");

        if ($this->config->get('payment_paymate_total') > 0 && $this->config->get('payment_paymate_total') > $total) {
            $status = false;
        } elseif (!$this->config->get('payment_paymate_geo_zone_id')) {
            $status = true;
        } elseif ($query->num_rows) {
            $status = true;
        } else {
            $status = false;
        }

        $currencies = array(
            'AUD',
            'NZD',
            'USD',
            'EUR',
            'GBP'
        );

        if (!in_array(strtoupper($this->session->data['currency']), $currencies)) {
            $status = false;
        }

        $method_data = array();

        if ($status) {
            $method_data = array(
                'code'       => 'paymate',
                'title'      => $this->language->get('text_title'),
                'terms'      => '',
                'sort_order' => $this->config->get('payment_paymate_sort_order')
            );
        }

        return $method_data;
    }

    public function getPayoutOrderId($orderId) {

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_payout WHERE id = '" . (int)$orderId . "'");

        if (count($query->rows) >0 && $query->rows[0]) return $query->rows[0]['payout_id'];

        return null;
    }

    public function addPayoutOrderId($orderId, $payoutId) {
        $sql = "INSERT INTO `" . DB_PREFIX . "order_payout` (id, payout_id) VALUES ('". $orderId ."','". $payoutId ."')";

        $this->db->query($sql);
    }

    public function updateOrderStatus($order_id, $order_status_id, $comment) {
		$this->db->query("UPDATE `" . DB_PREFIX . "order` SET `order_status_id` = '" . (int)$order_status_id . "', `date_modified` = NOW() WHERE `order_id` = '" . (int)$order_id . "'");

		$this->db->query("INSERT INTO `" . DB_PREFIX . "order_history` SET `order_id` = '" . (int)$order_id . "', `order_status_id` = '" . (int)$order_status_id . "', `notify` = '0', `comment` = '" . $this->db->escape($comment) . "', `date_added` = NOW()");
	}

    public function install() {
        $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "order_payout` (
          `id` int(11) NOT NULL,
          `payout_id` int(11) NOT NULL
		) ENGINE=InnoDB DEFAULT CHARSET=utf8");
    }

    public function uninstall() {
        $this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "order_payout`");

    }
}
