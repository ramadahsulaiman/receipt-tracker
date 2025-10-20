<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Receipt $model */
/** @var array $category */

$this->title = 'Kemaskini Resit: ' . Html::encode($model->category->name);
$this->params['breadcrumbs'][] = ['label' => 'Resit', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Resit #' . $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Kemaskini';
?>

<div class="receipt-update p-6 bg-base-100 rounded-2xl shadow-lg">
    <!-- 🔹 Header Section -->
    <div class="flex flex-col md:flex-row justify-between md:items-center mb-6 border-b border-base-300 pb-4">
        <div class="mb-3 md:mb-0">
            <h1 class="text-2xl font-bold text-base-content">
                <i class="fa-solid fa-pen-to-square text-primary"></i>
                <?= Html::encode($this->title) ?>
            </h1>
            <p class="text-sm text-base-content/70 mt-1">
                Kemas kini maklumat resit anda.Boleh tukar fail, kategori, vendor/kedai, atau item resit.
            </p>

            <?php if (!empty($model->updated_at)): ?>
                <p class="text-xs text-base-content/50 mt-1">
                    <i class="fa-regular fa-clock text-primary"></i>
                    Dikemaskini kali terakhir pada:
                    <?= Yii::$app->formatter->asDatetime($model->updated_at, 'php:d M Y, h:i A') ?>
                </p>
            <?php endif; ?>
        </div>

        <div class="flex gap-2">
            <!-- Kembali ke halaman resit -->
            <a href="<?= Yii::$app->urlManager->createUrl(['receipt/view', 'id' => $model->id]) ?>" 
               class="btn btn-sm btn-outline btn-warning text-black">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>

            <!-- Lihat semua resit -->
            <a href="<?= Yii::$app->urlManager->createUrl(['receipt/index']) ?>" 
               class="btn btn-sm btn-outline btn-neutral">
                <i class="fa-solid fa-list"></i> Senarai Resit
            </a>
        </div>
    </div>

    <!-- 🔹 Update Form Section -->
    <div class="bg-base-200/40 rounded-xl p-4 md:p-6">
        <?= $this->render('_form', [
            'model' => $model,
            'category' => $category, // ✅ ensure the variable is passed to form
        ]) ?>
    </div>
</div>
