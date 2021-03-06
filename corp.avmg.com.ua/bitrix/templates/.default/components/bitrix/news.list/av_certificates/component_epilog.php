<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
use Bitrix\Main\Page\Asset;

$serverRootArray = explode('/', $_SERVER["DOCUMENT_ROOT"]);
unset($serverRootArray[count($serverRootArray) - 1]);

$templateFolderArray = explode('/', str_replace(implode('/', $serverRootArray), '', __DIR__));
unset($templateFolderArray[0]);
unset($templateFolderArray[1]);
$templateFolder = '/'.implode('/', $templateFolderArray);

CJSCore::Init(["wait_for_images"]);
Asset::getInstance()->addString('<script>AvVsCertifitacesListElementFile = "'.CURRENT_PROTOCOL.'://'.SITE_SERVER_NAME.$templateFolder.'/ajax/element.php";</script>');
AvComponentsIncludings::getInstance()->setIncludings("bitrix", "news.detail", "av_certificates");