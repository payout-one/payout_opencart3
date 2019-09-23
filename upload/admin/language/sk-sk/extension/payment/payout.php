<?php
// Heading
$_['heading_title']             = 'Payout';
$_['text_extension']            = 'Rozšírenia';
$_['text_edit']                 = 'Upraviť Payout';
$_['text_success']              = 'Modul Payout bol úspešne upravený!';
$_['error_permission']          = 'Upozornenie: Nemáte oprávnenie k zmenám platobného mudulu Payout!';
$_['text_payout']               = '<a href="https://payout.one/" title="Payout" target="_blank"><img src="view/image/payment/payout.png" alt="Payout" style="border: 1px solid #EEEEEE;" /></a>';

// Tabs
$_['tab_general']               = 'Všeobecné';
$_['tab_order_statuses']        = 'Stavy objednávok';
$_['tab_about']                 = 'O module';

// General
$_['entry_client_id']           = 'API Kľúč';
$_['help_client_id']            = 'API kľúč vygenerovaný vo vašom Payout Banking v časti Vývojári > API Kľúče > Generovať nový kľúč';
$_['error_client_id']           = 'API Kľúč je povinný údaj!';
$_['entry_client_secret']       = 'API Tajomstvo';
$_['help_client_secret']        = 'Tajomstvo vygenerované spolu s vašim API kľúčom vo vašom Payout Banking v časti Vývojári > API Kľúče > Generovať nový kľúč';
$_['error_client_secret']       = 'API Tajomstvo je povinný údaj!';
$_['entry_test']                = 'Testovacia prevádzka:';
$_['help_test']                 = '(Sandbox Mode) Používať testovací server brány pre spracovanie transakcií';
$_['entry_debug']               = 'Režim ladenia:';
$_['help_debug']                = 'Zaznamenávať doplňujúce informácie do Systém > Maintenance > Chybové protokoly';
$_['entry_total']               = 'Celkom';
$_['help_total']                = 'Modul Payout sa stane aktívnym, keď objednávka dosiahne túto sumu';
$_['entry_geo_zone']            = 'Geo zóna:';
$_['entry_status']              = 'Stav:';
$_['entry_sort_order']          = 'Radenie';
$_['text_notification_url']     = 'Notification URL:';

// Order Statuses
$_['entry_processing_status']   = 'Prebiehajúci stav:';
$_['help_processing_status']    = '(Processing Status) Payment is processing';
$_['entry_success_status']      = 'Úspešný stav:';
$_['help_success_status']       = '(Success Status) Payment was successfully processed';
$_['entry_expired_status']      = 'Expired Status:';
$_['help_expired_status']       = '(Expired Status) Payment has expired';
$_['entry_cancelled_status']    = 'Zrušený stav:';
$_['help_cancelled_status']     = '(Cancelled Status) The customer has cancelled payment';
$_['entry_failed_status']       = 'Stav zlyhania:';
$_['help_failed_status']        = '(Failed Status) Requires payment_method, action, authorization, capture';
$_['entry_notify']              = 'Upozornenie zákazníka:';

// About
$_['text_title']                = 'Payout platobný modul pre OpenCart';
$_['text_version']              = 'Verzia:';
$_['info_version']              = ' <i class="fa fa-exclamation-triangle text-warning" data-toggle="tooltip" data-placement="right" title="Táto verzia modulu pravdepodobne nie je kompatibilná s vašou verziou OpenCartu!"></i>';
$_['text_compatibility']        = 'Kompatibilita:';
$_['info_compatibility']        = 'OpenCart - %s<br>Payout - <a href="https://postman.payout.one/" title="Payout API" target="_blank">API</a>';
$_['text_documentation']        = 'Dokumentácia:';
$_['info_documentation']        = '<a href="https://github.com/payout-one/payout_opencart3" title="Payout payment module for OpenCart 3" target="_blank">https://github.com/payout-one/payout_opencart3</a>';
$_['text_license']              = 'Licencia:';
$_['info_license']              = 'Tento softvér s otvoreným zdrojovým kódom je licencovaný na základe MIT licencie.<br>Copyright &copy; 2019-%d <a href="https://payout.one/" title="Payout, s.r.o." target="_blank">Payout, s.r.o.</a>';
