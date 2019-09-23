<?php
// Heading
$_['heading_title']             = 'Payout';
$_['text_extension']            = 'Extensions';
$_['text_edit']                 = 'Edit Payout';
$_['text_success']              = 'Success: You have modified Payout payment module settings!';
$_['error_permission']          = 'Warning: You do not have permission to modify Payout payment module!';
$_['text_payout']               = '<a href="https://payout.one/" title="Payout" target="_blank"><img src="view/image/payment/payout.png" alt="Payout" style="border: 1px solid #EEEEEE;" /></a>';

// Tabs
$_['tab_general']               = 'General';
$_['tab_order_statuses']        = 'Order Statuses';
$_['tab_about']                 = 'About';

// General
$_['entry_client_id']           = 'API Key ID';
$_['help_client_id']            = 'The API Key ID generated in your Payout Banking under Developers > API Keys > Generate a new key';
$_['error_client_id']           = 'API Key ID is required!';
$_['entry_client_secret']       = 'API Secret';
$_['help_client_secret']        = 'The Secret generated with your API Key in Payout Banking under Developers > API Keys > Generate a new key';
$_['error_client_secret']       = 'API Secret is required!';
$_['entry_test']                = 'Sandbox Mode:';
$_['help_test']                 = 'Use the testing gateway server to process transactions';
$_['entry_debug']               = 'Debug Mode:';
$_['help_debug']                = 'Logs additional information to the System > Maintenance > Error Logs';
$_['entry_total']               = 'Total';
$_['help_total']                = 'The checkout total the order must reach before this payment method becomes active';
$_['entry_geo_zone']            = 'Geo Zone:';
$_['entry_status']              = 'Status:';
$_['entry_sort_order']          = 'Sort Order';
$_['text_notification_url']     = 'Notification URL:';

// Order Statuses
$_['entry_processing_status']   = 'Processing Status:';
$_['help_processing_status']    = 'Payment is processing';
$_['entry_success_status']      = 'Success Status:';
$_['help_success_status']       = 'Payment was successfully processed';
$_['entry_expired_status']      = 'Expired Status:';
$_['help_expired_status']       = 'Payment has expired';
$_['entry_cancelled_status']    = 'Cancelled Status:';
$_['help_cancelled_status']     = 'The customer has cancelled payment';
$_['entry_failed_status']       = 'Failed Status:';
$_['help_failed_status']        = 'Requires payment_method, action, authorization, capture';
$_['entry_notify']              = 'Notify Customer:';

// About
$_['text_title']                = 'Payout payment module for OpenCart';
$_['text_version']              = 'Version:';
$_['info_version']              = ' <i class="fa fa-exclamation-triangle text-warning" data-toggle="tooltip" data-placement="right" title="This module version is probably not compatible with your OpenCart version!"></i>';
$_['text_compatibility']        = 'Compatibility:';
$_['info_compatibility']        = 'OpenCart - %s<br>Payout - <a href="https://postman.payout.one/" title="Payout API" target="_blank">API</a>';
$_['text_documentation']        = 'Documentation:';
$_['info_documentation']        = '<a href="https://github.com/payout-one/payout_opencart3" title="Payout payment module for OpenCart 3" target="_blank">https://github.com/payout-one/payout_opencart3</a>';
$_['text_license']              = 'License:';
$_['info_license']              = 'This open-source software is licensed under the MIT License.<br>Copyright &copy; 2019-%d <a href="https://payout.one/" title="Payout, s.r.o." target="_blank">Payout, s.r.o.</a>';
