<?php
namespace Modules\File\Controllers;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\IncomingRequest;
use Modules\File\Models\M_file;
use CodeIgniter\HTTP\RequestInterface;
Use Modules\File\Config\Config;

/**
 * Контроллер управления файлами
 *
 * @author parovik
 * @copyright (C) 2023 Parovik S.A.
 */
class File extends Controller{
    public function validateFile($input_name, IncomingRequest $files): bool
    {
        if (!empty($files)) {
            $config = new Config();
            $validationRule = [
                $input_name => [
                    'label' => 'File',
                    'rules' => [
                        'uploaded[' . $input_name . ']',
                        'max_size[' . $input_name . $config->max_upload_size . ']',
                        'ext_in[' . $input_name . $config->allowed_types . ']',
                        'mime_in[' . $input_name . $config->mime_in_upload . ']',
                    ],
                ],
            ];

            $M_file = new M_file();
            // Перемещение файлов из веременного хранилища, присвоение рандомного имени
            foreach ($files[$input_name] as $file) {
                if (!$this->validate($validationRule)) {
                    $data = ['errors' => $this->validator->getErrors()];
                } elseif ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $file->move(WRITEPATH . 'uploads', $newName);
                    $data = [
                        'path' => 'writepath/uploads/' . $newName,
                        'name' => $file->getClientName()
                    ];
                    $M_file->savedb($data);
                }
            }
            return true;
        }
        return false;
    }
}
