<?php

namespace lib;
class FormHandler
{
    private $iblockId;
    public static $messageDefault = "Заявка успешно оставлена! Предлогаем оставить еще одну;)";
    public $message = "";
    public function __construct($iblockId)
    {
        $this->iblockId = $iblockId;
    }
    private function escape($data) {
        // Проверка на пустоту
        if (empty($data)) {
            throw new \Exception('Заполните все поля.');
        }

        return trim(strip_tags($data));
    }
    public function processForm($formData)
    {
        try {
            // Получаем данные из формы
            $name = $this->escape($formData['name']);
            $surname = $this->escape($formData['surname']);
            $patronymic = $this->escape($formData['patronymic']);
            $phone = $this->escape($formData['phone']);
            $email = $this->escape($formData['email']);
            $comment = $this->escape($formData['comment']);
            $connect = $this->escape($formData['connect']);
            $contactInterval = implode(', ', $formData['contact_interval']); // массив в строку через запятую
        }catch (\Exception $e){
           return $e->getMessage();


        }
        // Обработка загруженных файлов
        $uploadedFiles = $this->handleUploadedFiles();

        // Записываем данные в инфоблок
        $this->addToInfoblock($name, $surname, $patronymic, $phone, $email, $comment, $connect, $contactInterval, $uploadedFiles);

        return true;
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
        }

        return $uploadedFiles;
    }



    private function addToInfoblock($name, $surname, $patronymic, $phone, $email, $comment, $connect, $contactInterval, $uploadedFiles)
    {
        // Записываем данные в инфоблок
        $el = new \CIBlockElement();

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
                'UPLOADED_FILES' => $uploadedFiles,
            ],
        ];

        $elementId = $el->Add($fields);

        return $elementId;
    }
}

