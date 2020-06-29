<?php

namespace app\forms\video;

use FFMpeg\Coordinate;
use FFMpeg\FFMpeg;
use FFMpeg\Format\Video;
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
    public array $files;

    public function rules(): array
    {
        return [
            [
                ['files'],
                'file',
                'extensions'               => ['3gp', 'avi', 'dat', 'flv', 'mov', 'mpeg', 'mp4', 'wav', 'webm'],
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

        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }
        $session = \Yii::$app->session;
        $ffmpeg = FFMpeg::create();

        try {
            foreach ($this->files as $key => $file) {
                $fileName = pathinfo($file->name, PATHINFO_FILENAME);
                $session['$file->name'] = $file->name;
                $session['$fileName'] = $fileName;
                $session['$file->tempName'] = $file->tempName;

                $video = $ffmpeg->open($file->tempName);
                $video
                    ->filters()
                    ->resize(new Coordinate\Dimension(320, 240))
                    ->synchronize();
                $video
                    ->frame(Coordinate\TimeCode::fromSeconds(4))
                    ->save( $fileName . '.jpg');
                $video
                    ->save(new Video\X264(), $fileName . '.mp4');

                $session['$video' . $key] = $video;

                $result[] = [
                    'title'            => $file->baseName,
                    'fileName'         => $fileName,
                    'extension'        => $file->extension,
                    'srcVideo'         => Url::base(true) . '/' . $fileName . '.mp4',
                    'srcImage'         => Url::base(true) . '/' . $fileName . '.jpg',
                ];
            }
        } catch (\Exception $e) {
            return $e;
        }

        $session->close();

        return $result;
    }
}
