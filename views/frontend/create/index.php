<?php 

use kouosl\theme\helpers\Html;
use kouosl\theme\widgets\Portlet;

$this->title = 'Create';
$data['title'] = Html::encode($this->title);
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
.teaser{

    display: block;
 margin-left: 35%;
 margin-top: 35px;
}
</style>

<div class="tutorial">
    <h1>Anket Oluşturma Sayfasına Hoşgeldiniz</h1>
    <hr>
<p>
Oluşturma bölümü 4 Basamaktan oluşan bir işlem içerir:
</p>
<div class="content">
<ul>
 <li>Step 1:
  <ul>
   <li>Anket ismi</li>
   <li>Anket soru sayısı</li>
  </ul>
 </li>
 <li>Step 2: Herbir soru için form tipi seçilir</li>
 <li>Step 3: Her bir soru için:
  <ul>
   <li>Soru ismi</li>
   <li>Textfield için cevabın maksimum uzunluğu, diğer form türleri için option sayısı</li>
   <li>Sorunun cevaplanmasının gerekli olup olmadığı</li>
  </ul> 
 </li>
<li>Step 4: Text field harici formların option bilgilerinin girilmesi</li>
</ul>
<?= Html::a('Devam Et','/anket/create/step1',['class' =>'teaser']) ?>
</div>


</div>