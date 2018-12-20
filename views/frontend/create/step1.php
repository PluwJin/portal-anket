<?php

use kouosl\theme\helpers\Html;
use kouosl\theme\widgets\Portlet;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;

$this->title = 'Step1';
$data['title'] = Html::encode($this->title);
$this->params['breadcrumbs'][] =['label' => 'Anket','url'=>'/anket'];
$this->params['breadcrumbs'][] =['label' => 'Create','url'=>'/anket/create'];
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
}
.btn-primary{
margin-left:170px;
margin-top:20px;
}
</style>




<div class="row",id="s1">
<h1>Step 1</h1>
<hr>
        <div class="col-lg-5",id='s2'>
            <?php $form = ActiveForm::begin(); ?>
          
           

                <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
                

                <?= $form->field($model, 'q_number')->textInput(['type' =>'number','min'=>1,'max'=>'10'])  ?>

                <?php $model->creator_id=Yii::$app->user->identity->id?>
               
               
                <div class="form-group">
                   <?= Html::submitButton('Devam et', ['class' => 'btn btn-primary']) ?>
                    
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>


