<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die()?>
<div class="av-search-page">
	<form method="get">
		<?
		$APPLICATION->IncludeComponent
			(
			"av:form_elements", "",
				[
				"TYPE"  => 'element_search',
				"NAME"  => 'q',
				"VALUE" => $arResult["REQUEST"]["QUERY"],
				"ATTR"  => 'size="40" autocomplete="off"'
				]
			);
		$APPLICATION->IncludeComponent
			(
			"av:form_elements", "av_site",
				[
				"TYPE"        => 'button',
				"BUTTON_TYPE" => 'submit',
				"TITLE"       => GetMessage("AV_SEARCH_PAGE_SEARCH")
				]
			);
		?>
		<input type="hidden" name="how" value="<?=$arResult["REQUEST"]["HOW"] == 'd' ? 'd': 'r'?>">
	</form>

	<?if($arParams["DISPLAY_TOP_PAGER"] == 'Y' && count($arResult["SEARCH"])):?>
	<div class="pagger-cell top">
		<?=$arResult["NAV_STRING"]?>
	</div>
	<?endif?>

	<?if(!count($arResult["SEARCH"])):?>
		<?=GetMessage("AV_SEARCH_PAGE_EMPTY")?>
		<?if($arParams["PRODUCTS_LINK"]):?>
		<div class="products-link-cell">
			<?
			$APPLICATION->IncludeComponent
				(
				"av:form_elements", "av_site_alt",
					[
					"TYPE"        => 'button',
					"BUTTON_TYPE" => 'link',
					"LINK"        => $arParams["PRODUCTS_LINK"],
					"TITLE"       => GetMessage("AV_SEARCH_PRODUCTS_LINK")
					]
				);
			?>
		</div>
		<?endif?>
	<?endif?>

	<?if(count($arResult["SEARCH"])):?>


        <div><span>Найдено товаров: <?echo count($arResult["SEARCH"]);?></span></div>
        <br>
        <div class="filter-area"><span><u>Найдено в категориях:</u></span>
            <?
            $arreyMain = array();
            foreach($arResult["SEARCH"] as $arItem):
                        if(!empty($arItem["BODY"])){
                            foreach ($arItem[0] as $arItem2){
                                foreach ($arItem2 as $arItem3 => $value){
                                    if ($value["NAME"]){
                                        $count = count($arItem2) - 1;
                                        if($count  == $arItem3) {
                                            if(in_array($value["ID"], $arreyMain)){}else { array_push($arreyMain, $value["ID"]);
                                                ?><a href="<?$query = $_GET;
                                                            $query['filter'] = $value["NAME"];
                                                            $query_result = http_build_query($query);
                                                            echo $_SERVER['PHP_SELF']; ?>?<?php echo $query_result; ?>"><?=$value["NAME"]?></a> | <?


                                            }
                                        }
                                    }
                                }

                            }

                        }
                        ?>
            <?endforeach?>
            <button type="button" class="btn btn-default">
                <a style="color: red" href="<?$query = $_GET;
                $query['filter'] = "";
                $query_result = http_build_query($query);
                echo $_SERVER['PHP_SELF']; ?>?<?php echo $query_result; ?>"><b>Отмена фильтра</b></a></button>

        </ul>
           <br>
<?
$query = $_GET;
if($query['filter']) {
?><h4><?
echo "Выведены товары раздела: " . $query['filter'];
?></h4><?
}
?>
        </div>
        <br>
        <div class="items-list">
            <?foreach($arResult["SEARCH"] as $arItem):?>
                <?$test = end($arItem["0"]->arResult);

                ?>
            <?
                    if(!empty($arItem["BODY"])){
                        $query = $_GET;
                        if($query['filter']){
                            if( $query['filter'] == $test["NAME"] ){
                                ?>
                                <div class="col-md-3 text-center">
                                <b><a href="<?
                                    $res = CIBlockElement::GetByID($arItem["ITEM_ID"]);
                                    $ar = $res->GetNext();
                                    $t = "/catalog/";

                                    foreach($arItem["0"]->arResult as $linksURL) {
                                        $t .= $linksURL["CODE"] . "/";
                                    }
                                    echo  $t . $ar["CODE"];
                                    ?>"><?=strip_tags($arItem["TITLE_FORMATED"])?></a></b>
                                <div><?=$arItem["BODY_FORMATED"]?></div>
                                </div><?
                            }
                        } else {?>
                                <div class="col-md-12 text-center">

<?$res2 = CIBlockElement::GetByID($arItem["ITEM_ID"]);
    $iblock_id = $arItem["ITEM_ID"];
    $my_elements = CIBlockElement::GetList (
        Array("ID" => "ASC"),
        Array("IBLOCK_ID" => $iblock_id),
        false,
        false,
        Array('ID', 'NAME', 'DETAIL_PAGE_URL', 'PREVIEW_PICTURE', 'DETAIL_PICTURE')
    );

    while($ar_fields = $my_elements->GetNext())
    {
        //echo $ar_fields['PREVIEW_PICTURE']." <br>";
        $img_path = CFile::GetPath($ar_fields["PREVIEW_PICTURE"]);
        echo $img_path." <br>";
    }
?>
                                                    <b><a href="<?
                                                        $res = CIBlockElement::GetByID($arItem["ITEM_ID"]);

                                                        $ar = $res->GetNext();
                                                        $t = "/catalog/";

                                                        foreach($arItem["0"]->arResult as $linksURL) {
                                                            $t .= $linksURL["CODE"] . "/";
                                                        }
                                                        echo  $t . $ar["CODE"];
                                                        ?>"><?=strip_tags($arItem["TITLE_FORMATED"])?></a></b>
                                    <div><?=$arItem["BODY_FORMATED"]?></div>
                                </div>

                            <?
                        }
                    }
            endforeach?>
	    </div>
	<?endif?>

	<?if($arParams["DISPLAY_BOTTOM_PAGER"] == 'Y' && count($arResult["SEARCH"])):?>
	<div class="pagger-cell bottom">
		<?=$arResult["NAV_STRING"]?>
	</div>
	<?endif?>
</div>
