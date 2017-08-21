<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$arParams = $this->getComponent()->applyTemplateModifications();
/* -------------------------------------------------------------------- */
/* -------------------------- sku table info -------------------------- */
/* -------------------------------------------------------------------- */
$arResult["SKU_TABLE_INFO"] =
	[
	"SITE"          => SITE_ID,
	"OFFERS"        => $arResult["OFFERS"],
	"OFFERS_FIELDS" => array_diff($arResult["ORIGINAL_PARAMETERS"]["OFFERS_FIELD_CODE"],    ['']),
	"OFFERS_PROPS"  => array_diff($arResult["ORIGINAL_PARAMETERS"]["OFFERS_PROPERTY_CODE"], ['']),
	"ELEMENT_INFO"  =>
		[
		"ID"          => $arResult["ID"],
		"PRICE"       => $arResult["ITEM_PRICES"][0]["PRINT_PRICE"],
		"PRICE_TITLE" => '',
		"MEASURE"     => $arResult["ITEM_MEASURE"]["TITLE"]
		],
	"ELEMENT_PROPS" => $arResult["DISPLAY_PROPERTIES"]
	];
foreach($arResult["CAT_PRICES"] as $priceInfo)
	if($priceInfo["ID"] == $arResult["ITEM_PRICES"][0]["PRICE_TYPE_ID"])
		$arResult["SKU_TABLE_INFO"]["ELEMENT_INFO"]["PRICE_TITLE"] = $priceInfo["TITLE"];