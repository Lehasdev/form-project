<?php


if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();


if (!CModule::IncludeModule('iblock')) {
    return;
}


$arInfoBlockTypes = CIBlockParameters::GetIBlockTypes();


$arInfoBlocks = array();
$arFilter = array('ACTIVE' => 'Y');

if (!empty($arCurrentValues['IBLOCK_TYPE'])) {
    $arFilter['TYPE'] = $arCurrentValues['IBLOCK_TYPE'];
}
$rsIBlock = CIBlock::GetList(
    array('SORT' => 'ASC'),
    $arFilter
);
while($iblock = $rsIBlock->Fetch()) {
    $arInfoBlocks[$iblock['ID']] = '['.$iblock['ID'].'] '.$iblock['NAME'];
}




$arComponentParameters = array(

    'PARAMETERS' => array(


        'IBLOCK_TYPE' => array(
            'PARENT' => 'BASE',
            'NAME' => GetMessage("TYPE_INFO"),
            'TYPE' => 'LIST',
            'VALUES' => $arInfoBlockTypes,
            'REFRESH' => 'Y',
        ),
        'IBLOCK_QUESTIONS' => array(
            'PARENT' => 'BASE',
            'NAME' => GetMessage("IBLOCK_QUESTIONS"),
            'TYPE' => 'LIST',
            'VALUES' => $arInfoBlocks,
            'REFRESH' => 'Y',
        ),
        'IBLOCK_APPLICATIONS' => array(
            'PARENT' => 'BASE',
            'NAME' => GetMessage("IBLOCK_APPLICATIONS"),
            'TYPE' => 'LIST',
            'VALUES' => $arInfoBlocks,
            'REFRESH' => 'Y',
        ),

        'VARIABLE_ALIASES' => array(
            'list' => array(),
            'form' => array(),
        ),
        'SEF_MODE' => array(

            'list' => array(
                'NAME' => '',
                'DEFAULT' => '',
            ),
            'form' => array(
                'NAME' => '',
                'DEFAULT' => '',
            ),
        ),

    )
);
