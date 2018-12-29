<?php
use kouosl\theme\helpers\Html;
use kouosl\theme\widgets\Portlet;

$this->title = 'Index Sample';
$data['title'] = Html::encode($this->title);
$this->params['breadcrumbs'][] = $this->title;





echo $this->render('index');





