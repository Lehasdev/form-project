<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();


    $arVariables = array();


    CComponentEngine::InitComponentVariables(
        false,
        null,
        $arParams['VARIABLE_ALIASES'],
        $arVariables
    );

    $componentPage = '';
    if (isset($arVariables['list']))
        $componentPage = 'list';
    else
        $componentPage = 'form';


$this->IncludeComponentTemplate($componentPage);


