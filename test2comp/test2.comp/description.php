<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die(); $arComponentDescription = array(
"NAME" => GetMessage('COMP_NAME'),
"DESCRIPTION" => GetMessage('COMP_DESCR'),
"PATH" => array(
	"ID" => "Мои тесты 2",
	"CHILD" => array(
		"ID" => "Test2Comp",
		"NAME" => GetMessage('COMP_NAME')
	)
),
"ICON" => "/images/icon.gif",
);
?>