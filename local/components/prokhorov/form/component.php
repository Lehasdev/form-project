<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

$arVariables = [];
// массив имен переменных, которые компонент может получать из запроса
$arComponentVariables = ['list','form'];

$arVariableAliases=[]; //массив псевдонимов

$arParams['path']= $arComponentVariables[0];

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