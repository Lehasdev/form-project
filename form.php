<?php
echo 'test';
?>


<form action="#" method="POST" enctype="multipart/form-data">
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
    <input type="radio" name="connect" value="1" id="phone_select">
    <label for="email_select">email</label>
    <input type="radio" name="connect" value="0" id="email_select"><br><br>
    <label>Выберите интервал времени для связи:</label><br>
    <input type="checkbox" id="morning" name="contact_interval[]" value="morning">
    <label for="morning">Утро (9:00 - 12:00)</label><br>
    <input type="checkbox" id="afternoon" name="contact_interval[]" value="afternoon">
    <label for="afternoon">День (12:00 - 18:00)</label><br>
    <input type="checkbox" id="evening" name="contact_interval[]" value="evening">
    <label for="evening">Вечер (18:00 - 21:00)</label><br>
    <input type="checkbox" id="anytime" name="contact_interval" value="anytime">
    <label for="anytime">Любое время</label><br><br>
    <!-- foreach -->
    <label for="question">questions["name"]:</label><br>
    <select id="question" name="">
        <option value="answers[]">Ответ</option>
    </select><br><br>
    <label for="file">Выберите файл(ы):</label><br>
    <input type="file" id="file" name="uploaded_files[]" multiple>
    <input type="submit" value="Отправить">


</form>