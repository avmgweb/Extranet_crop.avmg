<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$frame = $this->createFrame();
?>
<div class="av-basket-line" data-site-id="<?=SITE_ID?>">
	<?$frame->begin()?>
		<img src="<?=$this->GetFolder()?>/images/basket.svg">
		<div class="counter<?if(!$arResult["NUM_PRODUCTS"]):?> empty<?endif?>">
			<?=$arResult["NUM_PRODUCTS"]?>
		</div>
	<?$frame->beginStub()?>
		<img src="<?=$this->GetFolder()?>/images/basket.svg">
	<?$frame->end()?>
	<a href="<?=$arParams["PATH_TO_BASKET"]?>"><?=GetMessage("AV_BASKET_LINE_TITLE")?></a>
</div>