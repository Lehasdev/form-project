<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
CModule::IncludeModule('iblock');

if ($_SERVER['REQUEST_METHOD']==='POST') {
    $iblockId = 6;
    // экземпляр обработчика
    $formHandler = new \lib\FormHandler($iblockId);
    // Обработка формы
    $result = $formHandler->processForm($_POST);

    if ($result!= 'true') {
        $formHandler-> $message= $result;
    } else {
        header("location: /form.php?h=success");
        exit();
    }
}


?>


<form action="\form.php" method="POST" enctype="multipart/form-data">
    <h1>Форма заявки</h1>
    <?php if (!empty($_GET["h"])): ?>
        <div style="color: greenyellow;"> <?=\lib\FormHandler::$messageDefault;?></div>
    <?php else:?>
        <div style="color: red;"> <?=$formHandler->$message;?></div>
    <?php endif;?>
    <label class="input_label" for="name">Имя:</label>
    <input class="input" type="text" name="name" id="name"><br><br>
    <label class="input_label" for="surname">Фамилия:</label>
    <input class="input" type="text" name="surname" id="surname"><br><br>
    <label class="input_label" for="patronymic">Отчество:</label>
    <input class="input" type="text" name="patronymic" id="patronymic"><br><br>
    <label class="input_label" for="phone">Телефон:</label>
    <input class="input" type="text" name="phone" id="phone"><br><br>
    <label class="input_label" for="email">Email:</label>
    <input class="input" type="email" name="email" id="email"><br><br>
    <label class="comment_label"for="comment">Комментарий:</label><br>
    <textarea class="comment" name="comment" id="comment" rows="3" cols="50" style="resize:none"></textarea><br><br>
    <label class="last">Способ связи:</label>
    <label class="last" for="phone_select">телефон</label>
    <input class="connectR" type="radio" name="connect" value="телефон" id="phone_select">
    <label class="last" for="email_select">email</label>
    <input class="connectR" type="radio" name="connect" value="почта" id="email_select"><br><br>
    <label class="last">Выберите подходящее время для связи:</label><br>
    <input class="last" type="checkbox" id="morning" name="contact_interval[]" value="Утро">
    <label class="last" for="morning">Утро (9:00 - 12:00)</label><br>
    <input class="last" type="checkbox" id="afternoon" name="contact_interval[]" value="Полдень">
    <label class="last" for="afternoon">День (12:00 - 18:00)</label><br>
    <input class="last" type="checkbox" id="evening" name="contact_interval[]" value="Вечер">
    <label class="last" for="evening">Вечер (18:00 - 21:00)</label><br>


     <!-- Блок с вопросами -->
<div class="file-conteiner">
    <label for="file">Выберите файл(ы):</label><br>
    <input class="fileB" type="file" id="file" name="uploaded_files[]" multiple><br><br>
</div>
    <div class="button-container">
        <input class="buttonn" type="submit" value="Отправить">
    </div>
</form>
    <link rel="stylesheet" type="text/css" href="/local/templates/form/style.css">

<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>