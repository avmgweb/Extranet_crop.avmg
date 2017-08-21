<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if($arParams["SECTION_CODE"] && !$arParams["SECTION_ID"])
	$arParams["SECTION_ID"] = CIBlockSection::GetList
		(
		[],
			[
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"CODE"      => $arParams["SECTION_CODE"]
			],
		false, ["ID"]
		)->GetNext()["ID"];