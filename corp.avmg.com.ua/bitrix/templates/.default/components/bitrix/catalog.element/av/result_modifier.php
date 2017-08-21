<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/* -------------------------------------------------------------------- */
/* ----------------------- fields/props to show ----------------------- */
/* -------------------------------------------------------------------- */
$arParams["OFFERS_FIELD_CODE"]    = array_diff($arParams["OFFERS_FIELD_CODE"],    ['']);
$arParams["OFFERS_PROPERTY_CODE"] = array_diff($arParams["OFFERS_PROPERTY_CODE"], ['']);
$arParams["PRICE_TYPE"]           = $arParams["PRICE_CODE"][0]
	? $arParams["PRICE_CODE"][0]
	: CCatalogGroup::GetList([], ["BASE" => 'Y'], false, false, ["NAME"])->GetNext()["NAME"];
$arParams["ASK_FORM_ID"]          = (int) $arParams["ASK_FORM_ID"];
/* -------------------------------------------------------------------- */
/* ------------------------- element pictures ------------------------- */
/* -------------------------------------------------------------------- */
$arResult["IMAGES"] = [];
if($arResult["DETAIL_PICTURE"]["SRC"]) $arResult["IMAGES"][] = $arResult["DETAIL_PICTURE"];

if(count($arParams["PICTURES_ALT"]))
	{
	$picturesPropsArray = [];
	$queryList = CIBlockProperty::GetList([], ["IBLOCK_ID" => $arParams["IBLOCK_ID"], "ACTIVE" => 'Y', "PROPERTY_TYPE" => 'F']);
	while($queryInfo = $queryList->GetNext()) $picturesPropsArray[] = $queryInfo["ID"];

	foreach($arParams["PICTURES_ALT"] as $index => $propertyId)
		if(!in_array($propertyId, $picturesPropsArray))
			unset($arParams["PICTURES_ALT"][$index]);
	}

foreach($arParams["PICTURES_ALT"] as $propertyId)
	{
	$queryList = CIBlockElement::GetProperty($arParams["IBLOCK_ID"], $arResult["ID"], [], ["ID" => $propertyId]);
	while($queryInfo = $queryList->GetNext())
		{
		$fileInfo = CFile::GetFileArray($queryInfo["VALUE"]);
		if($fileInfo["SRC"]) $arResult["IMAGES"][] = $fileInfo;
		}
	}
/* -------------------------------------------------------------------- */
/* --------------------------- user basket ---------------------------- */
/* -------------------------------------------------------------------- */
$arResult["USER_BASKET"] = [];
$queryList = CSaleBasket::GetList
	(
	["ID" => 'DESC'],
		[
		"FUSER_ID" => CSaleBasket::GetBasketUserID(),
		"LID"      => SITE_ID,
		"ORDER_ID" => NULL
		],
	false, false,
	["ID", "PRODUCT_ID", "QUANTITY"]
	);
while($queryElement = $queryList->GetNext()) $arResult["USER_BASKET"][$queryElement["PRODUCT_ID"]] = $queryElement;