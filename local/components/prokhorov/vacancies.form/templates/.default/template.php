<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

    <div class="row">
        <div class="col-sm-12">
            <div class="test-form">
                <form action="<?=$_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data">
                    <!--Вывод названия блока с вопросами-->
                    <h2><?=$arResult['IBLOCK_QUESTIONS'];?></h2>
                    <?php if (!empty($_GET["h"])): ?>
                        <div style="color: greenyellow;"> <?=$arResult["msg-default"];?></div>
                    <?php else:?>
                        <div style="color: red;"> <?=$arResult['message'];?></div>
                    <?php endif;?>
                    <label class="input_label" for="namei"><?=GetMessage("NAME");?></label>
                    <input class="input" type="text" name="namei" id="name"><br><br>
                    <label class="input_label" for="surnamei"><?=GetMessage("SURNAME");?></label>
                    <input class="input" type="text" name="surnamei" id="surname"><br><br>
                    <label class="input_label" for="patronymic"><?=GetMessage("PATRONYMIC");?></label>
                    <input class="input" type="text" name="patronymic" id="patronymic"><br><br>
                    <label class="input_label" for="phone"><?=GetMessage("PHONE");?></label>
                    <input class="input" type="text" name="phone" id="phone"><br><br>
                    <label class="input_label" for="email"><?=GetMessage("EMAIL");?></label>
                    <input class="input" type="email" name="email" id="email"><br><br>
                    <label class="comment_label" for="comment"><?=GetMessage("COMMENT");?></label><br>
                    <textarea class="comment" name="comment" id="comment" rows="3" cols="50" style="resize:none"></textarea><br><br>
                    <label class="last"><?=GetMessage("CONNECT");?></label>
                    <label class="last" for="phone_select"><?=GetMessage("PHONE_SELECT");?></label>
                    <input class="connectR" type="radio" name="connect" value="телефон" id="phone_select">
                    <label class="last" for="email_select"><?=GetMessage("EMAIL_SELECT");?></label>
                    <input class="connectR" type="radio" name="connect" value="почта" id="email_select"><br><br>
                    <label class="last"><?=GetMessage("CONTACT_INTERVAL");?></label><br>
                    <input class="last" type="checkbox" id="morning" name="contact_interval[]" value="Утро">
                    <label class="last" for="morning"><?=GetMessage("CONTACT_INTERVAL_MORNING");?></label><br>
                    <input class="last" type="checkbox" id="afternoon" name="contact_interval[]" value="Полдень">
                    <label class="last" for="afternoon"><?=GetMessage("CONTACT_INTERVAL_AFTERNOON");?></label><br>
                    <input class="last" type="checkbox" id="evening" name="contact_interval[]" value="Вечер">
                    <label class="last" for="evening"><?=GetMessage("CONTACT_INTERVAL_EVENING");?></label><br>
                    <!-- Блок с вопросами -->
                    <div class="list-questions">
                        <h2><?=GetMessage("H2_ANSWERS");?></h2>
                        <?php $el= $arResult['SELECT_LIST'];
                        for($i=0;$i<=count($el);$i++):?>
                            <label class="last" for="<?=$el["code"][$i]?>"><?=$el["name"][$i];?>:</label><br>
                            <select style="width: 300px" name="dynamic_field_<?=$el["code"][$i]?>" id="<?=$el["code"][$i]?>">
                                <?php $prop= \lib\FormListHandler::toDrawOptions($el["code"][$i]);?>
                                <option value=""><?=GetMessage("EXAMPLE_ANSWERS");?></option>
                                <?php foreach ($prop as $item):?>
                                    <option  value="<?=$el["name"][$i]?><?=$item?>"><?=$item?></option>
                                <?php endforeach;?>
                            </select><br>
                        <?php endfor;?>
                    </div>
                    <div class="file-conteiner">
                        <label for="file"><?=GetMessage("FILE");?></label><br>
                        <input class="fileB" type="file" id="file" name="uploaded_files[]" multiple><br><br>
                    </div>
                    <div class="button-container">
                        <input class="buttonn" type="submit" value="<?=GetMessage("BUTTON_POST");?>">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--Вывод кнопки - ссылки после проверки прав доступа-->
<?php if($arResult['SHOW_LINK_TO_LIST']):?>
    <div class="link-to-list">
        <a href="<?=$arResult['PATH_TO_LIST']?>"><?=GetMessage("BUTTON_TO_LIST");?></a>
    </div>
<?php endif;?>