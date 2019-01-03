<?php

use yii\helpers\Html;
use kouosl\anket\models\Questions;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model kouosl\anket\models\Survey */

$this->title = 'Anket Güncelleme: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Surveys', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['update', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
session_unset();


?>

<style>
.row{
    background-color:#f5f5f5;
    
    border-radius:25px;
}
h1{
    font-family:Century Gothic;
    margin-bottom:50px;
    color:red;
    text-align:center;
}
.Grid{
    margin :80px;
}
h4{
    margin-left:80px;
}
#ekle{
    margin-left:400px;
}
.form-group{
    display: flex;
 
  justify-content: center;
}



</style>


<div class="row">
<h1><?= Html::encode($this->title) ?></h1>
<div class="sec" >

     <?php $_SESSION['Smodel']=$model ?>
     <?php $_SESSION['SurveyId']=$model->id; ?>
     <?php $_SESSION['SoruEkleme']=true; ?>
     
     
     <?php $_SESSION['Qnumber']=1; ?>


     <?php $dataProvider = new ActiveDataProvider([
    'query' => Questions::find()->where(['s_id'=>$model->id]),
    'pagination'=>['pageSize'=>20],
]);  ?>
<h4> Anket Soruları Silmek veya Eklemek için Butonları Kullanın:</h4>
<div class="Grid">
     <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [

            ['attribute'=>'id','label'=>'ID'],
            ['attribute'=>'s_id','label'=>'Anket ID'],
            ['attribute'=>'name','label'=>'Soru'],
            ['attribute'=>'type','label'=>'Soru Tipi'],
            ['attribute'=>'required','label'=>'Zorunlu mu'],
            ['attribute'=>'option_number','label'=>'Seçenek Sayısı'],
            ['class' => 'yii\grid\ActionColumn', 'template' => '{delete}',
            'urlCreator' => function ($action, $model, $key, $index) {

                if ($action === 'delete') {
    
                    $url ='deleteq?id='.$model->id;
    
                    return $url;
    
            }}
        
        
        
        
        ],
            
        
        ],
 
    
    ]); ?> 
     <?= Html::a('Soru Ekle','/admin/anket/create/step2',['class'=>'btn btn-lg btn-success', 'id'=>"ekle"]) ?>
    </div>
    <div class='form-group'>
    <?=Html::a('Geri','/admin/anket/survey', $options = ['class'=>'btn btn-success'])  ?>
    </div>
        

    <?php //$this->render('_form', [ 'model' => $model ]) ?>
    </div>
</div>
