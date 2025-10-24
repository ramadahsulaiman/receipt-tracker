<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Category $model */

$this->title = 'Set Kategori Baru';
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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

<div class="category-create p-6 bg-base-100 rounded-2xl shadow-lg">


    <!-- Header Section -->
    <div class="text-center mb-8">
      <h1 class="text-3xl font-bold text-base-content mb-2">
        <i class="fa-solid fa-folder-plus text-primary mr-2"></i>
        <?= Html::encode($this->title) ?>
      </h1>
      <p class="text-base-content/70 text-sm md:text-base">
        Fill in the details below to add a new category for your receipts.
      </p>
    </div>

    <!-- Card Container -->
    <div class="bg-white rounded-xl p-3 md:p-3">
        <?= $this->render('_form', 
        ['model' => $model
        ]) ?>
      </div>
    </div>

</div>
