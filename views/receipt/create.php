<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Receipt $model */
/** @var array $category */

$this->title = 'Tambah Resit Baru';
$this->params['breadcrumbs'][] = ['label' => 'Resit', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
// ✅ Include Spectral font for elegant typography
$this->registerCssFile('https://fonts.googleapis.com/css2?family=Spectral:wght@400;500;600&display=swap', [
    'rel' => 'stylesheet',
]);
?>

<style>
  h1, h2, p, span, div, label, input, textarea, select {
    /* font-family: 'Spectral', sans-serif; */
    letter-spacing: 0.2px;
  }

  .receipt-header {
    background: linear-gradient(135deg, oklch(var(--p)) 0%, oklch(var(--s)) 100%);
    color: white;
    border-bottom: 4px solid oklch(var(--a));
  }

  .receipt-card {
    backdrop-filter: blur(12px);
    background-color: oklch(var(--b1) / 0.85);
  }
</style>

<div class="receipt-create p-6 bg-base-100 rounded-2xl shadow-lg">
    <!-- 🔹 Header Section -->
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-base-content flex items-center justify-center gap-2">
                <i class="fa-solid fa-receipt text-primary"></i>
                <?= Html::encode($this->title) ?>
            </h1>
            <p class="text-sm text-base-content mt-1">
                Rekodkan resit baru anda untuk tujuan pemantauan perbelanjaan dan rujukan cukai.
            </p>
          <!-- <div class="flex gap-2"> -->
            <!-- Butang Senarai Resit -->
            <!-- <a href="</?= Yii::$app->urlManager->createUrl(['receipt/index']) ?>"  -->
               <!-- class="btn btn-sm btn-outline btn-neutral"> -->
                <!-- <i class="fa-solid fa-list"></i> Senarai Resit -->
            <!-- </a> -->
        <!-- </div> -->
    </div>

    <!-- 🔹 Create Form Section -->
      <div class="bg-base-100/80 backdrop-blur-md border border-base-300 rounded-xl shadow-md p-6">
        <?= $this->render('_form', [
            'model' => $model,
            'category' => $category,
        ]) ?>
    </div>

    <!-- 🔹 Footer Info -->
    <div class="mt-6 text-center text-xs text-base-content">
        <i class="fa-regular fa-lightbulb text-warning"></i>
        Pastikan semua maklumat diisi dengan tepat sebelum menyimpan resit.
    </div>
</div>
