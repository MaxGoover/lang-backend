<?php

namespace app\forms\video;

use Yii;
use yii\base\Model;
use yii\helpers\Url;
use yii\web\UploadedFile;

class VideoFileForm extends Model
{
    const MAX_FILE_SIZE_MB = 10;
    const MAX_FILES = 5;

    /**
     * @var UploadedFile[]
     */
    public $files;

    public function rules(): array
    {
        return [
            [
                ['files'],
                'file',
                'extensions'               => ['3gp', 'avi', 'dat', 'flv', 'mov', 'mpeg', 'mp4', 'wav'],
                'skipOnEmpty'              => false,
                'checkExtensionByMimeType' => false,
                'maxFiles'                 => self::MAX_FILES,
                'maxSize'                  => 1024 * 1024 * self::MAX_FILE_SIZE_MB,
                'tooBig'                   => 'Max file size is ' . self::MAX_FILE_SIZE_MB . 'MB',
            ],
        ];
    }

    public function saveFilesAndGetData()
    {
        $result = [];

        $path = Yii::$app->params['videoFilesPath'];
        $date = date('Y-m-d_H-i-s_' . round(microtime(true) * 1000));
        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }

        foreach ($this->files as $key => $file) {
            $fileName = $date . '_' . $key . '.' . $file->extension;

            // Saves file to server
            $file->saveAs($path . $fileName);

            $result[] = [
                'title'            => $file->baseName,
                'fileName'         => $fileName,
                'extension'        => $file->extension,
                'isManualUploaded' => true,
                'src'              => Url::base(true) . '/' . $path . $fileName,
            ];
        }

        return $result;
    }
}
