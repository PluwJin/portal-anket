<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Surveys';
$this->params['breadcrumbs'][] =['label' => 'Anket','url'=>'/anket'];
$this->params['breadcrumbs'][] = $this->title;
 Yii::$app->session->getFlash('error');
 Yii::$app->session->getFlash('Ok');
?>

<style>

.col-lg-5{
    width:500px;
}
.row{
    background-color:#f5f5f5;
    border-radius:25px;
    padding:50px;
}
h1{
    justify:center;
    text-align:center;
}
.form-group{
    display: flex;
 
  justify-content: center;
}


</style>
<!-- Grid View yapısı, Action butonları -->

<div class="row">


    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(['enablePushState'=>false]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [

            'id',
            'name',
            'q_number',
            'creator_id',
            'created_at',
            'ending_at',
            ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}',
           
            'visibleButtons'=>['update'=> function ($model, $key, $index){
                                             return $model->creator_id ==Yii::$app->user->identity->id && ($model->ending_at>date('Y-m-d')); 
                                            },
                                'delete' => function ($model, $key, $index){
                                              return $model->creator_id ==Yii::$app->user->identity->id; 
                                            },
                                ]
            ],
    ]]); ?> 
    <?php Pjax::end(); ?>
    <div class='form-group'>
    <?=Html::a('Geri','/admin/anket', $options = ['class'=>'btn btn-success'])  ?>
    </div>
    
</div>
