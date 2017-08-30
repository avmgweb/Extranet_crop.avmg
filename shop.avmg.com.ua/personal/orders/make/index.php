<?
require $_SERVER["DOCUMENT_ROOT"].'/bitrix/header.php';

$APPLICATION->SetTitle("Оформление заказа");

$APPLICATION->IncludeComponent(
	"bitrix:sale.order.ajax", 
	".default", 
	array(
		"PAY_FROM_ACCOUNT" => "Y",
		"ONLY_FULL_PAY_FROM_ACCOUNT" => "Y",
		"ALLOW_AUTO_REGISTER" => "Y",
		"SEND_NEW_USER_NOTIFY" => "Y",
		"DELIVERY_NO_AJAX" => "H",
		"DELIVERY_NO_SESSION" => "Y",
		"TEMPLATE_LOCATION" => "popup",
		"DELIVERY_TO_PAYSYSTEM" => "p2d",
		"SHOW_VAT_PRICE" => "Y",
		"USE_PREPAYMENT" => "Y",
		"COMPATIBLE_MODE" => "N",
		"ALLOW_USER_PROFILES" => "Y",
		"ALLOW_NEW_PROFILE" => "N",
		"USER_CONSENT" => "Y",
		"USER_CONSENT_ID" => "2",
		"USER_CONSENT_IS_CHECKED" => "Y",
		"USER_CONSENT_IS_LOADED" => "Y",
		"PATH_TO_BASKET" => "/personal/cart/",
		"PATH_TO_PERSONAL" => "/personal/orders/",
		"PATH_TO_PAYMENT" => "/personal/orders/payment/",
		"PATH_TO_AUTH" => "",
		"SET_TITLE" => "N",
		"DISABLE_BASKET_REDIRECT" => "N",
		"PRODUCT_COLUMNS_VISIBLE" => array(
			0 => "PREVIEW_PICTURE",
		),
		"ADDITIONAL_PICT_PROP_139" => "-",
		"BASKET_IMAGES_SCALING" => "adaptive",
		"SERVICES_IMAGES_SCALING" => "adaptive",
		"PRODUCT_COLUMNS_HIDDEN" => array(
		),
		"USE_YM_GOALS" => "N",
		"USE_CUSTOM_MAIN_MESSAGES" => "N",
		"USE_CUSTOM_ADDITIONAL_MESSAGES" => "N",
		"USE_CUSTOM_ERROR_MESSAGES" => "N",
		"COMPONENT_TEMPLATE" => ".default",
		"ALLOW_APPEND_ORDER" => "Y",
		"SHOW_NOT_CALCULATED_DELIVERIES" => "L",
		"SPOT_LOCATION_BY_GEOIP" => "Y",
		"USE_PRELOAD" => "Y",
		"TEMPLATE_THEME" => "site",
		"SHOW_ORDER_BUTTON" => "final_step",
		"SHOW_TOTAL_ORDER_BUTTON" => "N",
		"SHOW_PAY_SYSTEM_LIST_NAMES" => "Y",
		"SHOW_PAY_SYSTEM_INFO_NAME" => "Y",
		"SHOW_DELIVERY_LIST_NAMES" => "Y",
		"SHOW_DELIVERY_INFO_NAME" => "Y",
		"SHOW_DELIVERY_PARENT_NAMES" => "Y",
		"SHOW_STORES_IMAGES" => "Y",
		"SKIP_USELESS_BLOCK" => "Y",
		"BASKET_POSITION" => "before",
		"SHOW_BASKET_HEADERS" => "N",
		"DELIVERY_FADE_EXTRA_SERVICES" => "N",
		"SHOW_COUPONS_BASKET" => "N",
		"SHOW_COUPONS_DELIVERY" => "N",
		"SHOW_COUPONS_PAY_SYSTEM" => "N",
		"SHOW_NEAREST_PICKUP" => "Y",
		"DELIVERIES_PER_PAGE" => "9",
		"PAY_SYSTEMS_PER_PAGE" => "9",
		"PICKUPS_PER_PAGE" => "5",
		"SHOW_PICKUP_MAP" => "Y",
		"SHOW_MAP_IN_PROPS" => "Y",
		"PICKUP_MAP_TYPE" => "google",
		"SHOW_MAP_FOR_DELIVERIES" => array(
			0 => "2",
		),
		"PROPS_FADE_LIST_1" => array(
		),
		"PROPS_FADE_LIST_2" => array(
		),
		"PROPS_FADE_LIST_3" => array(
			0 => "20",
			1 => "21",
			2 => "22",
			3 => "24",
		),
		"PROPS_FADE_LIST_4" => array(
			0 => "27",
			1 => "28",
			2 => "29",
			3 => "30",
			4 => "31",
			5 => "32",
			6 => "33",
			7 => "36",
			8 => "46",
		),
		"PROPS_FADE_LIST_5" => array(
		),
		"ACTION_VARIABLE" => "soa-action",
		"ADDITIONAL_PICT_PROP_30" => "-",
		"ADDITIONAL_PICT_PROP_39" => "-",
		"ADDITIONAL_PICT_PROP_109" => "-",
		"ADDITIONAL_PICT_PROP_110" => "-",
		"ADDITIONAL_PICT_PROP_112" => "-",
		"ADDITIONAL_PICT_PROP_113" => "-",
		"ADDITIONAL_PICT_PROP_118" => "-",
		"ADDITIONAL_PICT_PROP_140" => "-",
		"ADDITIONAL_PICT_PROP_142" => "-",
		"ADDITIONAL_PICT_PROP_144" => "-",
		"ADDITIONAL_PICT_PROP_146" => "-",
		"ADDITIONAL_PICT_PROP_148" => "-",
		"ADDITIONAL_PICT_PROP_149" => "-",
		"ADDITIONAL_PICT_PROP_150" => "-",
		"ADDITIONAL_PICT_PROP_246" => "-",
		"USE_ENHANCED_ECOMMERCE" => "N"
	),
	false
);

require $_SERVER["DOCUMENT_ROOT"].'/bitrix/footer.php';