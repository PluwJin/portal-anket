<?php

use kouosl\theme\helpers\Html;
use kouosl\theme\widgets\Portlet;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;
use kouosl\anket\models\Survey;
use kouosl\anket\models\Questions;

$this->title = 'Create';
$data['title'] = Html::encode($this->title);
$this->params['breadcrumbs'][] =['label' => 'Anket','url'=>'/anket'];
$this->params['breadcrumbs'][] = $this->title;

?>






<!--------------------------------------------------------------------------------------------------------------------------------------->
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
<!--------------------------------------------------------------------------------------------------------------------------------------->




<div class="row" id="s1">
<h1>Step 1</h1>
<hr>
        <div class="col-lg-5" id='s2' >
        <?php Pjax::begin(['enablePushState' => true]); ?>
            <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true ]]); ?>
          
           

                <?= $form->field($Smodel, 'name')->textInput(['autofocus' => true]) ?>
                

                <?= $form->field($Smodel, 'q_number')->textInput(['type' =>'number','min'=>1,'max'=>'10'])  ?>

               
                <?= $form->field($Smodel, 'ending_at')->input('date') ?>

                
               
               
                <div class="form-group">
              
                   <?=Html::a("Devam et", ['create/index2?step=2'], ['class' => 'btn btn-lg btn-success']) //Html::submitButton('Devam et', ['class' => 'btn btn-primary']) ?>
                  
                   <?= Html::submitButton('Devam et', ['class' => 'btn btn-primary']) ?>
                </div>
            <?php ActiveForm::end(); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>

<?php
?>

