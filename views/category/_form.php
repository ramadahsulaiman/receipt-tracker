<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Category $model */
/** @var yii\widgets\ActiveForm $form */
?>
<head>
  <style>
    input:focus, textarea:focus, select:focus {
      outline: none;
      border-color: hsl(var(--p));
      box-shadow: 0 0 0 3px hsl(var(--p)/0.25);
      transition: all 0.2s ease;
    }

    label {
      font-weight: 600;
      color: hsl(var(--bc));
    }
  </style>
</head>


<div class="bg-base-100 border border-base-300 rounded-2xl shadow-xl p-3 md:p-10 space-y-8">

  <?php $form = ActiveForm::begin([
      'options' => ['class' => 'space-y-4'],
      'fieldConfig' => [
        'template' => "{label}\n{input}\n{error}",
        'labelOptions' => ['class' => 'font-medium text-base-content'],
        'errorOptions' => ['class' => 'text-red-600 text-sm mt-1'],
    ],
  ]); ?>

  <!--  Category Information -->
  <div class="mt-2 grid md:grid-cols-2 gap-10">

    <!-- Left column -->
    <div class="space-y-6">
      <div class="form-control w-full">
        <label class="label">
          <span class="label-text font-semibold text-base-content">Nama Kategori</span>
        </label>
        <div class="relative">
          <i class="fa-solid fa-tag absolute left-3 top-3 text-base-content/50"></i>
          <?= $form->field($model, 'name', [
              'template' => "{input}\n{hint}\n{error}",
          ])->textInput([
              'maxlength' => true,
              'placeholder' => 'Category name (e.g. Groceries, Medical, Travel)',
              'class' => 'input input-bordered w-full pl-10 h-12',
          ]) ?>
        </div>
      </div>

      <div class="form-control w-full">
        <label class="label">
          <span class="label-text font-semibold text-base-content">Max Deduction</span>
        </label>
        <div class="relative">
          <i class="fa-solid fa-wallet absolute left-3 top-3 text-base-content/50"></i>
          <?= $form->field($model, 'max_deduction', [
              'template' => "{input}\n{hint}\n{error}",
          ])->textInput([
              'maxlength' => true,
              'placeholder' => '0.00',
              'class' => 'input input-bordered w-full pl-10 h-12',
          ]) ?>
        </div>
      </div>
    </div>

    <!-- Right column -->
    <div class="form-control w-full">
      <label class="label">
        <span class="label-text font-semibold text-base-content">Penerangan</span>
      </label>
      <div class="relative">
        <i class="fa-solid fa-align-left absolute left-3 top-3 text-base-content/50"></i>
        <?= $form->field($model, 'description', [
            'template' => "{input}\n{hint}\n{error}",
        ])->textarea([
            'rows' => 5,
            'class' => 'textarea textarea-bordered w-full pl-10 min-h-[120px]',
            'placeholder' => 'Keterangan ringkas tentang kategori ini',
        ]) ?>
      </div>
    </div>
  </div>

  <!--  Tax & Status -->
  <div class="grid md:grid-cols-2 gap-10">
    <div class="form-control w-full">
      <label class="label">
        <span class="label-text font-semibold text-base-content">Boleh claim tax?</span>
      </label>
      <div class="relative">
        <i class="fa-solid fa-receipt absolute left-3 top-3 text-base-content/50"></i>
        <?= $form->field($model, 'is_tax_claimable', [
            'template' => "{input}\n{hint}\n{error}",
        ])->dropDownList([
            1 => 'Ya',
            0 => 'Tak',
        ], [
            'class' => 'select select-bordered w-full pl-10 h-12',
            'prompt' => 'Select option',
        ]) ?>
      </div>
    </div>

    <div class="form-control w-full">
      <label class="label">
        <span class="label-text font-semibold text-base-content">Status Kategori</span>
      </label>
      <div class="relative">
        <i class="fa-solid fa-toggle-on absolute left-3 top-3 text-base-content/50"></i>
        <?= $form->field($model, 'active', [
            'template' => "{input}\n{hint}\n{error}",
        ])->dropDownList([
            1 => 'Aktif',
            0 => 'Tak aktif',
        ], [
            'class' => 'select select-bordered w-full pl-10 h-12',
            'prompt' => 'Select option',
        ]) ?>
      </div>
    </div>
  </div>

  <!-- 🟩 Action Buttons -->
  <?= $this->render('../layouts/_formButtons', [
      'cancelUrl' => ['/site/index'],
      'saveLabel' => '<i class="fa-solid fa-floppy-disk mr-2"></i> Simpan Kategori',
      'cancelLabel' => '<i class="fa-solid fa-rotate-left mr-2"></i> Kembali',
  ]) ?>

  <?php ActiveForm::end(); ?>

</div>
