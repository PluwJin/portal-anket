<?php

use yii\helpers\Html;

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
.sec{
    margin:50px;
    margin-left:350px;
    
}
h1{
    font-family:Century Gothic;
    margin-bottom:50px;
    color:red;
}
p{
    display:inline;
   
}

</style>


<div class="row">
<div class="sec" >

    <h1><?= Html::encode($this->title) ?></h1>
     <?php $_SESSION['SurveyId']=$model->id; ?>
    <p><a class="btn btn-lg btn-success" href="/anket/create">Soru Çıkar</a></p>
    <?= Html::a('Soru Ekle','/anket/survey',['class'=>'btn btn-primary']) ?>

    <?php //$this->render('_form', [ 'model' => $model ]) ?>
    </div>
</div>
