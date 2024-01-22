<?php
// Класс для вывода свойств типа список в форму
namespace lib;

class FormListHandler
{
    static $infoblockId;
    // метод вывода списка свойств
    public static function toDrawOptions($code){
        $value = [];
        //код в параметр получаем в результате выполнения метода toDrawSelect()
        $res= \CIBlockPropertyEnum::GetList([],["IBLOCK_ID"=>self::$infoblockId,"CODE"=>$code]);
        while ($el=$res->GetNext()){

            array_push($value, $el["VALUE"]);

        }
        return $value;
    }
    //метод для вывода имени и кода свойств
    public static function toDrawSelect()
    {
        $prop =["name" => [],
            "code" => []
        ];

        $res = \CIBlockProperty::GetList([], ["IBLOCK_ID" => self::$infoblockId]);
        while ($el = $res->GetNext()) {

            array_push($prop["name"], $el["NAME"]);
            array_push($prop["code"], $el["CODE"]);

        }
        return $prop;
    }
    //метод для вывода Названия вакансии
    public static function toDrawQuestionsBlockName($iblock)
    {

        self::$infoblockId = $iblock;
        $res = \CIBlockElement::GetList([], ["IBLOCK_ID" => self::$infoblockId],false,false,["NAME"]);
        $el = $res->GetNext();
        return $el["NAME"];
    }
    //метод проверки доступа для кнопки со списком заявок
    public static function toCheckPermission($iblockId){
        $permission = \CIBlock::GetPermission($iblockId);
        if ($permission == "R"||$permission == "X") return true;
    }

}