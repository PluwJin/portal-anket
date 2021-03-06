<?php

namespace kouosl\anket\controllers\backend;
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
    public $SurModel;
    
    public function actionIndex()
    {
        session_unset();
        return $this->render('index');
    }


    public function actionStep1()
    {

        $model=new Survey();
        //$model->id=(Survey::find()->select('id')->max('id'))+1;
        $model->creator_id=Yii::$app->user->identity->id;
        $model->created_at=date('Y-m-d');
        

        if ($model->load(Yii::$app->request->post())) {
            $_SESSION['SurveyEnding_at']=$model->ending_at;
            $_SESSION['SurveyName']=$model->name;
            $_SESSION['SurveyId']=$model->id;
            $_SESSION['Qnumber']=$model->q_number; 
            if($model->validate()){
            $_SESSION['Smodel']=$model;
            $this->redirect(array('create/step2'));
            }
            else {
                return $this->render('step1',['model'=>$model]);
                }

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
        if (Model::loadMultiple($model,Yii::$app->request->post()) && Model::ValidateMultiple($model) ) {
            foreach($model as $index=>$mode){
                $_SESSION['q'.$index]['name']=$mode->name;
                $_SESSION['q'.$index]['type']=$mode->type;
                $_SESSION['q'.$index]['required']=$mode->required;
                $_SESSION['q'.$index]['option_number']=$mode->option_number;
            }
            
            for($i=0;$i<$_SESSION['Qnumber'];$i++){
                for($j=0;$j<$_SESSION['Qnumber'];$j++){
                    if($model[$i]->name==$model[$j]->name && $i!=$j){
                     Yii::$app->session->setFlash('error', '<h1>Aynı sorular kabul edilmez !!!</h1>');
                      // return $this->render('step2',['models'=>$model]);
                       return $this->redirect(['step2']);            
                    }
                }
            }

           $i=0;
             foreach($model as $index=>$mode){
                 if($mode->type!='textInput'){
                     $optionQuestion[$i]=$mode;
                     $i++;
                 }
                 $_SESSION['optionnumber']= $_SESSION['optionnumber']+$mode->option_number;
            }

            if($i==0){
                $_SESSION['Qmodel']=$model;
                $this->redirect(array('create/save'));
            }
            else{
            $_SESSION['optionsQuestions']=$optionQuestion;
            $_SESSION['Qmodel']=$model;
            $this->redirect(array('create/step3'));
            }

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
            $_SESSION['Omodel']=$model;
            $this->redirect(array('create/save'));
               
        }
        else{
            return $this->render('step3',['models'=>$model]);
        }

    }



    public function actionSave()
    {
        if(isset($_SESSION['SurveyName'])){
        $j=0;
        if( $_SESSION['Smodel']->validate()){
            $_SESSION['Smodel']->save();
            }
        
        
        foreach($_SESSION['Qmodel'] as $index => $Qmodel){
            $Qmodel->s_id=$_SESSION['Smodel']->id;
            if($Qmodel->validate()){
            $Qmodel->save();
            }
        if($Qmodel->type!="textInput"){
            $Omodel=$_SESSION['Omodel'];
        for($i=$j;$i<$j+$Qmodel->option_number;$i++){
            $Omodel[$i]->s_id=$_SESSION['Smodel']->id;
            $Omodel[$i]->q_id=$Qmodel->id;
            if($Omodel[$i]->validate()){
                $Omodel[$i]->save();
                }
            
        }
        $j=$i;
    }
    }
}
else if(isset($_SESSION['SoruEkleme'])==true){
    $j=0;
    
    foreach($_SESSION['Qmodel'] as $index => $Qmodel){
        $Qmodel->s_id=$_SESSION['Smodel']->id;
        if($Qmodel->validate()){
        $Qmodel->save();
        }
        else{
            Yii::$app->session->setFlash('error', '<h1>Aynı Soru zaten mevcut !!!</h1>');
            return $this->redirect(['step2']);
            
        }
    if($Qmodel->type!="textInput"){
        $Omodel=$_SESSION['Omodel'];
    for($i=$j;$i<$j+$Qmodel->option_number;$i++){
        $Omodel[$i]->s_id=$_SESSION['Smodel']->id;
        $Omodel[$i]->q_id=$Qmodel->id;
        if($Omodel[$i]->validate()){
            $Omodel[$i]->save();
            }
        
    }
    $j=$i;
}
}
$_SESSION['Smodel']->q_number=$_SESSION['Smodel']->q_number+1;
$_SESSION['Smodel']->save();
}


        session_unset();
        Yii::$app->session->setFlash('Ok', '<h1>Anket Başarıyla Oluşturuldu !!!</h1>');
        return $this->redirect(['/anket/survey']);
        //return $this->render('step4');
    }



   
   






}




