<?php

namespace lib;

class FormHandler
{
    private $iblockId;

    public static $messageDefault;
    public $message = "";
    public function __construct($iblockId)
    {
        $this->iblockId = $iblockId;

    }
    public static function init() {
        self::$messageDefault = GetMessage('MSG_DEFAULT');
    }
    private function escape($data) {
        // Проверка на пустоту
        if (empty($data)) {
            throw new \Exception(GetMessage("MSG_EXCEPTION_EMPTY"));
        }

        return trim(strip_tags($data));
    }
    public function processForm($formData)
    {   //ищу динамически формируемое имя формы с вопросами, добавляю проверку вопросов на пустоту
        try{
            $arProperty =[];
            foreach ($formData as $name => $value) {
                if (strpos($name, "dynamic_field_") === 0) {
                    if(empty($value)) throw new \Exception(GetMessage("MSG_EXCEPTION_EMPTY_ANSWERS"));
                    array_push($arProperty, $value);
                }
            }

            $formData['answers'] = $arProperty;

            // Получаем данные из формы
            $name = $this->escape($formData['namei']);
            $surname = $this->escape($formData['surnamei']);
            $patronymic = $this->escape($formData['patronymic']);
            $phone = $this->escape($formData['phone']);
            $email = $this->escape($formData['email']);
            $comment = $this->escape($formData['comment']);
            $connect = $this->escape($formData['connect']);
            $questions = implode(',  ', $formData['answers']);
            $contactInterval = implode(', ', $formData['contact_interval']); // массив в строку через запятую
        }catch (\Exception $e){
            return $e->getMessage();
        }
        // Обработка загруженных файлов
        $uploaded = $this->handleUploadedFiles();

        // Записываем данные в инфоблок
        $result = $this->addToInfoblock($name, $surname, $patronymic, $phone, $email, $comment, $connect, $contactInterval, $questions, $uploaded);

        return !empty($result);


    }

    private function handleUploadedFiles()
    {
        // Папка, куда будут перемещены загруженные файлы
        $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/';

        // Создаем папку, если она не существует
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $uploadedFiles = [];

        if (!empty($_FILES['uploaded_files']['name']) && is_array($_FILES['uploaded_files']['name'])) {
            $fileCount = count($_FILES['uploaded_files']['name']);

            for ($i = 0; $i < $fileCount; $i++) {
                $fileName = $_FILES['uploaded_files']['name'][$i];
                $tmpFilePath = $_FILES['uploaded_files']['tmp_name'][$i];

                // Генерируем имя для файла
                $uniqueName = md5(uniqid(rand(), true)) . '_' . $fileName;

                // Полный путь к файлу в папке загрузки
                $filePath = $uploadDir . $uniqueName;

                // Перемещаем файл в папку загрузки
                move_uploaded_file($tmpFilePath, $filePath);

                // Сохраняем путь к файлу
                $uploadedFiles[] = $filePath;
            }

            foreach ($uploadedFiles as $file){
                $more_src[] = \CFile::MakeFileArray($file);
            }
        }
        return $more_src;
    }



    private function addToInfoblock($name, $surname, $patronymic, $phone, $email, $comment, $connect, $contactInterval, $questions, $uploaded)
    {
        // Записываем данные в инфоблок
        $el = new \CIBlockElement;

        $fields = [
            'IBLOCK_ID' => $this->iblockId,
            'NAME' => "Заявка от $name $surname",
            'ACTIVE' => 'Y',
            'PROPERTY_VALUES' => [
                'NAME' => $name,
                'SURNAME' => $surname,
                'PATRONYMIC' => $patronymic,
                'PHONE' => $phone,
                'EMAIL' => $email,
                'COMMENT' => $comment,
                'CONNECT' => $connect,
                'CONTACT_INTERVAL' => $contactInterval,
                'QUESTIONS' => $questions,
                'UPLOADED_FILES' => $uploaded,
            ],
        ];

        $elementId = $el->Add($fields);

        return $elementId;
    }
}