<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

$this->IncludeLangFile('template.php');

$cartId = $arParams['cartId'];

require(realpath(dirname(__FILE__)).'/top_template.php');

if ($arParams["SHOW_PRODUCTS"] == "Y" && $arResult['NUM_PRODUCTS'] > 0)
{
?>
	<div data-role="basket-item-list" class="bx-basket-item-list">

		<div id="<?=$cartId?>products" class="bx-basket-item-list-container">
			<?foreach ($arResult["CATEGORIES"] as $category => $items):
				if (empty($items))
					continue;
				?>

				<?foreach ($items as $v):?>
					<div class="bx-basket-item-list-item">
						<div class="bx-basket-item-list-item-img">
							<?if ($arParams["SHOW_IMAGE"] == "Y" && $v["PICTURE_SRC"]):?>
								<?if($v["DETAIL_PAGE_URL"]):?>
									<a href="<?=$v["DETAIL_PAGE_URL"]?>"><img src="<?=$v["PICTURE_SRC"]?>" alt="<?=$v["NAME"]?>"></a>
								<?else:?>
									<img src="<?=$v["PICTURE_SRC"]?>" alt="<?=$v["NAME"]?>" />
								<?endif?>
							<?endif?>

						</div>
						<div class="bx-basket-item-list-item-name">
							<?if ($v["DETAIL_PAGE_URL"]):?>
                                <div class="bx-basket-item-list-item-remove" onclick="<?=$cartId?>.removeItemFromCart(<?=$v['ID']?>)" title="<?=GetMessage("TSB1_DELETE")?>"></div>
                                <a href="<?=$v["DETAIL_PAGE_URL"]?>"><?if(strlen($v["NAME"]) > 35) { echo(substr($v["NAME"],0, 35) . "...");}else{echo $v["NAME"];};?></a>
							<?else:?>
								<?=$v["NAME"]?>
							<?endif?>
                                <div class="pull-right">
                                    <b><? echo($v["QUANTITY"] . $v["MEASURE_NAME"]); ?></b>
                                </div>
						</div>
						<?if (true):/*$category != "SUBSCRIBE") TODO */?>
							<div class="bx-basket-item-list-item-price-block">
								<?if ($arParams["SHOW_PRICE"] == "Y"):?>
									<div class="bx-basket-item-list-item-price"><strong><?=$v["PRICE_FMT"]?></strong></div>
									<?if ($v["FULL_PRICE"] != $v["PRICE_FMT"]):?>
										<div class="bx-basket-item-list-item-price-old"><?=$v["FULL_PRICE"]?></div>
									<?endif?>
								<?endif?>
								<?if ($arParams["SHOW_SUMMARY"] == "Y"):?>
									<div class="bx-basket-item-list-item-price-summ">
										<strong><?=$v["QUANTITY"]?></strong> <?=$v["MEASURE_NAME"]?> <?=GetMessage("TSB1_SUM")?>
										<strong><?=$v["SUM"]?></strong>
									</div>
								<?endif?>
							</div>
						<?endif?>
					</div>
				<?endforeach?>
			<?endforeach?>
		</div>
        <?if ($arParams["PATH_TO_ORDER"] && $arResult["CATEGORIES"]["READY"]):?>

            <div class="total_price"><span class="pull-left">СУММА ЗАКАЗА</span><span class="pull-right"><b><? echo $arResult["TOTAL_PRICE"];?></b></span></div>


            <br> <br>
            <div class="small-cart-control">
                <button type="button"class="btn btn-edit" data-toggle="modal" data-target="#myModal">Редактировать</button>

                <a href="<?=$arParams["PATH_TO_ORDER"]?>" class="btn btn-buy">Заказать</a>
            </div>
        <?endif?>
	</div>

	<script>
		BX.ready(function(){
			<?=$cartId?>.fixCart();
		});
	</script>
<?
} else {
    echo("<br><div class='text-center'>ДОБАВЬТЕ ТОВАР В КОРЗИНУ !<br></div><br>");

}

?>

