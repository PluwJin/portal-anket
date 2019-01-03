<?php
use kouosl\theme\helpers\Html;
use kouosl\theme\widgets\Portlet;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
use kouosl\anket\models\Survey;
use kouosl\anket\models\Questions;

$this->title = 'Step3';
$data['title'] = Html::encode($this->title);
$this->params['breadcrumbs'][] =['label' => 'Anket','url'=>'/admin/anket'];
$this->params['breadcrumbs'][] =['label' => 'Create','url'=>'/admin/anket/create'];
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
<h1>Step 3</h1>
<hr>

 <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['enableClientValidation'=>false]); ?>
            
            <?php $soru=$_SESSION['optionsQuestions']; $i=0;$a=0; ?> 
            
           
     <div style="border:2px solid black;margin-top: 25px; padding: 25px;border-radius:10px">
        <?= Html::label("Soru: ".$soru[$i]->name,"",['style'=>['color'=>'red','display'=>'block','margin-bottom'=>'10px']]) ?>
         <?php foreach($models as $index=>$model){  ?>   
            
             
            <div style="border:1px solid red;margin-top: 25px; padding: 25px;border-radius:10px">
               
               <?= $form->field($model, "[$index]name")->textInput(['autofocus' => true ,'required'=>true])->label(($a+1).". Seçeneği Giriniz :")  ?>
               </div>
               
                
            

             <?php $a++; if($soru[$i]->option_number==$a){
                 $i++;
                 $a=0; 
                 echo '</div>'; 
                 if($i!=count($soru)) {                
                 echo '<div style="border:2px solid black;margin-top: 25px; padding: 25px;border-radius:10px">'; 
                 echo Html::label("Soru: ".$soru[$i]->name,"",['style'=>['color'=>'red','display'=>'block','margin-bottom'=>'10px']]);
                 
                }} 

                 }?>
                 
            
             

                <div class="form-group">
                    <?= Html::submitButton('Kaydet', ['class' => 'btn btn-primary']) ?>
                    <?= \yii\helpers\Html::a( 'Geri', 'step2',['class' => 'btn btn-success' ,'style'=>'color:black;margin-top:20px']);?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>


</div>



