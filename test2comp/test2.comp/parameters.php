<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(CModule::IncludeModule("socialnetwork")){  
//здесь можно использовать функции и классы модуля
	$projects = CSocNetGroup::GetList(
	$arOrder = array("NAME" => "ASC"),
	$arFilter = array("PROJECT"=>"Y", "!ID"=>array(1,2,3)),
	$arGroupBy = false,
	$arNavStartParams = false,
	$arSelectFields = array()
	);
	$values = [];
	while($projects_list = $projects->Fetch()){
		$values[$projects_list['ID']] = $projects_list['NAME'];
	}
} else {
	$values = [1=>'Проект 1',2=>'Проект 2',3=>'Проект 3'];
}

$arComponentParameters = [
	"GROUPS" => [],
	"PARAMETERS" => [
		"TEMPLATE_TITLE_PAGE" => [
			"PARENT" => "BASE",
			"NAME" => GetMessage('TEMPLATE_TITLE_PAGE'),
			"TYPE" => "STRING",
			"DEFAULT" => "Заголовок страницы"
		],
		"TEMPLATE_PROJECT" => [
			"PARENT" => "LIST",
			"NAME" => GetMessage('TEMPLATE_PROJECT'),
			"TYPE" => "LIST",
			"VALUES" => $values,
			"MULTIPLE" => "N",
		]
	],
];
?>