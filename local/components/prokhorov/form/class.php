<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

class ProkhorovVacanciesFormCom extends \CBitrixComponent
{
    private $arVariables = [];
    private $arComponentVariables = ['list','form'];
    private $arVariableAliases=[];
    private $componentPage = '';

    public function executeComponent()
    {
        $this->arParams['path']= $this->arComponentVariables[0];
        CComponentEngine::InitComponentVariables(
            false,
            $this->arComponentVariables, // массив имен переменных, которые компонент может получать из запроса
            $this->arVariableAliases,    // массив псевдонимов переменных
            $this->arVariables   // массив, в котором возвращаются восстановленные переменные
        );


        if (isset($this->arVariables['list']))
            $this->componentPage = 'list';
        else
            $this->componentPage = 'form';


        $this->IncludeComponentTemplate($this->componentPage);
    }
}
