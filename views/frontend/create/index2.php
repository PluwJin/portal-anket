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

<?php
$script=<<< JS
$(document).ready(function() {

 $("#soruEkleButton").click(function(){
     


 });





});








JS;
$this->registerJs($script);
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



<?php $form = ActiveForm::begin(); ?>

 <fieldset>
      <div class="row",id="Step1">
         <h1>Step 1</h1>
         <hr>
         <div class="col-lg-5">
         
              <?= $form->field($Smodel, 'name')->textInput(['autofocus' => true]) ?> 

              <?= Html::button("Soru Ekle",['id'=>'soruEkleButton','name'=>'S_ekle_button','class'=>'main_buttons','value'=>'ekle'])  ?>
                       
         </div>
      </div>
  </fieldset>

  





<?php ActiveForm::end(); ?>
