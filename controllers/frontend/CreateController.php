<?php

namespace kouosl\anket\controllers\frontend;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\base\Model;

use kouosl\anket\models\Survey;
use kouosl\anket\models\Questions;
use kouosl\anket\models\Options;


class CreateController extends \yii\web\Controller
{
    
    public $before;
    
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionStep1()
    {
        $model=new Survey();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save();
            $_SESSION['SurveyId']=$model->id;
            $_SESSION['Qnumber']=$model->q_number;
            $this->redirect(array('create/step2'));

            } 
        else {
           return $this->render('step1',['model'=>$model]);
           }
    }

    public function actionStep2()
    {
        
        $_SESSION['optionnumber']=0;
        for($i = 0; $i<$_SESSION['Qnumber']; $i++) {
            $model[] = new Questions();
            
            
        } 
        if (Model::loadMultiple($model,Yii::$app->request->post())&& Model::ValidateMultiple($model) ) {
            for($i=0;$i<$_SESSION['Qnumber'];$i++){
                for($j=0;$j<$_SESSION['Qnumber'];$j++){
                    if($model[$i]->name==$model[$j]->name && $i!=$j){
                    return $this->render('step2',['models'=>$model]);                  
                    }
                }
            }

           $i=0;
             foreach($model as $mode){

                 if($mode->type!='textInput'){
                     $optionQuestion[$i]=$mode;
                     $i++;
                 }
                 $_SESSION['optionnumber']= $_SESSION['optionnumber']+$mode->option_number;
                $mode->save();
            }
            $_SESSION['optionsQuestions']=$optionQuestion;
            $this->redirect(array('create/step3'));
        }
            
        else {
            return $this->render('step2',['models'=>$model]);
            
           }
       

        
    }

    public function actionStep3()
    {
        for($i = 0; $i<$_SESSION['optionnumber']; $i++) {
            $model[] = new Options();   
        }
        if(Model::loadMultiple($model,Yii::$app->request->post()) && Model::ValidateMultiple($model) ){
            $exists = Options::find()->where( [ 's_id' => $model[0]->s_id ] )->exists();
            for($i=0;$i<$_SESSION['optionnumber'];$i++){
                for($j=0;$j<$_SESSION['optionnumber'];$j++){
                    if($model[$i]->name==$model[$j]->name && $i!=$j && $model[$i]->q_id==$model[$j]->q_id ){
                    return $this->render('step3',['models'=>$model]);                  
                    }
                }
            }
            if($exists){
                $modelexist=Options::find()->where(['s_id'=>$_SESSION['SurveyId']])->orderBy(['id'=>SORT_ASC])->all();
                for($i=0;$i<$_SESSION['optionnumber'];$i++){
               Options::updateAll(['name'=>$model[$i]->name], ['id'=>$modelexist[$i]->id]);
               echo $modelexist[$i]->id.'<br>';
                }
                $this->redirect(array('create/step4'));
            }
            else{
               
                foreach($model as $mode){
                    $mode->save();
                }
                $this->redirect(array('create/step4'));
                //session_unset();
            }
            



        }
        else{

      return $this->render('step3',['models'=>$model]);
        }

     
    

       


    }






    public function actionStep4()
    {
        return $this->render('step4');
    }
    

    public function actionStep5()
    {
        return $this->render('step5');
    }

    public function actionIndex2()
    {
        $Smodel=new Survey();
        $Qmodel=new Questions();
        $Omodel=new Options();

        return $this->render('index2',['Smodel'=>$Smodel,'Qmodel'=>$Qmodel,'Omodel'=>$Omodel]);
    }

}
