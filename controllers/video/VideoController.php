<?php

namespace app\controllers\video;

use app\controllers\ApiController;
use app\models\response\DTO;
use yii\web\UploadedFile;

class VideoController extends ApiController
{
    private DTO $_dto;

    public function __construct(
        $id,
        $module,
        DTO $dto,
        $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->_dto = $dto;
    }

    public function actionConvert() {
        $files = UploadedFile::getInstancesByName('files');
        $session = \Yii::$app->session;
        $session->open();
        $session['check'] = $files;
        $session['files'] = $_FILES;
//        $session->close();

        if (file_exists($_FILES['files']['tmp_name']) && is_uploaded_file($_FILES['files']['tmp_name'])) {

            $targetvid     = md5(time());
            $target_dirvid = "videos/";

            $target_filevid = $targetvid . basename($_FILES['files']["name"]);

            $uploadOk = 0;

            $videotype = pathinfo($target_filevid, PATHINFO_EXTENSION);

            //these are the valid video formats that can be uploaded and
            //they will all be converted to .mp4

            $video_formats = array(
                "mpeg",
                "mp4",
                "mov",
                "wav",
                "avi",
                "dat",
                "flv",
                "3gp",
                "webm"
            );

            foreach ($video_formats as $valid_video_format) {

                //You can use in_array and it is better

                if (preg_match("/$videotype/i", $valid_video_format)) {
                    $target_filevid = $targetvid  . ".mp4";
                    $uploadOk       = 1;
                    break;

                } else {
                    //if it is an image or another file format it is not accepted
                    $format_error = "Invalid Video Format!";
                }

            }

            if ($_FILES['files']["size"] > 500000000) {
                $uploadOk = 0;
                echo "Sorry, your file is too large.";
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0 && isset($format_error)) {

                echo "What??";

                // if everything is ok, try to upload file

            } else if ($uploadOk == 0) {


                echo "Sorry, your video was not uploaded.";

            }

            else {

                $target_filevid = strtr($target_filevid, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
                $target_filevid = preg_replace('/([^.a-z0-9]+)/i', '_', $target_filevid);

                $session['5'] = $target_filevid;
                $session['6'] = $target_dirvid;

                if (!move_uploaded_file($_FILES['files']["tmp_name"], $target_dirvid . $target_filevid)) {

                    echo "Sorry, there was an error uploading your file. Please retry.";
                } else {

                    $vid = $target_dirvid . $target_filevid;

                }
            }
        }

//        $session = \Yii::$app->session;
//        $session->open();
        $session['1'] = $vid;
        $session['2'] = file_exists($_FILES['files']['tmp_name']);
        $session['3'] = is_uploaded_file($_FILES['files']['tmp_name']);
        $session['4'] = $_FILES['files']['tmp_name'];
        $session->close();

        return $this->_dto->success(
            $files
        );
    }
}