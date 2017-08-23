<?
require $_SERVER["DOCUMENT_ROOT"].'/bitrix/header.php';

$APPLICATION->SetTitle("Contacts");
$APPLICATION->SetPageProperty("title",       "Філії та металобази АВ метал груп в Україні | Металопрокат придбати. Адреси філій де можна купити металопрокат | Телефон: ☎ (056) 790-01-22");
$APPLICATION->SetPageProperty("description", "Металобази металопрокату АВ метал груп в Україні ✓ Широкий вибір ✓ Оптимальні ціни ➣ ☎ (056) 790-01-22 Телефонуйте!");
?>
    <style>
        .first-column {
            padding-right: 65px;
        }
        .second-column {
            padding-left: 65px;
            border-left: 1px solid rgb(236, 239, 241);
        }
        .page-workarea {
           background-color: white !important;
        }
    </style>

    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 av-contacts-page-block first-column">
        <h3>Head office</h3>
        <p>
            Ukraine, Dnepr,<br>
            Sholom-Aleikhema str., 5<br>
            n.: +38 (056) 790-01-22<br>
            n.: +38 (056) 790-73-00<br>
            e-mail: <a href="mailto:office@avmg.com.ua">office@avmg.com.ua</a>
        </p>
        <h3>Feedback</h3>
        <?
        $APPLICATION->IncludeComponent(
	"bitrix:form.result.new", 
	"av-en", 
	array(
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "N",
		"AJAX_OPTION_HISTORY" => "N",
		"SEF_MODE" => "N",
		"WEB_FORM_ID" => "48",
		"START_PAGE" => "new",
		"SHOW_LIST_PAGE" => "N",
		"SHOW_EDIT_PAGE" => "N",
		"SHOW_VIEW_PAGE" => "N",
		"SUCCESS_URL" => "",
		"SHOW_ANSWER_VALUE" => "N",
		"SHOW_ADDITIONAL" => "N",
		"SHOW_STATUS" => "N",
		"EDIT_ADDITIONAL" => "N",
		"EDIT_STATUS" => "N",
		"IGNORE_CUSTOM_TEMPLATE" => "N",
		"USE_EXTENDED_ERRORS" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "360000",
		"COMPONENT_TEMPLATE" => "av-en",
		"LIST_URL" => "result_list.php",
		"EDIT_URL" => "result_edit.php",
		"CHAIN_ITEM_TEXT" => "",
		"CHAIN_ITEM_LINK" => "",
		"VARIABLE_ALIASES" => array(
			"WEB_FORM_ID" => "WEB_FORM_ID",
			"RESULT_ID" => "RESULT_ID",
		)
	),
	false
);?>
    </div>
<div class="col-md-8 av-contacts-page-block second-column">
<?
$APPLICATION->IncludeComponent(
	"bitrix:news", 
	"av",
	array(
		"SEF_MODE" => "Y",
		"SEF_FOLDER" => "/contacts/",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "N",
		"AJAX_OPTION_HISTORY" => "N",
		"IBLOCK_TYPE" => "av_storages",
		"IBLOCK_ID" => "58",
		"NEWS_COUNT" => "10",
		"USE_SEARCH" => "N",
		"USE_RSS" => "N",
		"NUM_NEWS" => "",
		"NUM_DAYS" => "",
		"YANDEX" => "",
		"USE_RATING" => "N",
		"MAX_VOTE" => "",
		"VOTE_NAMES" => "",
		"USE_CATEGORIES" => "Y",
		"CATEGORY_IBLOCK" => array(
			0 => "134",
		),
		"CATEGORY_CODE" => "",
		"CATEGORY_ITEMS_COUNT" => "",
		"USE_REVIEW" => "N",
		"MESSAGES_PER_PAGE" => "",
		"USE_CAPTCHA" => "",
		"REVIEW_AJAX_POST" => "",
		"PATH_TO_SMILE" => "",
		"FORUM_ID" => "",
		"URL_TEMPLATES_READ" => "",
		"SHOW_LINK_TO_FORUM" => "",
		"POST_FIRST_MESSAGE" => "",
		"USE_FILTER" => "N",
		"FILTER_NAME" => "AV_BASES_FILTER",
		"FILTER_FIELD_CODE" => array(
			0 => "SECTION_ID",
			1 => "SUBSECTION",
		),
		"FILTER_PROPERTY_CODE" => array(
			0 => "type_bases",
			1 => "streams",
		),
		"SORT_BY1" => "PROPERTY_NAME",
		"SORT_ORDER1" => "ASC",
		"SORT_BY2" => "PROPERTY_type_bases",
		"SORT_ORDER2" => "ASC",
		"CHECK_DATES" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"LIST_ACTIVE_DATE_FORMAT" => "",
		"LIST_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"LIST_PROPERTY_CODE" => array(
			0 => "streams",
			1 => "closed",
			2 => "address",
			3 => "phone",
			4 => "cordinate_x",
			5 => "cordinate_y",
			6 => "",
		),
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"DISPLAY_NAME" => "Y",
		"META_KEYWORDS" => "-",
		"META_DESCRIPTION" => "-",
		"BROWSER_TITLE" => "-",
		"DETAIL_SET_CANONICAL_URL" => "N",
		"DETAIL_ACTIVE_DATE_FORMAT" => "",
		"DETAIL_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"DETAIL_PROPERTY_CODE" => array(
			0 => "streams",
			1 => "closed",
			2 => "address",
			3 => "phone",
			4 => "open_houres",
			5 => "cordinate_x",
			6 => "cordinate_y",
			7 => "current_action",
			8 => "additional_title",
			9 => "price_file",
			10 => "",
		),
		"SET_LAST_MODIFIED" => "N",
		"SET_TITLE" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"ADD_ELEMENT_CHAIN" => "Y",
		"USE_PERMISSIONS" => "N",
		"GROUP_PERMISSIONS" => "",
		"DETAIL_STRICT_SECTION_CHECK" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_AS_RATING" => "",
		"TAGS_CLOUD_ELEMENTS" => "",
		"PERIOD_NEW_TAGS" => "",
		"FONT_MAX" => "",
		"FONT_MIN" => "",
		"COLOR_NEW" => "",
		"COLOR_OLD" => "",
		"TAGS_CLOUD_WIDTH" => "",
		"USE_SHARE" => "Y",
		"SHARE_HIDE" => "N",
		"SHARE_TEMPLATE" => "av",
		"SHARE_HANDLERS" => array(
		),
		"SHARE_SHORTEN_URL_LOGIN" => "",
		"SHARE_SHORTEN_URL_KEY" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "108000",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "av",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_BASE_LINK" => "",
		"PAGER_PARAMS_NAME" => "",
		"SET_STATUS_404" => "Y",
		"SHOW_404" => "Y",
		"MESSAGE_404" => "",
		"FILE_404" => "",
		"FILTER_TEMPLATE" => "av",
		"FILTER_FIELDS_SORT" => array(
			0 => "SUBSECTION",
			1 => "SECTION_ID",
			2 => "type_bases",
			3 => "streams",
		),
		"FILTER_FIELDS_CHANGE_TYPE" => array(
			"streams" => "SELECT_MULTIPLE",
		),
		"LIST_TEMPLATE" => "av_bases",
		"DETAIL_TEMPLATE" => "av_bases",
		"AV_BASES_STREAMS_INFO_IBLOCK" => "136",
		"FILTER_SUBSECTION_TITLE" => "Місто",
		"SAME_ARTICLES_SEARCH_IN_SECTION" => "Y",
		"ADD_SUBSECTIONS_CHAIN" => "Y",
		"COMPONENT_TEMPLATE" => ".default",
		"CATEGORY_THEME_134" => "list",
		"AJAX_OPTION_ADDITIONAL" => "",
		"STRICT_SECTION_CHECK" => "N",
		"DETAIL_DISPLAY_TOP_PAGER" => "N",
		"DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
		"DETAIL_PAGER_TITLE" => "Страница",
		"DETAIL_PAGER_TEMPLATE" => "",
		"DETAIL_PAGER_SHOW_ALL" => "Y",
		"SEF_URL_TEMPLATES" => array(
			"news" => "",
			"section" => "",
			"detail" => "#ELEMENT_ID#/",
		)
	),
	false
);
?>
</div>
<?
require $_SERVER["DOCUMENT_ROOT"].'/bitrix/footer.php';
?>