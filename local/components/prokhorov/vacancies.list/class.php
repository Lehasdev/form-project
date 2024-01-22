<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
class ProkhorovVacanciesList extends \CBitrixComponent{
    public function executeComponent() {
        // Получение параметров компонента
        $iblockId = $this->arParams["INFO_ID"];
        $this->arResult["INFO_ID"] = $iblockId;
        $this->includeComponentTemplate();


    }
}