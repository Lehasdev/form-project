<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);
class ProkhorovVacanciesForm extends \CBitrixComponent{
    public function executeComponent() {
        // Получение параметров компонента
        $iblockQuestions = $this->arParams["QUESTIONS_ID"];
        $iblockId = $this->arParams["APPLICATIONS_ID"];
        $pathToList =$this->arParams["LIST_PATH"];
        // Проверка разрешений
        if (\lib\FormListHandler::toCheckPermission($iblockId)) {
            $this->arResult['SHOW_LINK_TO_LIST'] = true;
            $this->arResult['PATH_TO_LIST'] = $pathToList;
        } else {
            $this->arResult['SHOW_LINK_TO_LIST'] = false;
        }

        // Обработка формы при каждой загрузке страницы
        $this->prepareForm($iblockId);

        // Передача переменных в шаблон
        $this->arResult['IBLOCK_QUESTIONS'] = \lib\FormListHandler::toDrawQuestionsBlockName($iblockQuestions);
        $this->arResult['SELECT_LIST'] = \lib\FormListHandler::toDrawSelect();
        $this->arResult['IBLOCK_ID'] = $iblockId;
        $this->arResult['PATH_TO_LIST'] = $pathToList;
        \lib\FormHandler::init();
        $this->arResult["msg-default"]= \lib\FormHandler::$messageDefault;

        // Включение шаблона
        $this->includeComponentTemplate();
    }
    protected function prepareForm($iblockId) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Создаем экземпляр обработчика
            $formHandler = new \lib\FormHandler($iblockId);
            // Обрабатываем форму
            $result = $formHandler->processForm($_POST);


            // Проверяем результат и выводим сообщение
            if ($result != 'true') {
                $this->arResult['message'] = $result;
            } else {
                header("Location: {$_SERVER['PHP_SELF']}?h=success");
                exit();
            }
        }
    }
}