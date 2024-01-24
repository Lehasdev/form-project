<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Список заявок");?>

<?$APPLICATION->IncludeComponent(
    "prokhorov:vacancies.list",
    "",
    Array(
        "INFO_ID" => $arParams["IBLOCK_APPLICATIONS"]
    )
);?><?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>