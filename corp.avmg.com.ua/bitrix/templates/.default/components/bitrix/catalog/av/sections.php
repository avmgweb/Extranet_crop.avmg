<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die()?>
<div class="av-catalog">
	<div class="col-lg-4 col-md-4 hidden-sm hidden-xs menu-col">
		<?=$arResult["CATALOG_MENU"]?>
	</div>
	<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 body-col">
		<?
		$APPLICATION->IncludeComponent
			(
			"bitrix:catalog.section.list", "av",
				[
				"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
				"IBLOCK_ID"   => $arParams["IBLOCK_ID"],

				"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],

				"COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
				"TOP_DEPTH"      => $arParams["SECTION_TOP_DEPTH"],

				"CACHE_TYPE"   => $arParams["CACHE_TYPE"],
				"CACHE_TIME"   => $arParams["CACHE_TIME"],
				"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],

				"ADD_SECTIONS_CHAIN" => $arParams["ADD_SECTIONS_CHAIN"]
				]
			);
		?>
	</div>
</div>