<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();


    $arVariables = array();
    $arComponentVariables = array(  // массив имен переменных, которые компонент может получать из запроса
);
    $arDefaultVariableAliases = ['list' => 'list','form' => 'form'];
    $arVariableAliases = CComponentEngine::MakeComponentVariableAliases(
    $arDefaultVariableAliases,
    $arParams['VARIABLE_ALIASES']
);
    $arParams['path']= $arDefaultVariableAliases["list"];
CComponentEngine::InitComponentVariables(
    false,
    $arComponentVariables, // массив имен переменных, которые компонент может получать из запроса
    $arVariableAliases,    // массив псевдонимов переменных
    $arVariables           // массив, в котором возвращаются восстановленные переменные
);

    $componentPage = '';
    if (isset($arVariables['list']))
        $componentPage = 'list';
    else
        $componentPage = 'form';


$this->IncludeComponentTemplate($componentPage);


