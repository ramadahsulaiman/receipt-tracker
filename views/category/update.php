<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Receipt $model */
/** @var array $category */

$this->title = 'Kemaskini Kategori: ' . Html::encode($model->name);
$this->params['breadcrumbs'][] = ['label' => 'Kategori', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Kategori :' . $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Kemaskini';
?>

<div class="category-update p-6 bg-base-100 rounded-2xl shadow-lg">
    <!-- 🔹 Header Section -->
    <div class="flex flex-col md:flex-row justify-between md:items-center mb-6 border-b border-base-300 pb-4">
        <div class="mb-3 md:mb-0">
            <h1 class="text-2xl font-bold text-base-content">
                <i class="fa-solid fa-pen-to-square text-primary"></i>
                <?= Html::encode($this->title) ?>
            </h1>
            <p class="text-sm text-base-content/70 mt-1">
                Kemas kini maklumat kategori anda.
            </p>

            <?php if (!empty($model->updated_at)): ?>
                <span class="text-xs text-base-content/50 mt-1">
                    <i class="fa-regular fa-clock text-primary"></i>
                    Dikemaskini kali terakhir pada:
                    <?= Yii::$app->formatter->asDatetime($model->updated_at, 'php:d M Y, h:i A') ?>
            </span>
            <?php endif; ?>
        </div>
    </div>

    <!-- 🔹 Update Form Section -->
    <div class="bg-base-200/40 rounded-xl p-3 md:p-3">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>
