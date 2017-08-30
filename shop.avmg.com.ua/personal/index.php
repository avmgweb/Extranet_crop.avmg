<?
require $_SERVER["DOCUMENT_ROOT"].'/bitrix/header.php';

$APPLICATION->SetTitle("Персональный раздел");

$APPLICATION->IncludeComponent("av:visit_site.menu.tablet", "", array("MENU_TYPE" => 'left'));

require $_SERVER["DOCUMENT_ROOT"].'/bitrix/footer.php';