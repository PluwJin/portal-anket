<?php
namespace kouosl\anket\controllers\frontend;


/**
 * Default controller for the `anket` module
 */
class DefaultController extends \kouosl\base\controllers\frontend\BaseController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('_index');
    }
    public function actionYaz(){
        return $this->render('yaz');
    }
}
