<?php
use kouosl\theme\helpers\Html;
use kouosl\theme\widgets\Portlet;

$this->title = 'Step1';
$data['title'] = Html::encode($this->title);
$this->params['breadcrumbs'][] =['label' => 'Create','url'=>'/anket/create'];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1>create/step1</h1>

<p>
  
</p>
