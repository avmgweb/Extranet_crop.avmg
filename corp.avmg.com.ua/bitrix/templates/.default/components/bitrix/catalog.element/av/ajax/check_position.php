<?
use
	Bitrix\Main\Loader,
	Bitrix\Sale\Basket,
	Bitrix\Sale\Fuser,
	Bitrix\Sale\Order;

require $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php';
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
if(!Loader::includeModule("sale"))                              die();
if(!Loader::includeModule("catalog"))                           die();
/* -------------------------------------------------------------------- */
/* ----------------------------- variables ---------------------------- */
/* -------------------------------------------------------------------- */
$elementInfo     = CIBlockElement::GetList([], ["ID" => (int) $_POST["element_id"]], false, false, ["ID", "NAME"])->GetNext();
$priceId         = CCatalogGroup::GetList ([], ["NAME" => $_POST["price_type"]],     false, false, ["ID"])->GetNext()["ID"];
$elementCount    = (float) $_POST["count"];
$siteId          = $_POST["site_id"];
$basket          = $siteId                       ? Basket::loadItemsForFUser(Fuser::getId(), $siteId)    : null;
$elementInBasket = $basket && $elementInfo["ID"] ? $basket->getExistsItem('catalog', $elementInfo["ID"]) : null;
$result          = 'error';
/* -------------------------------------------------------------------- */
/* ------------------------- remove position -------------------------- */
/* -------------------------------------------------------------------- */
if($elementInBasket && !$elementCount)
	{
	$basket->getItemById($elementInfo["ID"])->delete();
	$basket->save();
	$result = 'position_removed';
	}
/* -------------------------------------------------------------------- */
/* ------------------------ add/change position ----------------------- */
/* -------------------------------------------------------------------- */
elseif($basket && $elementInfo["ID"] && $elementCount && $priceId)
	{
	$elementPriceInfo    = CPrice::GetList([], ["PRODUCT_ID" => $elementInfo["ID"], "CATALOG_GROUP_ID" => $priceId], false, false, ["PRICE", "CURRENCY"])->GetNext();
	$elementDiscountInfo = CCatalogDiscount::GetDiscountByProduct($elementInfo["ID"], $USER->GetUserGroupArray(), 'N', [$priceId], $siteId);

	if($elementInBasket) $elementInBasket->delete();
	$basket->createItem('catalog', $elementInfo["ID"])->setFields
		([
		"NAME"         => $elementInfo["NAME"],
		"QUANTITY"     => $elementCount,
		"CURRENCY"     => $elementPriceInfo["CURRENCY"],
		"LID"          => $siteId,
		"PRICE"        => CCatalogProduct::CountPriceWithDiscount($elementPriceInfo["PRICE"], $elementPriceInfo["CURRENCY"], $elementDiscountInfo),
		"CUSTOM_PRICE" => 'Y',
		]);
	$basket->save();
	$result = 'position_add';
	}
/* -------------------------------------------------------------------- */
/* ------------------------------ output ------------------------------ */
/* -------------------------------------------------------------------- */
echo json_encode
	([
	"result"        => $result,
	"element_id"    => $elementInfo["ID"],
	"element_count" => $elementCount
	]);