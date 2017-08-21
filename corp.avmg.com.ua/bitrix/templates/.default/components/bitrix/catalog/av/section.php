<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
use
	Bitrix\Main\Loader,
	Bitrix\Main\ModuleManager;
?>
<div class="av-catalog">
	<div class="col-lg-4 col-md-4 hidden-sm hidden-xs menu-col">
		<?
		$APPLICATION->IncludeComponent
			(
			"bitrix:menu", "av_shop_vertical",
				[
				"ROOT_MENU_TYPE"     => 'left',
				"MAX_LEVEL"          => 2,
				"CHILD_MENU_TYPE"    => 'left',
				"USE_EXT"            => 'Y',
				"DELAY"              => 'N',
				"ALLOW_MULTI_SELECT" => 'N',

				"MENU_CACHE_TYPE"       => 'A',
				"MENU_CACHE_TIME"       => 360000,
				"MENU_CACHE_USE_GROUPS" => 'Y'
				]
			);
		?>
	</div>
	<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 body-col">
		<?
		$isFilter = $arParams['USE_FILTER'] == 'Y' ? true : false;

		if($arParams["USE_FILTER"] == 'Y')
			{
			$arFilter =
				[
				"IBLOCK_ID"     => $arParams["IBLOCK_ID"],
				"ACTIVE"        => 'Y',
				"GLOBAL_ACTIVE" => 'Y'
				];

			if($arResult["VARIABLES"]["SECTION_ID"])       $arFilter["ID"]    = $arResult["VARIABLES"]["SECTION_ID"];
			elseif($arResult["VARIABLES"]["SECTION_CODE"]) $arFilter["=CODE"] = $arResult["VARIABLES"]["SECTION_CODE"];

			$obCache = new CPHPCache();
			if($obCache->InitCache(36000, serialize($arFilter), "/iblock/catalog"))
				$arCurSection = $obCache->GetVars();
			elseif ($obCache->StartDataCache())
				{
				$arCurSection = array();
				if (Loader::includeModule("iblock"))
					{
					$dbRes = CIBlockSection::GetList(array(), $arFilter, false, array("ID"));

					if(defined("BX_COMP_MANAGED_CACHE"))
						{
						global $CACHE_MANAGER;
						$CACHE_MANAGER->StartTagCache("/iblock/catalog");
						if($arCurSection = $dbRes->Fetch()) $CACHE_MANAGER->RegisterTag("iblock_id_".$arParams["IBLOCK_ID"]);
						$CACHE_MANAGER->EndTagCache();
						}
					else if(!$arCurSection = $dbRes->Fetch())
						$arCurSection = array();
					}
				$obCache->EndDataCache($arCurSection);
				}
			if(!isset($arCurSection))
				$arCurSection = array();
			}
		?>
		<div class="row">
			<?
			if($arParams["USE_FILTER"] == 'Y' && !$arParams["FILTER_VIEW_MODE"]) include $_SERVER["DOCUMENT_ROOT"].'/'.$this->GetFolder().'/section_vertical.php';
			else                                                                 include $_SERVER["DOCUMENT_ROOT"].'/'.$this->GetFolder().'/section_horizontal.php';
			?>
		</div>
	</div>
</div>