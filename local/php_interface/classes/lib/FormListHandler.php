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
    public static function toDrawSelect($iblock)
    {
        $prop =["name" => [],
            "code" => []
        ];
        self::$infoblockId = $iblock;
        $res = \CIBlockProperty::GetList([], ["IBLOCK_ID" => self::$infoblockId]);
        while ($el = $res->GetNext()) {
            array_push($prop["name"], $el["NAME"]);
            array_push($prop["code"], $el["CODE"]);

        }
        return $prop;
    }}
