<?php
use kouosl\theme\helpers\Html;
use kouosl\theme\widgets\Portlet;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
use kouosl\anket\models\Survey;
use kouosl\anket\models\Questions;

$this->title = 'Step2';
$data['title'] = Html::encode($this->title);
$this->params['breadcrumbs'][] =['label' => 'Anket','url'=>'/anket'];
$this->params['breadcrumbs'][] =['label' => 'Create','url'=>'/anket/create'];
$this->params['breadcrumbs'][] = $this->title;

?>
<script>

function ac(p1){
    var index=p1.id;
    index=index.substring(1,2);
if(p1.value!='textInput'){

  document.getElementById(('o'+index)).style.display="block";
  document.getElementById(('o'+index)).setAttribute('required','true');
}
else{
  document.getElementById(('o'+index)).style.display="none";
  document.getElementById(('o'+index)).setAttribute('required','false');
}
}

</script>

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

<div class="row">
<h1>Step 2</h1>
<hr>

        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['enableClientValidation'=>false]); ?>
            
            
            <?php foreach($models as $index=>$model){ ?>    
             <div style="border:2px solid black;margin-top: 10px; padding: 25px;border-radius:10px;">      
               <?= $form->field($model, "[$index]s_id")->textInput(['autofocus' => true ,'required'=>true, 'value'=>$_SESSION['SurveyId'],'readonly'=>true]) ?>

                <?= $form->field($model, "[$index]name")->textInput(['autofocus' => true ,'required'=>true])->label(($index+1).".Soruyu Giriniz:") ?>

                <?= $form->field($model, "[$index]type")->dropDownList(['textInput'=>'Text','radio'=>'Radio','checkbox'=>'Checkbox'],['id'=>('d'.$index),'onchange'=>'ac(this)'])?>
                
                
                <?= $form->field($model, "[$index]required")->dropDownList(['0'=>'Hayır','1'=>'Evet'])->label("Cevaplanması Gerekli mi ?")?>


                <?= $form->field($model, "[$index]option_number")->textInput(['required' => false ,'id' => ('o'.$index) ,'style' => 'display:none' ,'type'=>'number'])?>

                
             </div>
            <?php }?> 


                <div class="form-group">
                    <?= Html::submitButton('Devam et', ['class' => 'btn btn-primary']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>


</div>



