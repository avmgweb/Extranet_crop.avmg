<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/* -------------------------------------------------------------------- */
/* ---------------------------- empty list ---------------------------- */
/* -------------------------------------------------------------------- */
?>
<?if(!count($arResult["SECTIONS"])):?>
<?=GetMessage("AV_CATALOG_SECTION_LIST_EMPTY_LIST")?>
<?endif?>
<?
/* -------------------------------------------------------------------- */
/* ------------------------------- list ------------------------------- */
/* -------------------------------------------------------------------- */
?>
<div class="av-catalog-section-list">
	<?foreach($arResult["SECTIONS"] as $index => $sectionInfo):?>
		<?if($arParams["SECTION_ID"] == $sectionInfo["IBLOCK_SECTION_ID"]):?>
			<?
			$this->AddEditAction  ($sectionInfo["ID"], $sectionInfo["EDIT_LINK"],   CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT"));
			$this->AddDeleteAction($sectionInfo["ID"], $sectionInfo["DELETE_LINK"], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE"));
			?>
			<div class="item<?if($index == count($arResult["SECTIONS"]) - 1):?> last<?endif?>">
				<a class="image-link" href="<?=$sectionInfo["SECTION_PAGE_URL"]?>" rel="nofollow">
					<img
						src="<?=($sectionInfo["PICTURE"]["SRC"] ? $sectionInfo["PICTURE"]["SRC"] : $this->GetFolder().'/images/default_image.jpg')?>"
						title="<?=$sectionInfo["PICTURE"]["TITLE"]?>"
						alt="<?=$sectionInfo["PICTURE"]["ALT"]?>"
					>
				</a>
				<a class="title" href="<?=$sectionInfo["SECTION_PAGE_URL"]?>">
					<?=$sectionInfo["NAME"]?>
				</a>
			</div>
		<?endif?>
	<?endforeach?>

	<div class="border-hider-vertical"></div>
	<div class="border-hider-horizontal"></div>
</div>