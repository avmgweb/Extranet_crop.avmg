<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $APPLICATION;

$aMenuLinksExt = $APPLICATION->IncludeComponent(
	"av:menu.sections", 
	"", 
	array(
		"IS_SEF" => "Y",
		"SEF_BASE_URL" => "/partners/catalog/",
		"SECTION_PAGE_URL" => "#SECTION_CODE_PATH#/",
		"DETAIL_PAGE_URL" => "#SECTION_CODE_PATH#//#ELEMENT_CODE#",
		"IBLOCK_TYPE" => "catalog_products",
		"IBLOCK_ID" => "139",
		"DEPTH_LEVEL" => "2",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"PATH" => rtrim(str_replace(SITE_DIR."catalog/","",$APPLICATION->GetCurDir()),"/")
	),
	false
);
$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
?>