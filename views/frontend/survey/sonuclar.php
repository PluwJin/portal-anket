<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kouosl\anket\models\Questions;
use kouosl\anket\models\Options;
use kouosl\anket\models\Answers;
use yii\bootstrap\Progress;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Survey-Result';
$this->params['breadcrumbs'][] =['label' => 'Anket','url'=>'/anket'];
$this->params['breadcrumbs'][] =['label' => 'Surveys','url'=>'/anket/survey'];
$this->params['breadcrumbs'][] = $this->title;
$Qmodel=Questions::find()->where(['s_id'=>$model->id])->all();
?>
<style>

.soru{
 display:block;
 border:2px solid black;
 padding:20px;
 padding-left:110px;
 border-radius:25px;
 margin:50px;
 margin-left:200px;
 margin-right:200px;
}
 .progress-bar{
     color:black;
     font-family:Century Gothic;
     font-weight:bold;
 }
 h2{
     color:red;
 }
 h1{
     margin-left:29%;
 }
 .row{
    background-color:#f5f5f5;
    padding:25px;
    border-radius:25px;
 }

.form-group{
    display: flex;
 
  justify-content: center;
}

</style>

<div class="row">
    <h1><?= "Anket Adı: ".$model->name  ?></h1>
    <?php foreach($Qmodel as $qmodel){
        $Omodel=Options::find()->where(['q_id'=>$qmodel->id])->all();
        $oysayisi=Answers::find()->where(['q_id'=>$qmodel->id])->count();

        if($qmodel->type!='textInput'){ ?>
       <div class="soru" >
            <h2><?=$qmodel->name?></h2>
            <?php foreach($Omodel as $omodel){
                $Oacount=Answers::find()->where(['o_id'=>$omodel->id])->count();?>
                <?php if($oysayisi!=0){ $yuzde=(($Oacount)/$oysayisi)*100; }else {$yuzde=0;} ?>
                <?=$omodel->name." : %".$yuzde ?>
                <?= Progress::widget([
                    
                    'percent' => $yuzde,
                    'options' => ['style'=>['width'=>'500px','display'=>'block']]]);
                ?>
               
            <?php } ?>
            <h5><?= "Kullanılan Toplam Oy: ".$oysayisi  ?></h5>
       </div>
       <?php } ?>

       <?php if($qmodel->type=='textInput'){?>
        <div class="soru" >
        <h2><?=$qmodel->name?></h2>

       <?php $dataProvider = new ActiveDataProvider([
                    'query' => Answers::find()->select('textanswer')->where(['s_id'=>$model->id,'q_id'=>$qmodel->id]),
                    'pagination'=>['pageSize'=>10],
                ]); 
        echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['attribute'=>'textanswer','label'=>'Text Cevaplar']
    ],
]) ?>
</div>



        <?php } ?>
       <?php } ?>
 
<div class='form-group'>
       <?=Html::a('Geri','/anket/survey', $options = ['class'=>'btn btn-success'])  ?>
       </div>
      
    </div>
