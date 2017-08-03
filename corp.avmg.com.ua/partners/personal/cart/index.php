<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Корзина");
?><div class="col-md-12">
<?$APPLICATION->IncludeComponent(
	"bitrix:sale.basket.basket", 
	".default", 
	array(
		"ACTION_VARIABLE" => "action",
		"AUTO_CALCULATION" => "Y",
		"TEMPLATE_THEME" => "blue",
		"COLUMNS_LIST" => array(
			0 => "NAME",
			1 => "DISCOUNT",
			2 => "WEIGHT",
			3 => "PROPS",
			4 => "DELETE",
			5 => "DELAY",
			6 => "TYPE",
			7 => "PRICE",
			8 => "QUANTITY",
		),
		"COMPONENT_TEMPLATE" => ".default",
		"COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
		"GIFTS_BLOCK_TITLE" => "Выберите один из подарков",
		"GIFTS_CONVERT_CURRENCY" => "Y",
		"GIFTS_HIDE_BLOCK_TITLE" => "N",
		"GIFTS_HIDE_NOT_AVAILABLE" => "N",
		"GIFTS_MESS_BTN_BUY" => "Выбрать",
		"GIFTS_MESS_BTN_DETAIL" => "Подробнее",
		"GIFTS_PAGE_ELEMENT_COUNT" => "4",
		"GIFTS_PRODUCT_PROPS_VARIABLE" => "prop",
		"GIFTS_PRODUCT_QUANTITY_VARIABLE" => "",
		"GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",
		"GIFTS_SHOW_IMAGE" => "Y",
		"GIFTS_SHOW_NAME" => "Y",
		"GIFTS_SHOW_OLD_PRICE" => "Y",
		"GIFTS_TEXT_LABEL_GIFT" => "Подарок",
		"GIFTS_PLACE" => "BOTTOM",
		"HIDE_COUPON" => "Y",
		"OFFERS_PROPS" => array(
		),
		"PATH_TO_ORDER" => "/partners/personal/order/make/",
		"PRICE_VAT_SHOW_VALUE" => "N",
		"QUANTITY_FLOAT" => "N",
		"SET_TITLE" => "Y",
		"USE_GIFTS" => "N",
		"USE_PREPAYMENT" => "N",
		"CORRECT_RATIO" => "N",
		"USE_ENHANCED_ECOMMERCE" => "N"
	),
	false
);?>
    </div><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>