<?php

use yii\helpers\Html;
use kouosl\anket\models\Questions;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model kouosl\anket\models\Survey */

$this->title = 'Anket Güncelleme: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Surveys', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';

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
h3{
    margin-left:80px;
}


</style>


<div class="row">
<h1><?= Html::encode($this->title) ?></h1>
<div class="sec" >

    
     <?php $_SESSION['SurveyId']=$model->id; ?>
     <?php $_SESSION['Qnumber']=1; ?>


     <?php $dataProvider = new ActiveDataProvider([
    'query' => Questions::find()->where(['s_id'=>$model->id]),
    'pagination'=>['pageSize'=>20],
]);  ?>
<h3> Anket Soruları Silmek veya Eklemek için Butonları Kullanın:</h3>
<div class="Grid">
     <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [

            'id',
            's_id',
            'name',
            'type',
            'required',
            'option_number',
            ['class' => 'yii\grid\ActionColumn', 'template' => '{delete}']
        
    ]]); ?> 
    </div>
         <?= Html::a('Soru Ekle','/anket/create/step2',['class'=>'btn btn-lg btn-success']) ?>

    <?php //$this->render('_form', [ 'model' => $model ]) ?>
    </div>
</div>
