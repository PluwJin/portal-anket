<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Surveys';
$this->params['breadcrumbs'][] =['label' => 'Anket','url'=>'/anket'];
$this->params['breadcrumbs'][] = $this->title;
?>
<style>

.col-lg-5{
    width:500px;
}

</style>


<div class="row">


    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [

            'id',
            'name',
            'q_number',
            'creator_id',
            ['class' => 'yii\grid\ActionColumn','visibleButtons'=>['update'=> function ($model, $key, $index){
                                                                                         return $model->creator_id ==Yii::$app->user->identity->id; 
                                                                                        },
                                                                   'delete' => function ($model, $key, $index){
                                                                                         return $model->creator_id ==Yii::$app->user->identity->id; 
                                                                                        }]
                                                                                    ],
        ],
    ]); ?>
</div>
