<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
use Bitrix\Main\Loader;
if (!Loader::includeModule('iblock'))
{
    return;
}
$iblockExists = (!empty($arCurrentValues['IBLOCK_ID']) && (int)$arCurrentValues['IBLOCK_ID'] > 0);


$arIBlocks = [];
$iblockFilter = [
    'ACTIVE' => 'Y',
];

$db_iblock = CIBlock::GetList(["SORT"=>"ASC"], $iblockFilter);
while($arRes = $db_iblock->Fetch())
{
    $arIBlocks[$arRes["ID"]] = "[" . $arRes["ID"] . "] " . $arRes["NAME"];
}

    $arComponentParameters = [
        "PARAMETERS" => [

            "QUESTIONS_ID" => [
                "PARENT" => "BASE",
                "NAME" => GetMessage("QUESTIONS_ID_PARAM_NAME"),
                "TYPE" => "LIST",
                "VALUES" => $arIBlocks,
                "ADDITIONAL_VALUES" => "Y",
                "REFRESH" => "Y",
            ],
            "APPLICATIONS_ID" => [
                "PARENT" => "BASE",
                "NAME" => GetMessage("APPLICATIONS_ID_PARAM_NAME"),
                "TYPE" => "LIST",
                "VALUES" => $arIBlocks,
                "ADDITIONAL_VALUES" => "Y",
                "REFRESH" => "Y",
            ],

            "LIST_PATH" => [
                "PARENT" => "BASE",
                "NAME" => GetMessage("LIST_PATH_PARAM_NAME"),
                "TYPE" => "STRING",
                "DEFAULT" => "/vakansii/spisok-zayavok.php",
                "REFRESH" => "Y",
            ],
        ],
    ];

?>