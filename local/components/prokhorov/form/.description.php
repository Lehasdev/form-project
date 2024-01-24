<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
    'NAME' => GetMessage("FORM_NAME"),
    'DESCRIPTION' => GetMessage("FORM_DESC"),
    'CACHE_PATH' => 'Y',
    'SORT' => 40,
    'COMPLEX' => 'Y',
    'PATH' => array(
        'ID' => "form.vacancies",
        'NAME' => GetMessage("VACANCIES_FORM_NAME"),

    )
);