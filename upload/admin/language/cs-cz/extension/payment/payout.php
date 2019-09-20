<?php
// Heading
$_['heading_title']             = 'Payout';
$_['text_extension']            = 'Rozšíření';
$_['text_edit']                 = 'Upravit Payout';
$_['text_success']              = 'Modul Payout byl úspěšně upraven!';
$_['error_permission']          = 'Upozornění: Nemáte oprávnění ke změnám platebního mudulu Payout!';
$_['text_payout']               = '<a href="https://payout.one/" title="Payout" target="_blank"><img src="view/image/payment/payout.png" alt="Payout" style="border: 1px solid #EEEEEE;" /></a>';

// Tabs
$_['tab_general']               = 'Obecné';
$_['tab_order_statuses']        = 'Stavy objednávek';
$_['tab_about']                 = 'O modulu';

// General
$_['entry_client_id']           = 'Číslo účtu';
$_['help_client_id']            = 'ID účtu obchodníka (client_id) přiřazeny systémem Payout';
$_['error_client_id']           = 'Číslo účtu je povinný údaj!';
$_['entry_client_secret']       = 'Tajný klíč';
$_['help_client_secret']        = 'Tajný klíč (client_secret) přiřazen systémem Payout';
$_['error_client_secret']       = 'Klíč je povinný údaj!';
$_['entry_test']                = 'Testovací provoz:';
$_['help_test']                 = '(Sandbox Mode) Používat testovací server brány pro zpracování transakcí';
$_['entry_debug']               = 'Režim ladění:';
$_['help_debug']                = 'Zaznamenávat doplňující informace do Systém > Maintenance > Chybové protokoly';
$_['entry_total']               = 'Celkem';
$_['help_total']                = 'Modul Payout se stane aktivním, když objednávka dosáhne tuto částku';
$_['entry_geo_zone']            = 'Geo zóna:';
$_['entry_status']              = 'Stav:';
$_['entry_sort_order']          = 'Řazení';
$_['text_notification_url']     = 'Notification URL:';

// Order Statuses
$_['entry_processing_status']   = 'Probíhající stav:';
$_['help_processing_status']    = '(Processing Status) Payment is processing';
$_['entry_success_status']      = 'Úspešný stav:';
$_['help_success_status']       = '(Success Status) Payment was successfully processed';
$_['entry_expired_status']      = 'Expired Status:';
$_['help_expired_status']       = '(Expired Status) Payment has expired';
$_['entry_cancelled_status']    = 'Zrušený stav:';
$_['help_cancelled_status']     = '(Cancelled Status) The customer has cancelled payment';
$_['entry_failed_status']       = 'Stav selhání:';
$_['help_failed_status']        = '(Failed Status) Requires payment_method, action, authorization, capture';
$_['entry_notify']              = 'Upozornění zákazníka:';

// About
$_['text_title']                = 'Payout platební modul pro OpenCart';
$_['text_version']              = 'Verze:';
$_['info_version']              = ' <i class="fa fa-exclamation-triangle text-warning" data-toggle="tooltip" data-placement="right" title="Tato verze modulu pravděpodobně není kompatibilní s vaší verzí OpenCart!"></i>';
$_['text_compatibility']        = 'Kompatibilita:';
$_['info_compatibility']        = 'OpenCart - %s<br>Payout - <a href="https://postman.payout.one/" title="Payout API" target="_blank">API</a>';
$_['text_documentation']        = 'Dokumentace:';
$_['info_documentation']        = '<a href="https://github.com/payout-one/payout_opencart3" title="Payout payment module for OpenCart 3" target="_blank">https://github.com/payout-one/payout_opencart3</a>';
$_['text_license']              = 'Licence:';
$_['info_license']              = 'Tento software s otevřeným zdrojovým kódem je licencován na základě MIT licence.<br>Copyright &copy; 2019-%d <a href="https://payout.one/" title="Payout, s.r.o." target="_blank">Payout, s.r.o.</a>';
