<?php 

use kouosl\theme\helpers\Html;
use kouosl\theme\widgets\Portlet;

$this->title = 'Create';
$data['title'] = Html::encode($this->title);
$this->params['breadcrumbs'][] =['label' => 'Anket','url'=>'/anket'];
$this->params['breadcrumbs'][] = $this->title;

?>
<style>
h1{
    font-family: "Century Gothic";
    font-size: 40pt;
    text-align: center;
}
.tutorial{
    background-color:#f5f5f5;
    padding: 25px;
    font-family: "Century gothic";
    font-size: 15pt;
    

}
p{
    margin-left: 150px;
}
.content{
    margin-left: 150px;
}

.form-group{
    display: flex;
   
  justify-content: center;
}
.teaser{
    margin-right:50px;
}
</style>

<div class="tutorial">
    <h1>Anket Oluşturma Sayfasına Hoşgeldiniz</h1>
    <hr>
<p>
Oluşturma bölümü 3 Basamaktan oluşan bir işlem içerir:
</p>
<div class="content">
<ul>
 <li>Step 1:
  <ul>
   <li>Anket ismi</li>
   <li>Anket soru sayısı</li>
  </ul>
 </li>
 <li>Step 2: Herbir soru için
 <ul>
   <li>Soru ismi</li>
   <li>Form Tipi</li>
   <li>Text formu dışındakiler için seçenek sayısı</li>
  </ul>
 </li>
 <li>Step 3:Seçenkli sorular için seçeneklerin girilmesi</li>
</ul>

<div class='form-group'>
<?= Html::a('Devam Et','/admin/anket/create/step1',['class' =>'teaser']) ?>
    <?=Html::a('Geri','/admin/anket', $options = ['class'=>'btn btn-success'])  ?>
    </div>
</div>
</div>


