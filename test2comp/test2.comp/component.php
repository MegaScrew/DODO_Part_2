<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Localization\Loc;

CModule::IncludeModule('crm');
CModule::IncludeModule('tasks');

// echo '<pre>';
// print_r($arParams);
// echo '</pre>';

if (isset($_POST['crm_stage'])) {

	$title = trim($_POST['deal_title']);
	$contact_id = str_replace('C_', '', $_POST['crm_contact']);
	$user_id = str_replace('U', '', $_POST['crm_user']);
	$stage_id = $_POST['crm_stage'];

	$start = new DateTimeImmutable(date('d.m.Y H:i:s'));
	$datetime = $start->modify('+7 day');
	$deadline = $datetime->format('d.m.Y H:i:s');

	if ($stage_id != 0) {
		$stage = 'C'.$stage_id.':NEW';
	}else{
		$stage = 'NEW';
	}

		/* создаем сделку */
	$arFields = array(
		"CONTACT_ID" => $contact_id,
		"TITLE" => $title,
		"STAGE_ID" => $stage,
		"CURRENCY_ID" => "RUB",
		"ASSIGNED_BY_ID" => $user_id,
		"CATEGORY_ID" => $stage_id,
	);
	$oLead = new CCrmDeal(false);
	$r = $oLead->Add($arFields, $bUpdateSearch = true, $options = array());

	/* создаем задачу */
	$arFields = Array(
		"TITLE" => $title, 
		"DESCRIPTION" => 'Задача по сделке -'.$r,
		"RESPONSIBLE_ID" => $user_id, //ответственный по задаче
		"DEADLINE" => (string)$deadline,
		"UF_CRM_TASK" => "D_".$r,
		"GROUP_ID" => $arParams["TEMPLATE_PROJECT"] //в какую группу добавляем
	);

	$obTask = new CTasks;
	$task_ID = $obTask->Add($arFields);
	if($task_ID>0) {

		header('Location: https://b24-test.dodoteam.ru/crm/deal/details/'.$r.'/');
	}
}

$res = \Bitrix\Crm\Category\DealCategory::getAll(true);

$values = [];
foreach ($res as $key => $value) {
	$values[$value['ID']] = $value['NAME'];
}

$arResult['TEMPLATE_TITLE_PAGE'] = $arParams["TEMPLATE_TITLE_PAGE"];
$arResult['TEMPLATE_PROJECT'] = $arParams["TEMPLATE_PROJECT"];	
$arResult['STAGE'] = $values;

// echo '<pre>';
// print_r($arResult);
// echo '</pre>';

$this->IncludeComponentTemplate();
?>