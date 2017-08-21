<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
use Bitrix\Main\Page\Asset;

$serverRootArray = explode('/', $_SERVER["DOCUMENT_ROOT"]);
unset($serverRootArray[count($serverRootArray) - 1]);
$templateFolderArray = explode('/', str_replace(implode('/', $serverRootArray), '', __DIR__));
unset($templateFolderArray[0]);
unset($templateFolderArray[1]);
$templateFolder = '/'.implode('/', $templateFolderArray);

CJSCore::Init(["av_form_elements", "slick_js"]);
Asset::getInstance()->addString('<script>AvCatalogElementCheckPosition = "'.CURRENT_PROTOCOL.'://'.$_SERVER["SERVER_NAME"].$templateFolder.'/ajax/check_position.php";</script>');
Asset::getInstance()->addString('<script>AvCatalogElementAskForm       = "'.CURRENT_PROTOCOL.'://'.$_SERVER["SERVER_NAME"].$templateFolder.'/ajax/ask_form.php";</script>');