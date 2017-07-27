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
                <div class="bx-basket-item-list-item">
                <div class="bx-basket-item-list-item-name">
            <table width="100%" class="cart-table">
                <tr class="cart-title text-center">
                    <td></td>
                    <td colspan="1">Фото</td>
                    <td colspan="1">Товар</td>
                    <td>Цена</td>
                    <td>Количество</td>
                    <td>Всего</td>
                </tr>
				<?foreach ($items as $v):?>


                                <tr class="main-table-row">
                                    <td>
                                        <div class="bx-basket-item-list-item-remove" onclick="<?=$cartId?>.removeItemFromCart(<?=$v['ID']?>)" title="<?=GetMessage("TSB1_DELETE")?>"></div>
                                    </td>

                                    <td>
                                        <?if ($arParams["SHOW_IMAGE"] == "Y" ){
                                            if($v["PICTURE_SRC"]){?>
                                            <a href="<?=$v["DETAIL_PAGE_URL"]?>"><img src="<?=$v["PICTURE_SRC"]?>" alt="1<?=$v["NAME"]?>"></a><?
                                            }else{?>
                                                <img src="https://cdn0.iconfinder.com/data/icons/general-line-set/512/photo-64.png" alt="2<?=$v["NAME"]?>" />
                                            <?}?>
                                        <?}?>
                                    </td>


                                    <td><a href="<?
                                        $res2 = CCatalogSku::GetProductInfo($v["PRODUCT_ID"]);
                                        $nav = CIBlockElement::GetByID($res2["ID"]);
                                        if($ar_res = $nav->GetNext())
                                            $nav2 = CIBlockSection::GetNavChain(false,$ar_res['IBLOCK_SECTION_ID']);
                                        $t = "/" . $ar_res["IBLOCK_TYPE_ID"] . "/";
                                        foreach($nav2->arResult as $chain){
                                            $t .= $chain["CODE"] . "/" ;
                                        }
                                        echo $t . $ar_res["CODE"];
                                        ?>"><?if(strlen($v["NAME"]) > 70) { echo(substr($v["NAME"],0, 70) . "...");}else{echo $v["NAME"];};?></a></td>

                                    <td class="text-center">
                                        <b><?=$v["PRICE_FORMATED"];?>&nbsp;&nbsp;</b>
                                    </td>

                                    <td>
                                        <div class="text-center quantit-table-wrap">
                                            <table cellspacing="0" cellpadding="0" class="counter ">
                                                <tr >
                                                    <?if (
                                                    floatval($v["MEASURE_RATIO"]) != 0
                                                    ):
                                                    ?>
                                                    <td id="basket_quantity_control">
                                                        <div class="basket_quantity_control">
                                                            <a href="javascript:void(0);" class="plus" onclick="setQuantity(<?=$v["ID"]?>, <?=$v["MEASURE_RATIO"]?>, 'up', <?=$useFloatQuantityJS?>);"></a>
                                                        </div>
                                                    </td>
                                                    <?
                                                    endif;?>
                                                    <td>
                                                        <?
                                                        $ratio = isset($arItem["MEASURE_RATIO"]) ? $arItem["MEASURE_RATIO"] : 0;
                                                        $useFloatQuantity = ($arParams["QUANTITY_FLOAT"] == "Y") ? true : false;
                                                        $useFloatQuantityJS = ($useFloatQuantity ? "true" : "false");
                                                        ?>
                                                        <input
                                                                type="text"
                                                                size="3"
                                                                id="QUANTITY_INPUT_<?=$arItem["ID"]?>"
                                                                name="QUANTITY_INPUT_<?=$arItem["ID"]?>"
                                                                maxlength="18"
                                                                style="max-width: 50px"
                                                                value="<?=$v["QUANTITY"]?>"
                                                                onchange="updateQuantity('QUANTITY_INPUT_<?=$v["ID"]?>', '<?=$v["ID"]?>', <?=$ratio?>, <?=$useFloatQuantityJS?>)"
                                                        >
                                                    </td>
                                                    <?
                                                    if (!isset($arItem["MEASURE_RATIO"]))
                                                    {
                                                        $v["MEASURE_RATIO"] = 1;
                                                    }

                                                    if (
                                                            floatval($v["MEASURE_RATIO"]) != 0
                                                        ):
                                                            ?>
                                                            <td id="basket_quantity_control">
                                                                <div class="basket_quantity_control">
                                                                    <a href="javascript:void(0);" class="plus" onclick="setQuantity(<?=$v["ID"]?>, <?=$v["MEASURE_RATIO"]?>, 'up', <?=$useFloatQuantityJS?>);"></a>
                                                                    <a href="javascript:void(0);" class="minus" onclick="setQuantity(<?=$v["ID"]?>, <?=$v["MEASURE_RATIO"]?>, 'down', <?=$useFloatQuantityJS?>);"></a>
                                                                </div>
                                                            </td>
                                                            <?
                                                    endif;
                                                    if (isset($arItem["MEASURE_TEXT"]))
                                                    {
                                                        ?>
                                                        <td style="text-align: left"><?=htmlspecialcharsbx($v["MEASURE_NAME"])?></td>
                                                        <?
                                                    }
                                                    ?>
                                                    <td>
                                                        &nbsp;<?echo($v["MEASURE_NAME"]);?>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <input type="hidden" id="QUANTITY_<?=$v['ID']?>" name="QUANTITY_<?=$v['ID']?>" value="<?=$v["QUANTITY"]?>" />
                                    <td class="text-center">
                                        &nbsp;<b><?echo($v["SUM"]);?></b>
                                    </td>
                                </tr>

				<?endforeach?>
                <tr >
                    <td colspan="6 " class="table-total"><br><span>ВСЕГО К ОПЛАТЕ: </span><b><?= $arResult["TOTAL_PRICE"]?></b></td>
                </tr>
            </table>
                </div>
                </div>
			<?endforeach?>
		</div>


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


