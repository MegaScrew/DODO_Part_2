<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
	$APPLICATION->SetTitle($arResult['TEMPLATE_TITLE_PAGE']);
	// \Bitrix\Main\Diag\Debug::dump($arParams);
    // \Bitrix\Main\Diag\Debug::dump($arResult);
	// if (isset($_POST['crm_stage'])) {
	// 	// use \Bitrix\Tasks;
	// 	// use \Bitrix\Crm\DealTable;

	// 	//header('Location: https://b24-test.dodoteam.ru/crm/deal/details/56/');
	// }
	// echo '<pre>';
	// 	print_r($_POST);
	// echo '</pre>';
?>
	<div class="container">
		<h2>Форма добавления сделки и задачи в проект</h2>
		<form action="#" method="POST">
			<label for="deal_title">Название сделки:</label>
			<input type="text" name="deal_title">
			<label for="crm_stage">Направление сделки:</label>
			<select name=crm_stage>
				<?
					foreach ($arResult['STAGE'] as $key => $value) {
						echo '<option value="'.$key.'">'.$value.'</option>';
					}
				?>
			</select>
			<input type="hidden" name="crm_contact">
			<input type="hidden" name="crm_user">
			<?
				$APPLICATION->IncludeComponent(
				'bitrix:main.user.selector',
				' ',
				[
				   "ID" => "contact_select",
				   "API_VERSION" => 3,
				   "LIST" => array_keys($crmQueueSelected),
				   "INPUT_NAME" => "crm_contact",
				   "USE_SYMBOLIC_ID" => true,
				   "BUTTON_SELECT_CAPTION" => GetMessage("CONTACT_ADD"),
				   "SELECTOR_OPTIONS" => 
				    [
						'context' => "my_context",
						'contextCode' => '',
						'enableSonetgroups' => 'N',
						'enableUsers' => 'N',
						'useClientDatabase' => 'N',
						'enableAll' => 'N',
						'enableDepartments' => 'N',
						'enableCrm' => 'Y',
						'crmPrefixType' => 'SHORT',
						'enableCrmContacts' => 'Y',
						'addTabCrmContacts' => 'Y',
				    ]
				]
				);

				$APPLICATION->IncludeComponent(
				'bitrix:main.user.selector',
				' ',
				[
				   "ID" => "user_select",
				   "API_VERSION" => 3,
				   "LIST" => array_keys($crmQueueSelected),
				   "INPUT_NAME" => "crm_user",
				   "USE_SYMBOLIC_ID" => true,
				   "BUTTON_SELECT_CAPTION" => GetMessage("USER_ADD"),
				   "SELECTOR_OPTIONS" => 
				    [
				      "departmentSelectDisable" => "Y",
				      'context' => 'MAIL_CLIENT_CONFIG_QUEUE',
				      'contextCode' => 'U',
				      'enableAll' => 'N',
				      'userSearchArea' => 'I',
				      'enableProjects' => 'Y',
				    ]
				]
				);
			?>
			<input type="submit" value="<?=GetMessage("FORM_BUTTON");?>">
		</form>
	</div>
		

<?



	

	

?>