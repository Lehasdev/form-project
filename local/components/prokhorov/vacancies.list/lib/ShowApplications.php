<?php

namespace lib;

use Bitrix\Main\Localization\Loc;


class ShowApplications
{

    //Заголовки для таблицы заявок
    const HEADERS =
        ["NAME","SURNAME","PATRONYMIC","PHONE", "MAIL",
            "ABOUT", "CONNECT", "INTERVAL", "QUESTIONS_ANSWERS", "STATUS"];
    private static function getLocalizedName($key)
    {
        return Loc::GetMessage($key);
    }

    //Статичный метод для отрисовки таблицы без создания объекта. принимает id блока и включает проверку доступа
    public static function printApplications($iblock, $permission)
    {
        $arFilter = ["IBLOCK_ID" => $iblock, "CHECK_PERMISSIONS" => $permission];
        $arSelect = [
            "PROPERTY_NAME",
            "PROPERTY_SURNAME",
            "PROPERTY_PATRONYMIC",
            "PROPERTY_PHONE",
            "PROPERTY_EMAIL",
            "PROPERTY_COMMENT",
            "PROPERTY_CONNECT",
            "PROPERTY_CONTACT_INTERVAL",
            "PROPERTY_QUESTIONS",
            "PROPERTY_STATUS_VALUE"
        ];
        $res = \CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
        while ($el = $res->GetNext()) {

            echo '<div class="scroll-list-table">';
                echo '<table>';
                    echo '<tr>';
                        //Отрисовка заголовков таблицы
                        foreach (self::HEADERS as $prop) {
                            echo '<th class="table-th">' . self::getLocalizedName($prop).'</th>';
                    }
                    echo '</tr>';

                    echo '<tr>';
                        foreach ($arSelect as $prop) {
                            //Модифицирую имена свойств для получения свойства элементов инфоблока, добавляю перенос строки
                            echo '<td class="table-td" >' . wordwrap($el[$prop . "_VALUE"], 50, "\n", true) . '</td>';
                        }
                    echo '</tr>';
                }

                echo '</table>';
            echo '</div>';
        }

}


