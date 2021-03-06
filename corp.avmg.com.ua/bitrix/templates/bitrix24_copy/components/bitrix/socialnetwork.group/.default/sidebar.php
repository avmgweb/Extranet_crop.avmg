<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>

<div class="socialnetwork-group-sidebar-block">
	<div class="socialnetwork-group-sidebar-block-inner">
	<? if ($arResult["CanView"]["content_search"]):?>
		<div class="socialnetwork-group-search">
			<div class="socialnetwork-group-search-item">
				<form class="socialnetwork-group-search-form" action="<?=$arResult["Urls"]["content_search"]?>">
					<input
						class="socialnetwork-group-search-field"
						type="text"
						name="q"
						placeholder="<?=GetMessage("SONET_UM_SEARCH_BUTTON_TITLE")?>"
					>
					<span class="socialnetwork-group-search-icon"></span>
				</form>
			</div>
		</div>
	<? endif ?>
	
	<? if ($arResult["Owner"]):
		$userName = \CUser::FormatName(
			str_replace(array("#NOBR#", "#/NOBR#"), array("", ""), $arParams["NAME_TEMPLATE"]),
			array(
				"ID" => $arResult["Owner"]["USER_ID"],
				"NAME" => htmlspecialcharsback($arResult["Owner"]["USER_NAME"]),
				"LAST_NAME" => htmlspecialcharsback($arResult["Owner"]["USER_LAST_NAME"]),
				"SECOND_NAME" => htmlspecialcharsback($arResult["Owner"]["USER_SECOND_NAME"]),
				"LOGIN" => htmlspecialcharsback($arResult["Owner"]["USER_LOGIN"])
			),
			$arParams["SHOW_LOGIN"] != "N"
		);
		
		$avatar = $arResult["Owner"]["USER_PERSONAL_PHOTO_FILE"]["SRC"]; 
		?>
		<div class="socialnetwork-group-users">
			<div class="socialnetwork-group-users-inner socialnetwork-group-owner">
				<div class="socialnetwork-group-title"><?=GetMessage("SONET_C6_OWNER")?></div>
				<div class="socialnetwork-group-users-list">
					<div class="socialnetwork-group-user socialnetwork-group-owner-user">
						<a
							class="socialnetwork-group-user-avatar user-default-avatar"
							href="<?=htmlspecialcharsback($arResult["Owner"]["USER_PROFILE_URL"])?>"
							<? if ($avatar):?>
								style="background: url('<?=$avatar?>'); background-size: cover"
							<? endif ?>
						>
						</a>
						<div class="socialnetwork-group-user-info">
							<div class="socialnetwork-group-user-name
								<?=($arResult["Owner"]["USER_IS_EXTRANET"] == "Y" ?
								" socialnetwork-group-user-name-extranet" : "")?>">
								<a href="<?=htmlspecialcharsback($arResult["Owner"]["USER_PROFILE_URL"])?>"><?=$userName?></a>
							</div>
							<div class="socialnetwork-group-user-position"><?
								if (IsModuleInstalled("intranet") && strlen($arResult["Owner"]["USER_WORK_POSITION"]) > 0):
									?><?=$arResult["Owner"]["USER_WORK_POSITION"]?><?
								elseif ($arResult["Owner"]["USER_IS_EXTRANET"] == "Y"):
									?><?=GetMessage("SONET_C6_USER_IS_EXTRANET")?><?
								else:
									?>&nbsp;<?
								endif;
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?endif; ?>
	<table cellspacing="0" class="socialnetwork-group-layout">
		<tr class="socialnetwork-group-layout-row">
			<td class="socialnetwork-group-layout-left-column"><?=GetMessage("SONET_C6_CREATED")?>:</td>
			<td class="socialnetwork-group-layout-right-column">
				<?=FormatDateFromDB($arResult["Group"]["DATE_CREATE"], $arParams["DATE_TIME_FORMAT"], true)?>
			</td>
		</tr>
		<tr class="socialnetwork-group-layout-row">
			<td class="socialnetwork-group-layout-left-column"><?=GetMessage("SONET_C6_NMEM")?>:</td>
			<td class="socialnetwork-group-layout-right-column"><?=$arResult["Group"]["NUMBER_OF_MEMBERS"]?></td>
		</tr>
		<tr class="socialnetwork-group-layout-row">
			<td class="socialnetwork-group-layout-left-column"><?=GetMessage("SONET_C6_TYPE")?>:</td>
			<td class="socialnetwork-group-layout-right-column"><?
				if ($arResult["Group"]["OPENED"] == "Y" && $arResult["Group"]["VISIBLE"] == "Y")
					echo GetMessage("SONET_C6_TYPE_O1_V1");
				elseif ($arResult["Group"]["OPENED"] == "Y" && $arResult["Group"]["VISIBLE"] == "N")
					echo GetMessage("SONET_C6_TYPE_O1_V2");
				elseif ($arResult["Group"]["OPENED"] == "N" && $arResult["Group"]["VISIBLE"] == "Y")
					echo GetMessage("SONET_C6_TYPE_O2_V1");
				elseif ($arResult["Group"]["OPENED"] == "N" && $arResult["Group"]["VISIBLE"] == "N")
					echo GetMessage("SONET_C6_TYPE_O2_V2");
				?>
			</td>
		</tr>
		<?
		if (!empty($arResult["GroupDepartments"])):
			?><tr class="socialnetwork-group-layout-row">
				<td class="socialnetwork-group-layout-left-column"><?=GetMessage("SONET_C6_DEPARTMENTS")?>:</td>
				<td class="socialnetwork-group-layout-right-column"><?
					$arDepartmentFormatted = array();
					foreach($arResult["GroupDepartments"] as $arDepartment)
					{
						$arDepartmentFormatted[] = '<a href="'.$arDepartment["URL"].'">'.$arDepartment["NAME"].'</a>';
					}
					echo implode(', ', $arDepartmentFormatted);
					?></td>
			</tr><?
		endif;
		if ($arResult["GroupProperties"]["SHOW"] === "Y"):
			foreach ($arResult["GroupProperties"]["DATA"] as $fieldName => $arUserField):
				if (
					(is_array($arUserField["VALUE"]) && count($arUserField["VALUE"]) > 0) ||
					(!is_array($arUserField["VALUE"]) && strlen($arUserField["VALUE"]) > 0)
				):
					?>
					<tr class="socialnetwork-group-layout-row">
						<td class="socialnetwork-group-layout-left-column"><?=$arUserField["EDIT_FORM_LABEL"]?>:</td>
						<td class="socialnetwork-group-layout-right-column"><?
							$GLOBALS["APPLICATION"]->IncludeComponent(
								"bitrix:system.field.view",
								$arUserField["USER_TYPE"]["USER_TYPE_ID"],
								array("arUserField" => $arUserField),
								null,
								array("HIDE_ICONS"=>"Y")
							);
							?>
						</td>
					</tr><?
				endif;
			endforeach;
		endif;?>
	</table><?
	if (
		strlen($arResult["Group"]["DESCRIPTION"]) > 0 &&
		$arResult["Group"]["DESCRIPTION"] !== GetMessage("SONET_GCE_T_DESCR") &&
		!$arResult["bUserCanRequestGroup"]
	):
		$desc = $arResult["Group"]["DESCRIPTION"];
		$descEnding = "";
		$maxLength = 250;
		if (strlen($desc) > $maxLength)
		{
			$descEnding = substr($desc, $maxLength);
			$desc = substr($desc, 0, $maxLength);
		}

	?>
		<div class="socialnetwork-group-desc-box">
			<div class="socialnetwork-group-title"><?=GetMessage("SONET_C6_DESCR")?></div>
			<div class="socialnetwork-group-desc-text"><?
				echo $desc;
				if (strlen($descEnding) > 0):
					?><span class="socialnetwork-group-desc-more">...
						<span
							class="socialnetwork-group-desc-more-link"
							onclick="BX.addClass(this.parentNode.parentNode, 'socialnetwork-group-desc-open')"
						>
							<?=GetMessage("SONET_C6_MORE")?>
						</span>
					</span><span class="socialnetwork-group-desc-full"><?=$descEnding?></span>
				<? endif ?>
			</div>
		</div><?
	endif;

	if ($arResult["Moderators"]["List"]):
		$itemsLimit = 3;
		?>
		<div class="socialnetwork-group-users socialnetwork-group-moderator">
			<div class="socialnetwork-group-users-inner">
				<div class="socialnetwork-group-title"><?=GetMessage("SONET_C6_ACT_MOD1")?>
					<? if (count($arResult["Moderators"]["List"]) > $itemsLimit):?>
						(<a
							href="<?=htmlspecialcharsback($arResult["Urls"]["GroupMods"])?>"><?
							echo $arResult["Group"]["NUMBER_OF_MODERATORS"]
							?></a>)
					<? endif ?>

					<? if (
						$arResult["CurrentUserPerms"]["UserCanModifyGroup"] &&
						$GLOBALS["USER"]->IsAuthorized() &&
						!$arResult["HideArchiveLinks"]
					):?>
						<a
							class="socialnetwork-group-title-link"
							href="<?=htmlspecialcharsback($arResult["Urls"]["GroupMods"])?>"><?
								echo GetMessage("SONET_C6_ACT_MOD")?>
						</a>
					<? endif ?>
				</div>
				<div class="socialnetwork-group-users-list">
					<? foreach ($arResult["Moderators"]["List"] as $friend):

						if (!$itemsLimit--)
						{
							break;
						}

						$userName = CUser::FormatName(
							str_replace(array("#NOBR#", "#/NOBR#"), array("", ""), $arParams["NAME_TEMPLATE"]),
							array(
								"ID" => $friend["USER_ID"],
								"NAME" => htmlspecialcharsback($friend["USER_NAME"]),
								"LAST_NAME" => htmlspecialcharsback($friend["USER_LAST_NAME"]),
								"SECOND_NAME" => htmlspecialcharsback($friend["USER_SECOND_NAME"]),
								"LOGIN" => htmlspecialcharsback($friend["USER_LOGIN"])
							),
							$arParams["SHOW_LOGIN"] != "N"
						);

						$avatar = $friend["USER_PERSONAL_PHOTO_FILE"]["SRC"];
					?>
						<div class="socialnetwork-group-user">
							<a
								class="socialnetwork-group-user-avatar user-default-avatar"
								href="<?=htmlspecialcharsback($friend["USER_PROFILE_URL"])?>"
								<? if ($avatar): ?>
									style="background: url('<?=$avatar?>'); background-size: cover"
								<? endif ?>
							>
							</a>
							<div class="socialnetwork-group-user-info">
								<div class="socialnetwork-group-user-name
									<?=($friend["USER_IS_EXTRANET"] === "Y" ?
									" socialnetwork-group-user-name-extranet" : "")?>
								">
									<a href="<?=htmlspecialcharsback($friend["USER_PROFILE_URL"])?>"><?=$userName?></a>
								</div>
								<div class="socialnetwork-group-user-position"><?
									if (IsModuleInstalled("intranet") && strlen($friend["USER_WORK_POSITION"]) > 0):
										?><?=$friend["USER_WORK_POSITION"]?><?
									elseif ($friend["USER_IS_EXTRANET"] == "Y"):
										?><?=GetMessage("SONET_C6_USER_IS_EXTRANET")?><?
									else:
										?>&nbsp;<?
									endif;
									?>
								</div>
							</div>
						</div>
					<? endforeach ?>
				</div>
			</div>
		</div><?
	endif;

	if ($arResult["Members"]["List"]): ?>
		<div class="socialnetwork-group-users socialnetwork-group-member">
			<div class="socialnetwork-group-users-inner">
				<div class="socialnetwork-group-title">
					<?=GetMessage("SONET_C6_ACT_USER1")?>
					(<a
						href="<?=htmlspecialcharsback($arResult["Urls"]["GroupUsers"])?>"><?
							echo $arResult["Group"]["NUMBER_OF_MEMBERS"]
					?></a>)<?

					if (
						$GLOBALS["USER"]->IsAuthorized() &&
						$arResult["CurrentUserPerms"]["UserCanInitiate"] &&
						!$arResult["HideArchiveLinks"]
					):
						?><span
							class="socialnetwork-group-title-link"
							onclick="BX.SGCP.ShowForm('invite', '<?=$popupName?>', event)"
						><?=GetMessage("SONET_C6_ACT_REQU")?></span><?
					endif;
					?>
				</div>
				<div class="socialnetwork-group-users-list"><?
				foreach ($arResult["Members"]["List"] as $friend):

					$userName = CUser::FormatName(
						str_replace(array("#NOBR#", "#/NOBR#"), array("", ""), $arParams["NAME_TEMPLATE"]),
						array(
							"ID" => $friend["USER_ID"],
							"NAME" => htmlspecialcharsback($friend["USER_NAME"]),
							"LAST_NAME" => htmlspecialcharsback($friend["USER_LAST_NAME"]),
							"SECOND_NAME" => htmlspecialcharsback($friend["USER_SECOND_NAME"]),
							"LOGIN" => htmlspecialcharsback($friend["USER_LOGIN"])
						),
						$arParams["SHOW_LOGIN"] != "N"
					);

					$avatar = $friend["USER_PERSONAL_PHOTO_FILE"]["SRC"];
					?>
					<div
						class="socialnetwork-group-user socialnetwork-group-member-user
						<?=($friend["USER_IS_EXTRANET"] === "Y" ? "socialnetwork-group-extranet-user" : "")?>">
						<a
							href="<?=htmlspecialcharsback($friend["USER_PROFILE_URL"])?>"
							class="socialnetwork-group-member-avatar user-default-avatar"
							title="<?=$userName?>"
							<? if ($avatar): ?>
								style="background: url('<?=$avatar?>'); background-size: cover"
							<? endif ?>
						>
						</a>
					</div><?
					endforeach;
					?>
				</div>
			</div>
		</div><?
	endif ?>
	</div>
</div>


<?
ob_start();

global $arContentFilter;
$arContentFilter = array(
	"!ITEM_ID" => "G".$arParams["GROUP_ID"],
	"PARAMS" => array("socnet_group" => $arParams["GROUP_ID"])
);

$tagsCnt = $GLOBALS["APPLICATION"]->IncludeComponent(
	"bitrix:search.tags.cloud",
	"",
	Array(
		"PAGE_ELEMENTS" => $arParams["SEARCH_TAGS_PAGE_ELEMENTS"],
		"PERIOD" => $arParams["SEARCH_TAGS_PERIOD"],
		"URL_SEARCH" =>
			CComponentEngine::MakePathFromTemplate(
				$arParams["~PATH_TO_GROUP_CONTENT_SEARCH"],
				array("group_id" => $arParams["GROUP_ID"])
			),
		"FONT_MAX" => 30,
		"FONT_MIN" => 12,
		"COLOR_NEW" => $arParams["SEARCH_TAGS_COLOR_NEW"],
		"COLOR_OLD" => $arParams["SEARCH_TAGS_COLOR_NEW"],
		"WIDTH" => "100%",
		"SORT" => "NAME",
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"FILTER_NAME" => "arContentFilter",
	),
	false,
	array("HIDE_ICONS" => "Y")
);

$tagsCloud = "";
if ($tagsCnt > 0)
{
	$tagsCloud = ob_get_contents();
}

ob_end_clean();
?>

<? if (strlen($tagsCloud) > 0): ?>
	<div class="socialnetwork-group-sidebar-block" style="margin-top: 10px;">
		<div class="socialnetwork-group-sidebar-block-inner"><?=$tagsCloud?></div>
	</div>
<? endif ?>