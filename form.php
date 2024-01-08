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

<?php if (!empty($_GET["h"])): ?>
    <div style="color: greenyellow;"> <?=\lib\FormHandler::$messageDefault;?></div>
<?php else:?>
    <div style="color: red;"> <?=$formHandler->$message;?></div>
<?php endif;?>
<form action="\form.php" method="POST" enctype="multipart/form-data">
    <h1>Форма заявки</h1>
    <label for="name">Имя:</label>
    <input type="text" name="name" id="name"><br><br>
    <label for="surname">Фамилия:</label>
    <input type="text" name="surname" id="surname"><br><br>
    <label for="patronymic">Отчество:</label>
    <input type="text" name="patronymic" id="patronymic"><br><br>
    <label for="phone">Телефон:</label>
    <input type="text" name="phone" id="phone"><br><br>
    <label for="email">Email:</label>
    <input type="email" name="email" id="email"><br><br>
    <label for="comment">Комментарий:</label><br>
    <textarea name="comment" id="comment" rows="3" cols="50" style="resize:none"></textarea><br><br>
    <label>Способ связи:</label>
    <label for="phone_select">телефон</label>
    <input type="radio" name="connect" value="телефон" id="phone_select">
    <label for="email_select">email</label>
    <input type="radio" name="connect" value="почта" id="email_select"><br><br>
    <label>Выберите подходящее время для связи:</label><br>
    <input type="checkbox" id="morning" name="contact_interval[]" value="Утро">
    <label for="morning">Утро (9:00 - 12:00)</label><br>
    <input type="checkbox" id="afternoon" name="contact_interval[]" value="Полдень">
    <label for="afternoon">День (12:00 - 18:00)</label><br>
    <input type="checkbox" id="evening" name="contact_interval[]" value="Вечер">
    <label for="evening">Вечер (18:00 - 21:00)</label><br>


     <!-- Блок с вопросами -->

    <label for="file">Выберите файл(ы):</label><br>
    <input type="file" id="file" name="uploaded_files[]" multiple><br><br>

    <input type="submit" value="Отправить">
</form>

<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>