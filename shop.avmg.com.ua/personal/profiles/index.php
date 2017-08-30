<?
require $_SERVER["DOCUMENT_ROOT"].'/bitrix/header.php';

$APPLICATION->SetTitle("Платежный профиль");

$APPLICATION->IncludeComponent(
	"bitrix:sale.personal.profile", 
	"av", 
	array(
		"SEF_MODE" => "Y",
		"SEF_FOLDER" => "/personal/profiles/",
		"PER_PAGE" => "10",
		"USE_AJAX_LOCATIONS" => "Y",
		"SET_TITLE" => "N",
		"COMPONENT_TEMPLATE" => "av",
		"SEF_URL_TEMPLATES" => array(
			"list" => "",
			"detail" => "detail/#ID#/",
		)
	),
	false
);

require $_SERVER["DOCUMENT_ROOT"].'/bitrix/footer.php';