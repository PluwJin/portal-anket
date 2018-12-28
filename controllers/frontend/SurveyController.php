<?php

namespace kouosl\anket\controllers\frontend;

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
            'pagination'=>['pageSize'=>20],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Survey model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model=$this->findModel($id);
        $numbermodel=$model->q_number;
        if($model->ending_at>=date('Y-m-d') && !(Answers::find()->where(['User_id'=>Yii::$app->User->identity->id, 's_id'=>$model->id] )->exists()))
        {                                                                //Eğer Anket hala açıksa 
            for($i=0;$i<$numbermodel;$i++)
            {
                $Amodel[]=new Answers();
            }
            if(Model::loadMultiple($Amodel,Yii::$app->request->post())){   //Anket cevaplandıysa
                foreach($Amodel as $index =>$amodel)
                {                                                            // cevaplar model dizisi olarak geldi
                    if(is_array($amodel->o_id))
                    {                                                        // Her bir model checkbox dizisi içeriyormu diye bakıldı
                        foreach($amodel->o_id as $i){                        // model checkboxtan geldiyse checkbox cevapları modellere ayrıldı ve session dizisinde tutuldu
                           $cmodel=new Answers();                                  
                           $cmodel->user_id=$amodel->user_id;
                           $cmodel->s_id=$amodel->s_id;
                           $cmodel->q_id=$amodel->q_id;
                           $cmodel->o_id=$i;
                          if($cmodel->validate())
                          {
                             $_SESSION['cmodels'][]=$cmodel;
                          }
                           else
                           {
                              session_unset();
                              return $this->render('view',['model'=>$model,'Amodel'=>$Amodel]);
                           }
                        }
                    } 
                    else if($amodel->validate())
                    {                                                // eğer model checkboxtan cevabı içermiyorsa radio veya text ise doğrudan session a atılır
                        $_SESSION['amodels'][]=$amodel;  
                    }
                    else
                    {
                       session_unset();
                       return $this->render('view',['model'=>$model,'Amodel'=>$Amodel]);
                    }
                    
                }
                if(isset($_SESSION['cmodels']))
                {
                    foreach($_SESSION['cmodels'] as $model)
                    {
                       if($model->o_id!=null || $model->textanswer!=null)
                           $model->save();
                    }
                }
               if(isset($_SESSION['amodels']))
               {
                   foreach($_SESSION['amodels'] as $model)
                   {
                       if($model->o_id!=null || $model->textanswer!=null)
                          $model->save();
                    }
                }
                session_unset();
                return $this->redirect(['/anket/survey']);

                }
                else{
                    session_unset();
                    return $this->render('view',['model'=>$model,'Amodel'=>$Amodel]);
                   }
        }
        else{                                              //Anket Kapalıdır.
            session_unset();
            Yii::$app->session->setFlash('error', '<h1>Anket Kapalıdır veya Zaten Cevapladınız !!!</h1>');
            return $this->redirect(['/anket/survey']);
        }
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
    public function actionSonuclar($id)
    {
            $model=$this->findModel($id);
            if(Answers::find()->where(['s_id'=>$id])->exists()){
                
               return $this->render('sonuclar', ['model' => $model]);  
            }
            else{
            session_unset();
            Yii::$app->session->setFlash('error', '<h1>Anket Henüz Cevaplanmamıştır !!</h1>');
            return $this->redirect(['/anket/survey']);
            }
    }

}
