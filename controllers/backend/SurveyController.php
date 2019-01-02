<?php

namespace kouosl\anket\controllers\backend;

use Yii;
use kouosl\anket\models\Survey;
use kouosl\anket\models\Questions;
use kouosl\anket\models\Answers;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\bootstrap\Alert;
use yii\base\Model;




/**
 * SurveyController implements the CRUD actions for Survey model.
 */
class SurveyController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    
                ],
            ],
        ];
    }

    /**
     * Lists all Survey models.
     * @return mixed
     */
    public function actionIndex()
    {
        //session_unset();
        $dataProvider = new ActiveDataProvider([
            'query' => Survey::find(),
            'pagination'=>['pageSize'=>10],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

  

    /**
     * Updates an existing Survey model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if($model->creator_id==Yii::$app->user->identity->id){
            
          if ($model->load(Yii::$app->request->post()) && $model->save()){
            return $this->redirect(['view', 'id' => $model->id]);
          }
           return $this->render('update', ['model' => $model,]);
        }

        else{
            return $this->redirect(['index']); 
        }
    }

    /**
     * Deletes an existing Survey model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
            $this->findModel($id)->delete();

            return $this->redirect(['index']);  
    }
    // Soru silmek için kullanılan action Soru modeli için FindQModel metodu kullanılır

    public function actionDeleteq($id)
    {
        
        $s_id= $this->findQModel($id)->s_id;
        $survey=$this->findModel($s_id);

        $this->findQModel($id)->delete();
         $survey->q_number=$survey->q_number-1;
         $survey->save();

            return $this->redirect(['/anket/survey/update?id='.$s_id]);
            
    }

    /**
     * Finds the Survey model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Survey the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Survey::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findQModel($id)
    {
        if (($model = Questions::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }



 
}
