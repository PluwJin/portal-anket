<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kouosl\anket\models\Questions;
use kouosl\anket\models\Options;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model kouosl\anket\models\Survey */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Surveys', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
.row{
    background-color:#f5f5f5;
    padding:25px;
    border-radius:25px;
    
}
.col-lg-5{
    margin-left: 350px;
    
}
h1{
    text-align:center;
    color:crimson;
    font-family: "Century gothic";
    margin-bottom:50px;
}
h3{
  font-family:"Century Gothic";
  font-weight:bold;
  margin-bottom:15px;
}
.btn-primary{
margin-left:170px;
margin-top:20px;
}
.question{
  border:2px solid black;
  margin: 20px;
  padding:20px;
  border-radius:20px;
}
fieldset{
  margin-left:20px;
  font-size:17px;

}

</style>

<div class='row'>
<div class="col-lg-5">
  <?php $form = ActiveForm::begin(['enableClientValidation'=>false,'fieldConfig' => ['enableLabel'=>false]]); ?>
    <h1><?= Html::encode("Anket : ".$this->title) ?></h1>
    <?php $Qmodel=Questions::find()->where(['s_id'=>$model->id])->orderBy(['id'=>SORT_ASC])->all()?>
    <?php foreach($Qmodel as $index=>$qmodel){ ?>
     <div class="question">
        <h3><?= ($index+1).'.) '.$qmodel->name  ?></h3>

        <?php if($qmodel->type=='textInput'){?>
          <?= $form->field($model, "id")->textInput(['required'=>true]) ?>
        <?php }?>

        <?php  if($qmodel->type=='radio'){?>
          <?php $Omodel=Options::find()->select('id,name')->where(['s_id'=>$model->id ,'q_id'=>$qmodel->id])->all()?>
          <fieldset>
            <?= $form->field($model, "id")->radioList(ArrayHelper::map($Omodel,'id','name')) ?>
          </fieldset>
        <?php }?>

        <?php  if($qmodel->type=='checkbox'){?>
          <?php $Omodel=Options::find()->select('id,name')->where(['s_id'=>$model->id ,'q_id'=>$qmodel->id])->all()?>
          <fieldset>
           <?= $form->field($model, "id")->CheckboxList(ArrayHelper::map($Omodel,'id','name')) ?>
          </fieldset>
        <?php }?> 
        </div>



    <?php }  ?>



 <?php ActiveForm::end(); ?>
</div>
</div>