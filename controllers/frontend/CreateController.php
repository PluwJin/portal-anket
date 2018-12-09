<?php

namespace kouosl\anket\controllers\frontend;

class CreateController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionStep1()
    {
        return $this->render('step1');
    }

    public function actionStep2()
    {
        return $this->render('step2');
    }

    public function actionStep3()
    {
        return $this->render('step3');
    }

    public function actionStep4()
    {
        return $this->render('step4');
    }

    public function actionStep5()
    {
        return $this->render('step5');
    }

}
