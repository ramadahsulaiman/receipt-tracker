<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ReceiptItem $model */

$this->title = 'Update Receipt Item: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Receipt Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="receipt-item-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
