<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$needAskForm = false;
/* -------------------------------------------------------------------- */
/* ------------------------------- page ------------------------------- */
/* -------------------------------------------------------------------- */
?>
<div class="av-catalog-element">
	<?
	/* ------------------------------------------- */
	/* --------------- images block -------------- */
	/* ------------------------------------------- */
	?>
	<div class="images-block">
		<div class="main-image-wraper">
			<?if(!count($arResult["IMAGES"])):?>
				<img
					class="default"
					src="<?=$this->GetFolder()?>/images/default_image.jpg"
					alt="<?=$arResult["NAME"]?>"
					title="<?=$arResult["NAME"]?>"
				>
			<?else:?>
				<img
					src="<?=$arResult["IMAGES"][0]["SRC"]?>"
					alt="<?=$arResult["IMAGES"][0]["ALT"]?>"
					title="<?=$arResult["IMAGES"][0]["TITLE"]?>"
				>
			<?endif?>
		</div>

		<?if(count($arResult["IMAGES"]) >= 2):?>
		<div class="slider">
			<?for($i = 0;$i <= count($arResult["IMAGES"]) - 1;$i++):?>
			<img
				class="slider-image"
				src="<?=$arResult["IMAGES"][$i]["SRC"]?>"
				alt="<?=$arResult["IMAGES"][$i]["ALT"]?>"
				title="<?=$arResult["IMAGES"][$i]["TITLE"]?>"
			>
			<?endfor?>
		</div>
		<?endif?>
	</div>
	<?
	/* ------------------------------------------- */
	/* --------------- preview text -------------- */
	/* ------------------------------------------- */
	?>
	<div class="preview-text">
		<?=$arResult["PREVIEW_TEXT"]?>
	</div>
	<?
	/* ------------------------------------------- */
	/* ---------------- table info --------------- */
	/* ------------------------------------------- */
	?>
	<div class="info-table-wraper">
		<table class="info-table" data-price-type="<?=$arParams["PRICE_TYPE"]?>" data-site-id="<?=SITE_ID?>">
		<?
		/* ---------------------------- */
		/* --------- sku table -------- */
		/* ---------------------------- */
		?>
		<?if(count($arResult["OFFERS"])):?>
			<thead>
				<tr>
					<?foreach($arParams["OFFERS_FIELD_CODE"] as $field):?>
					<?if($arResult["OFFERS"][0][$field]):?>
					<th><?=GetMessage('AV_CATALOG_ELEMENT_INFO_TABLE_FIELD_'.$field)?></th>
					<?endif?>
					<?endforeach?>

					<?foreach($arParams["OFFERS_PROPERTY_CODE"] as $field):?>
					<?if(count($arResult["OFFERS"][0]["DISPLAY_PROPERTIES"][$field])):?>
					<th><?=$arResult["OFFERS"][0]["DISPLAY_PROPERTIES"][$field]["NAME"]?></th>
					<?endif?>
					<?endforeach?>

					<th><?=GetMessage("AV_CATALOG_ELEMENT_INFO_TABLE_COUNT")?></th>
					<th><?=GetMessage("AV_CATALOG_ELEMENT_INFO_TABLE_MEASURE")?></th>
					<th><?=$arResult["OFFERS"][0]["CATALOG_GROUP_NAME_1"]?></th>
					<th><?=GetMessage("AV_CATALOG_ELEMENT_INFO_TABLE_BUY")?></th>
				</tr>
			</thead>

			<tbody>
			<?foreach($arResult["OFFERS"] as $valueInfo):?>
				<?$itemPrice = $valueInfo["PRICES"][$arParams["PRICE_TYPE"]]["PRINT_DISCOUNT_VALUE_NOVAT"]?>
				<tr
					class="
						item-row
						<?if(count($arResult["USER_BASKET"][$valueInfo["ID"]])):?>
						checked
						<?endif?>
						"
					data-element-id="<?=$valueInfo["ID"]?>"
					data-element-name="<?=$valueInfo["NAME"]?>"
					data-iblock-id="<?=$valueInfo["IBLOCK_ID"]?>"
				>
					<?foreach($arParams["OFFERS_FIELD_CODE"] as $field):?>
					<?if($arResult["OFFERS"][0][$field]):?>
					<td><?=$valueInfo[$field]?></td>
					<?endif?>
					<?endforeach?>

					<?foreach($arParams["OFFERS_PROPERTY_CODE"] as $field):?>
					<?if(count($arResult["OFFERS"][0]["DISPLAY_PROPERTIES"][$field])):?>
					<td>
						<?if(in_array($valueInfo["DISPLAY_PROPERTIES"][$field]["PROPERTY_TYPE"], ["N", "S", "L", "E"])):?>
						<?=strip_tags($valueInfo["DISPLAY_PROPERTIES"][$field]["DISPLAY_VALUE"])?>
						<?endif?>
					</td>
					<?endif?>
					<?endforeach?>

					<td>
						<?$positionQuantity = (float) $arResult["USER_BASKET"][$valueInfo["ID"]]["QUANTITY"]?>
						<div class="counter<?if($positionQuantity):?> disabled<?endif?>">
							<div class="checker back<?if($positionQuantity <= 1):?> disabled<?endif?>"></div>
							<input
								value="<?=($positionQuantity ? $positionQuantity : 1)?>"
								<?if($positionQuantity):?>
								disabled
								<?endif?>
							>
							<div class="checker forward"></div>
						</div>
					</td>
					<td>
						<div class="measure"><?=$valueInfo["ITEM_MEASURE"]["TITLE"]?></div>
					</td>
					<td>
						<?if($itemPrice):?>
							<?=$itemPrice?>
						<?else:?>
							<span class="ask-price-call-form"><?=GetMessage("AV_CATALOG_ELEMENT_INFO_TABLE_ASK_PRICE")?></span>
							<?$needAskForm = true?>
						<?endif?>
					</td>
					<td>
						<?if($itemPrice):?>
							<div class="check-block">
								<span><?=GetMessage("AV_CATALOG_ELEMENT_INFO_TABLE_CHECK")?></span>
							</div>
							<div class="change-block">
								<span><?=GetMessage("AV_CATALOG_ELEMENT_INFO_TABLE_CHECKED")?></span>
								<span><?=GetMessage("AV_CATALOG_ELEMENT_INFO_TABLE_CHANGE")?></span>
							</div>
						<?else:?>
							-
						<?endif?>
					</td>
				</tr>
			<?endforeach?>
			</tbody>
		<?
		/* ---------------------------- */
		/* ------- element table ------ */
		/* ---------------------------- */
		?>
		<?else:?>
			<?$elementPrice = $arResult["PRICES"][$arParams["PRICE_TYPE"]]["PRINT_DISCOUNT_VALUE_NOVAT"]?>
			<thead>
				<tr>
					<?foreach($arParams["PROPERTY_CODE"] as $propId):?>
					<?if(count($arResult["DISPLAY_PROPERTIES"][$propId])):?>
					<th><?=$arResult["DISPLAY_PROPERTIES"][$propId]["NAME"]?></th>
					<?endif?>
					<?endforeach?>

					<th><?=GetMessage("AV_CATALOG_ELEMENT_INFO_TABLE_COUNT")?></th>
					<th><?=GetMessage("AV_CATALOG_ELEMENT_INFO_TABLE_MEASURE")?></th>
					<th><?=$arResult["CAT_PRICES"][$arParams["PRICE_TYPE"]]["TITLE"]?></th>
					<th><?=GetMessage("AV_CATALOG_ELEMENT_INFO_TABLE_BUY")?></th>
				</tr>
			</thead>

			<tbody>
			<tr
				class="
					item-row
					<?if(count($arResult["USER_BASKET"][$arResult["ID"]])):?>
					checked
					<?endif?>
					"
				data-element-id="<?=$arResult["ID"]?>"
				data-element-name="<?=$arResult["NAME"]?>"
				data-iblock-id="<?=$arResult["IBLOCK_ID"]?>"
			>
				<?foreach($arParams["PROPERTY_CODE"] as $propInfo):?>
				<?if(count($arResult["DISPLAY_PROPERTIES"][$propId])):?>
				<td>
					<?if(in_array($arResult["DISPLAY_PROPERTIES"][$propId]["PROPERTY_TYPE"], ["N", "S", "L", "E"])):?>
					<?=strip_tags($arResult["DISPLAY_PROPERTIES"][$propId]["DISPLAY_VALUE"])?>
					<?endif?>
				</td>
				<?endif?>
				<?endforeach?>

				<td>
					<?$positionQuantity = (float) $arResult["USER_BASKET"][$arResult["ID"]]["QUANTITY"]?>
					<div class="counter<?if($positionQuantity):?> disabled<?endif?>">
						<div class="checker back<?if($positionQuantity <= 1):?> disabled<?endif?>"></div>
						<input
							value="<?=($positionQuantity ? $positionQuantity : 1)?>"
							<?if($positionQuantity):?>
							disabled
							<?endif?>
						>
						<div class="checker forward"></div>
					</div>
				</td>
				<td>
					<div class="measure"><?=$arResult["ITEM_MEASURE"]["TITLE"]?></div>
				</td>
				<td>
					<?if($elementPrice):?>
						<?=$elementPrice?>
					<?else:?>
						<span class="ask-price-call-form"><?=GetMessage("AV_CATALOG_ELEMENT_INFO_TABLE_ASK_PRICE")?></span>
						<?$needAskForm = true?>
					<?endif?>
				</td>
				<td>
					<?if($elementPrice):?>
						<div class="check-block">
							<span><?=GetMessage("AV_CATALOG_ELEMENT_INFO_TABLE_CHECK")?></span>
						</div>
						<div class="change-block">
							<span><?=GetMessage("AV_CATALOG_ELEMENT_INFO_TABLE_CHECKED")?></span>
							<span><?=GetMessage("AV_CATALOG_ELEMENT_INFO_TABLE_CHANGE")?></span>
						</div>
					<?else:?>
						-
					<?endif?>
				</td>
			</tr>
			</tbody>
		<?endif?>
		</table>
	</div>
	<?
	/* ------------------------------------------- */
	/* --------------- images block -------------- */
	/* ------------------------------------------- */
	?>
	<div class="detail-text">
		<?=$arResult["DETAIL_TEXT"]?>
	</div>
</div>
<?
/* -------------------------------------------------------------------- */
/* ----------------------------- ask form ----------------------------- */
/* -------------------------------------------------------------------- */
?>
<?if($arParams["ASK_FORM_ID"] && $needAskForm):?>
<div
	class="av-catalog-element-ask-form"
	 data-link-field-id="<?=($arParams["ASK_FORM_LINK_FIELD_ID"]  ? $arParams["ASK_FORM_LINK_FIELD_ID"]  : 0)?>"
	data-count-field-id="<?=($arParams["ASK_FORM_COUNT_FIELD_ID"] ? $arParams["ASK_FORM_COUNT_FIELD_ID"] : 0)?>"
	data-element-link-template="<?=CURRENT_PROTOCOL?>://<?=$_SERVER["SERVER_NAME"]?>/bitrix/admin/iblock_element_edit.php?IBLOCK_ID=#IBLOCK_ID#&type=<?=$arParams["IBLOCK_TYPE"]?>&ID=#ELEMENT_ID#"
>
	<div class="form-name"></div>
	<div class="separator"></div>
	<div class="form-body">
		<?$APPLICATION->IncludeComponent
			(
			"bitrix:form.result.new", "av_ajax",
				[
				"AJAX_MODE"           => 'N',
				"AJAX_OPTION_JUMP"    => 'N',
				"AJAX_OPTION_STYLE"   => 'N',
				"AJAX_OPTION_HISTORY" => 'N',

				"SEF_MODE"    => 'N',
				"WEB_FORM_ID" => $arParams["ASK_FORM_ID"],

				"START_PAGE"     => 'new',
				"SHOW_LIST_PAGE" => 'N',
				"SHOW_EDIT_PAGE" => 'N',
				"SHOW_VIEW_PAGE" => 'N',
				"SUCCESS_URL"    => '',

				"SHOW_ANSWER_VALUE"      => 'N',
				"SHOW_ADDITIONAL"        => 'N',
				"SHOW_STATUS"            => 'N',
				"EDIT_ADDITIONAL"        => 'N',
				"EDIT_STATUS"            => 'N',
				"IGNORE_CUSTOM_TEMPLATE" => 'N',
				"USE_EXTENDED_ERRORS"    => 'N',

				"CACHE_TYPE" => 'N',
				"CACHE_TIME" => ''
				]
			);
		?>
	</div>
</div>
<?endif?>