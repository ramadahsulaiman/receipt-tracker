<?php

use yii\helpers\Html;
use app\models\Category;

/** @var yii\web\View $this */
/** @var app\models\Receipt $model */

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
    font-family: 'Spectral', sans-serif;
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

<div class="min-h-screen bg-gradient-to-br from-base-200 to-base-300 text-base-content flex justify-center py-10 px-4">
  <div class="w-full max-w-4xl rounded-2xl shadow-2xl overflow-hidden border border-base-300 receipt-card">

    <!-- Header -->
    <div class="receipt-header p-6 flex items-center justify-between">
      <div class="flex items-center gap-3">
        <div class="bg-base-100/20 rounded-full p-3 shadow-md">
          <i class="fa-solid fa-receipt text-2xl"></i>
        </div>
        <div>
          <h1 class="text-2xl font-bold"><?= Html::encode($this->title) ?></h1>
          <p class="text-sm opacity-90">Rekodkan resit baru anda di sini untuk rujukan perbelanjaan.</p>
        </div>
      </div>
      <div>
        <a href="<?= \yii\helpers\Url::to(['index']) ?>"
           class="btn btn-sm btn-outline btn-light hover:btn-primary">
          <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
      </div>
    </div>

    <!-- Form Section -->
    <div class="p-8">
      <?= $this->render('_form', [
          'model' => $model,
          'categories' => $categories,
      ]) ?>
    </div>

  </div>
</div>
