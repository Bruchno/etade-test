<?php
use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\BaseMessage instance of newly created mail message */

?>

<h2>Поступил новый заказ №<?= $order?>.</h2>
<p>  <?= Html::a('Ссылка на заказ ', Url::to('http://example.com/order/view/'.$order)) ?></p>