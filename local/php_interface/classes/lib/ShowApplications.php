<?php

namespace lib;

class ShowApplications
{

    //Заголовки для таблицы заявок
    const HEADERS =["Имя","Фамилия","Отчество","Телефон", "Почта",
        "Комментарий", "Связь", "Интервал", "Ответы на вопросы","Файлы", "Статус"];
    //Статичный метод для отрисовки таблицы без создания объекта. принимает id блока и включает проверку доступа
    public static function printApplications($iblock,$permission)
    {
        $arFilter= ["IBLOCK_ID"=>$iblock, "CHECK_PERMISSIONS" => $permission];
        $arSelect =["PROPERTY_NAME","PROPERTY_SURNAME","PROPERTY_PATRONYMIC","PROPERTY_PHONE","PROPERTY_EMAIL","PROPERTY_COMMENT",
        "PROPERTY_CONNECT","PROPERTY_CONTACT_INTERVAL","PROPERTY_QUESTIONS","PROPERTY_UPLOADED_FILES","PROPERTY_STATUS_VALUE"];
        $res = \CIBlockElement::GetList( [], $arFilter, false,false, $arSelect);
        while ($el=$res->GetNext()) {
            echo '<div class="scroll">';
            echo '<table border="1">';
            echo '<tr>';
            //Отрисовка заголовков таблицы
            foreach (self::HEADERS as $prop) {
                echo '<th>' . $prop . '</th>';
            }
            echo '</tr>';
            while ($el = $res->GetNext()) {
                echo '<tr>';
                foreach ($arSelect as $prop) {
                    //Модифицирую имена свойств для получения свойства элементов инфоблока, добавляю перенос строки
                    echo '<td>'. wordwrap($el[$prop . '_VALUE'], 50, "\n", true) . '</td>';

                }
                echo '</tr>';
            }

            echo '</table>';
            echo '</div>';
        }
    }
}
//Добавил скрол
?>
<style>
    .scroll {
        overflow-x: auto;
    }
</style>

