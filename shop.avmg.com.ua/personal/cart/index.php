<?
require $_SERVER["DOCUMENT_ROOT"].'/bitrix/header.php';

$APPLICATION->SetTitle("Корзина");

$APPLICATION->IncludeComponent
	(
	"bitrix:sale.basket.basket", "",
		array(
		"COLUMNS_LIST" =>
			array(
			"NAME",  "DISCOUNT", "PROPS",    "DELETE",
			"DELAY", "PRICE",    "QUANTITY", "SUM"
			),

		"PATH_TO_ORDER"                 => '/personal/orders/make/',
		"HIDE_COUPON"                   => 'Y',
		"PRICE_VAT_SHOW_VALUE"          => 'Y',
		"COUNT_DISCOUNT_4_ALL_QUANTITY" => 'N',
		"USE_PREPAYMENT"                => 'N',
		"QUANTITY_FLOAT"                => 'N',
		"AUTO_CALCULATION"              => 'Y',
		"CORRECT_RATIO"                 => 'N',
		"SET_TITLE"                     => 'Y',
		"ACTION_VARIABLE"               => "action",

		"OFFERS_PROPS" => array(),

		"USE_GIFTS"              => 'N',
		"USE_ENHANCED_ECOMMERCE" => 'N'
		)
	);

require $_SERVER["DOCUMENT_ROOT"].'/bitrix/footer.php';