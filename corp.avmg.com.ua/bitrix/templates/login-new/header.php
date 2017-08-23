<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/".SITE_TEMPLATE_ID."/header.php");
CUtil::InitJSCore(array("popup", "fx"));
CJSCore::RegisterExt("bootstrap",    ["css" => "/bitrix/css/av_site/bootstrap.supermin.css"]);
CJSCore::RegisterExt("font_awesome", ["css" => "/bitrix/css/main/font-awesome.css"]);
CJSCore::Init(["bootstrap","font_awesome"]);
?><!DOCTYPE html>
<html>
<head>
	<title><?$APPLICATION->ShowTitle();?></title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, width=device-width">
	<meta name="robots" content="noindex, nofollow" />
	<?if (IsModuleInstalled("bitrix24")):?>
	<meta name="apple-itunes-app" content="app-id=561683423">
	<link rel="apple-touch-icon-precomposed" href="/images/iphone/57x57.png" />
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="/images/iphone/72x72.png" />
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="/images/iphone/114x114.png" />
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="/images/iphone/144x144.png" />
	<?endif?>
	<?$APPLICATION->ShowHead();?>
</head>
<body>
<?
/*
This is commented to avoid Project Quality Control warning
$APPLICATION->ShowPanel();
*/
?>
<table class="log-main-table">
	<?/*<tr>
		<td class="log-top-cell">
			<a class="main-logo main-logo-<?if (LANGUAGE_ID === "ru"):?>ru<?elseif(LANGUAGE_ID === "ua"):?>ua<?else:?>en<?endif?>" href="/" title="<?=GetMessage("BITRIX24_TITLE")?>"></a>
		</td>
	</tr>*/?>
	<tr>
		<td class="log-main-cell">
			<div class="log-popup-wrap <?echo $APPLICATION->ShowProperty("popup_class","")?>" id="login-popup-wrap">
				<div class="log-popup" id="login-popup">
					<div class="text-center main-logo"><img src="/bitrix/templates/login-new/images/logo_AVMG_WHITE.svg" alt="" /></div>
