<?php
//
//public function actionConvert() {
//    $files = UploadedFile::getInstancesByName('files');
//
//    $result = [];
//    $path = Yii::$app->params['videoFilesPath'];
//
//    if (!file_exists($path)) {
//        mkdir($path, 0777, true);
//    }
//    $ffmpeg = FFMpeg::create();
////        $ffprobe = FFProbe::create();
//
//    foreach ($files as $key => $file) {
//        $fileName = pathinfo($file->name, PATHINFO_FILENAME);
//        $video = $ffmpeg->open($file->tempName);
//
//        $session = \Yii::$app->session;
//        $session->open();
//        $session['$fileName'] = $fileName;
//        $session->close();
//
//        return $video
//            ->frame(Coordinate\TimeCode::fromSeconds(4))
//            ->save( $path . $fileName . '.jpg');
//
//        $format = new Video\X264();
//        $format->setAudioCodec("libmp3lame");
//
//        return $video
//            ->save($format, $path . $fileName . '.mp4');
//
//        // 'format_name' => 'mkv,mp4,3gp'
//        // 'format_name_good' => 'webm,avi'
//
//        $result[] = [
//            'title'            => $file->baseName,
//            'fileName'         => $fileName,
//            'extension'        => $file->extension,
//            'srcVideo'         => Url::base(true) . '/' . $fileName . '.mp4',
//            'srcImage'         => Url::base(true) . '/' . $fileName . '.jpg',
//        ];
//    }
//
//    return $this->_dto->success($result);
//
//}
//
//
//
//public function saveFilesAndGetData()
//{
//    $result = [];
//    $path = Yii::$app->params['videoFilesPath'];
//
//    if (!file_exists($path)) {
//        mkdir($path, 0755, true);
//    }
//    $session = \Yii::$app->session;
//    $ffmpeg = FFMpeg::create();
//
//    foreach ($this->files as $key => $file) {
//        $fileName = pathinfo($file->name, PATHINFO_FILENAME);
//        $video = $ffmpeg->open($file->tempName);
//
//        $video
//            ->frame(Coordinate\TimeCode::fromSeconds(4))
//            ->save( $fileName . '.jpg');
//
//        $video
//            ->save(new Video\X264(), $fileName . '.mp4');
//
//        // 'format_name' => 'mkv,mov,mp4,3gp'
//        // 'format_name_good' => 'webm,avi'
//
//        $session['$video2'] = unserialize(serialize($video));
//        $session->close();
//        $result[] = [
//            'title'            => $file->baseName,
//            'fileName'         => $fileName,
//            'extension'        => $file->extension,
//            'srcVideo'         => Url::base(true) . '/' . $fileName . '.mp4',
//            'srcImage'         => Url::base(true) . '/' . $fileName . '.jpg',
//        ];
//    }
//
//    $session->close();
//
//    return $result;
//}
//
//
//
//
//
//

//Подскажите, пожалуйста, пытаюсь проверить, вызвался ли метод, который стоит в качестве обработчика онклика баттона.
//
//То есть создал экземпляр этого компонента, нахожу у него кнопку баттон (она одна) и вызываю ее клик. Проверяю вызвалась ли функция, которая стоит как обработчик этому клику. Однако expect фейлится..
//
//    const goNextSpy = jest.spyOn(formStepPersonalData.methods, 'goNext');
//
//    const wrapper = mount(formStepPersonalData, {
//      propsData: {
//    email: 'test@test.ru',
//        birthDate: '01.01.2020',
//        phone: '+79286666666',
//        timerCount: 60,
//      },
//      mocks: {
//    $v,
//      },
//    });
//
//    const buttonNext = wrapper.find('button');
//    buttonNext.trigger('click');
//    expect(goNextSpy).toHaveBeenCalled();