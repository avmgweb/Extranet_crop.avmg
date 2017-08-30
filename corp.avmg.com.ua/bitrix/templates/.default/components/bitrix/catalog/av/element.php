<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die()?>
<div class="av-catalog">
	<div class="menu-minimized-col">
		<?=$arResult["CATALOG_MENU"]?>
	</div>
	<div>
		<?
		$APPLICATION->IncludeComponent
			(
			"bitrix:catalog.element", "av",
				[
				"IBLOCK_TYPE"  => $arParams["IBLOCK_TYPE"],
				"IBLOCK_ID"    => $arParams["IBLOCK_ID"],
				"ELEMENT_ID"   => $arResult["VARIABLES"]["ELEMENT_ID"],
				"ELEMENT_CODE" => $arResult["VARIABLES"]["ELEMENT_CODE"],
				"SECTION_ID"   => $arResult["VARIABLES"]["SECTION_ID"],
				"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],

				"SHOW_DEACTIVATED"          => $arParams["SHOW_DEACTIVATED"],
				"HIDE_NOT_AVAILABLE_OFFERS" => $arParams["HIDE_NOT_AVAILABLE_OFFERS"],

				"PROPERTY_CODE"        => $arParams["DETAIL_PROPERTY_CODE"],
				"OFFERS_FIELD_CODE"    => $arParams["DETAIL_OFFERS_FIELD_CODE"],
				"OFFERS_PROPERTY_CODE" => $arParams["DETAIL_OFFERS_PROPERTY_CODE"],
				"OFFERS_SORT_FIELD"    => $arParams["OFFERS_SORT_FIELD"],
				"OFFERS_SORT_ORDER"    => $arParams["OFFERS_SORT_ORDER"],
				"OFFERS_SORT_FIELD2"   => $arParams["OFFERS_SORT_FIELD2"],
				"OFFERS_SORT_ORDER2"   => $arParams["OFFERS_SORT_ORDER2"],
				"BACKGROUND_IMAGE"     => $arParams["DETAIL_BACKGROUND_IMAGE"],

				"SECTION_URL"               => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
				"DETAIL_URL"                => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
				"SECTION_ID_VARIABLE"       => $arResult["SECTION_ID_VARIABLE"],
				"CHECK_SECTION_ID_VARIABLE" => $arResult["DETAIL_CHECK_SECTION_ID_VARIABLE"],

				"CACHE_TYPE"   => $arParams["CACHE_TYPE"],
				"CACHE_TIME"   => $arParams["CACHE_TIME"],
				"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],

				"SET_TITLE"                => $arParams["SET_TITLE"],
				"SET_CANONICAL_URL"        => $arParams["DETAIL_SET_CANONICAL_URL"],
				"SET_BROWSER_TITLE"        => $arParams["DETAIL_BROWSER_TITLE"] ? 'Y' : 'N',
				"BROWSER_TITLE"            => $arParams["DETAIL_BROWSER_TITLE"],
				"SET_META_KEYWORDS"        => $arParams["DETAIL_META_KEYWORDS"] ? 'Y' : 'N',
				"META_KEYWORDS"            => $arParams["DETAIL_META_KEYWORDS"],
				"SET_META_DESCRIPTION"     => $arParams["DETAIL_META_DESCRIPTION"] ? 'Y' : 'N',
				"META_DESCRIPTION"         => $arParams["DETAIL_META_DESCRIPTION"],
				"SET_LAST_MODIFIED"        => $arParams["SET_LAST_MODIFIED"],
				"USE_MAIN_ELEMENT_SECTION" => $arParams["USE_MAIN_ELEMENT_SECTION"],
				"STRICT_SECTION_CHECK"     => $arParams["DETAIL_STRICT_SECTION_CHECK"],
				"ADD_SECTIONS_CHAIN"       => $arParams["ADD_SECTIONS_CHAIN"],
				"ADD_ELEMENT_CHAIN"        => $arParams["ADD_ELEMENT_CHAIN"],

				"ACTION_VARIABLE"     => $arParams["ACTION_VARIABLE"],
				"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],

				"DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
				"COMPARE_PATH"    => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["compare"],

				"PRICE_CODE"           => $arParams["PRICE_CODE"],
				"USE_PRICE_COUNT"      => $arParams["USE_PRICE_COUNT"],
				"SHOW_PRICE_COUNT"     => $arParams["SHOW_PRICE_COUNT"],
				"PRICE_VAT_INCLUDE"    => $arParams["PRICE_VAT_INCLUDE"],
				"PRICE_VAT_SHOW_VALUE" => $arParams["PRICE_VAT_SHOW_VALUE"],
				"CONVERT_CURRENCY"     => $arParams["CONVERT_CURRENCY"],
				"CURRENCY_ID"          => $arParams["CURRENCY_ID"],

				"BASKET_URL"                 => $arParams["BASKET_URL"],
				"USE_PRODUCT_QUANTITY"       => $arParams["USE_PRODUCT_QUANTITY"],
				"PRODUCT_QUANTITY_VARIABLE"  => $arParams["PRODUCT_QUANTITY_VARIABLE"],
				"ADD_PROPERTIES_TO_BASKET"   => $arParams["ADD_PROPERTIES_TO_BASKET"],
				"PRODUCT_PROPS_VARIABLE"     => $arParams["PRODUCT_PROPS_VARIABLE"],
				"PARTIAL_PRODUCT_PROPERTIES" => $arParams["PARTIAL_PRODUCT_PROPERTIES"],
				"PRODUCT_PROPERTIES"         => $arParams["PRODUCT_PROPERTIES"],
				"OFFERS_CART_PROPERTIES"     => $arParams["OFFERS_CART_PROPERTIES"],

				"LINK_IBLOCK_TYPE"  => $arParams["LINK_IBLOCK_TYPE"],
				"LINK_IBLOCK_ID"    => $arParams["LINK_IBLOCK_ID"],
				"LINK_PROPERTY_SID" => $arParams["LINK_PROPERTY_SID"],
				"LINK_ELEMENTS_URL" => $arParams["LINK_ELEMENTS_URL"],

				"USE_GIFTS_DETAIL"                             => $arParams["USE_GIFTS_DETAIL"],
				"USE_GIFTS_MAIN_PR_SECTION_LIST"               => $arParams["USE_GIFTS_MAIN_PR_SECTION_LIST"],
				"GIFTS_DETAIL_PAGE_ELEMENT_COUNT"              => $arParams["GIFTS_DETAIL_PAGE_ELEMENT_COUNT"],
				"GIFTS_DETAIL_HIDE_BLOCK_TITLE"                => $arParams["GIFTS_DETAIL_HIDE_BLOCK_TITLE"],
				"GIFTS_DETAIL_BLOCK_TITLE"                     => $arParams["GIFTS_DETAIL_BLOCK_TITLE"],
				"GIFTS_DETAIL_TEXT_LABEL_GIFT"                 => $arParams["GIFTS_DETAIL_TEXT_LABEL_GIFT"],
				"GIFTS_SHOW_OLD_PRICE"                         => $arParams["GIFTS_SHOW_OLD_PRICE"],
				"GIFTS_SHOW_NAME"                              => $arParams["GIFTS_SHOW_NAME"],
				"GIFTS_SHOW_IMAGE"                             => $arParams["GIFTS_SHOW_IMAGE"],
				"GIFTS_MESS_BTN_BUY"                           => $arParams["GIFTS_MESS_BTN_BUY"],
				"GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT" => $arParams["GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT"],
				"GIFTS_MAIN_PRODUCT_DETAIL_HIDE_BLOCK_TITLE"   => $arParams["GIFTS_MAIN_PRODUCT_DETAIL_HIDE_BLOCK_TITLE"],
				"GIFTS_MAIN_PRODUCT_DETAIL_BLOCK_TITLE"        => $arParams["GIFTS_MAIN_PRODUCT_DETAIL_BLOCK_TITLE"],

				"SET_STATUS_404" => $arParams["SET_STATUS_404"],
				"SHOW_404"       => $arParams["SHOW_404"],
				"MESSAGE_404"    => $arParams["MESSAGE_404"],
				"FILE_404"       => $arParams["FILE_404"],

				"USE_ELEMENT_COUNTER"          => $arParams["USE_ELEMENT_COUNTER"],
				"DISABLE_INIT_JS_IN_COMPONENT" => $arParams["DISABLE_INIT_JS_IN_COMPONENT"],
				"SET_VIEWED_IN_COMPONENT"      => $arParams["DETAIL_SET_VIEWED_IN_COMPONENT"],

				"PICTURES_ALT"            => $arParams["DETAIL_PICTURES_ALT"],
				"ASK_FORM_ID"             => $arParams["ASK_FORM_ID"],
				"ASK_FORM_LINK_FIELD_ID"  => $arParams["ASK_FORM_LINK_FIELD_ID"],
				"ASK_FORM_COUNT_FIELD_ID" => $arParams["ASK_FORM_COUNT_FIELD_ID"]
				]
			);
		?>
	</div>
</div>
