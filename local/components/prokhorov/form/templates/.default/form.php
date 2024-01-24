<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Вакансии"); ?>

<?$APPLICATION->IncludeComponent(
    "prokhorov:vacancies.form",
    "",
    Array(
        "APPLICATIONS_ID" => $arParams["IBLOCK_APPLICATIONS"],
        "LIST_PATH" => '?'.$arParams["VARIABLE_ALIASES"]["list"],
        "QUESTIONS_ID" => $arParams["IBLOCK_QUESTIONS"]
    )
);?><?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>