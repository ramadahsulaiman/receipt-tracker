<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\User $model */
/** @var yii\widgets\ActiveForm $form */
?>
<style>
    h1, h2, p, th, td, span, div {
        font-family: 'Spectral';
        letter-spacing: 0.3px;
    }
    th, td {
        font-size: 15px;
    }
    input, textarea {
        color: oklch(var(--bc));
    }
</style>
<div class="user-form">

<?php $form = ActiveForm::begin([
    'id' => 'user-form',
    'options' => ['class' => 'space-y-8'],
]); ?>

  <!-- 🔹 Section 1: Maklumat Peribadi -->
  <div>
    <h2 class="text-lg font-semibold text-base-content/80 mb-4 border-b border-base-300 pb-2">
      <i class="fa-solid fa-user text-primary"></i> Maklumat Peribadi
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

      <div class="form-control">
        <label class="label"><span class="label-text">Nama Penuh</span></label>
        <div class="relative">
          <i class="fa-solid fa-user absolute left-3 top-3 text-base-content/50"></i>
          <?= $form->field($model, 'full_name', ['options' => ['class' => 'm-0']])
              ->textInput(['maxlength' => true, 'class' => 'input input-bordered w-full rounded-lg pl-10'])
              ->label(false) ?>
        </div>
      </div>

      <div class="form-control">
        <label class="label"><span class="label-text">Nama Pengguna</span></label>
        <div class="relative">
          <i class="fa-solid fa-id-card absolute left-3 top-3 text-base-content/50"></i>
          <?= $form->field($model, 'username', ['options' => ['class' => 'm-0']])
              ->textInput(['maxlength' => true, 'class' => 'input input-bordered w-full rounded-lg pl-10'])
              ->label(false) ?>
        </div>
      </div>

      <div class="form-control">
        <label class="label"><span class="label-text">Emel</span></label>
        <div class="relative">
          <i class="fa-solid fa-envelope absolute left-3 top-3 text-base-content/50"></i>
          <?= $form->field($model, 'email', ['options' => ['class' => 'm-0']])
              ->input('email', ['class' => 'input input-bordered w-full rounded-lg pl-10'])
              ->label(false) ?>
        </div>
      </div>

      <div class="form-control">
        <label class="label"><span class="label-text">No. Telefon</span></label>
        <div class="relative">
          <i class="fa-solid fa-phone absolute left-3 top-3 text-base-content/50"></i>
          <?= $form->field($model, 'phone_number', ['options' => ['class' => 'm-0']])
              ->textInput(['maxlength' => true, 'class' => 'input input-bordered w-full rounded-lg pl-10'])
              ->label(false) ?>
        </div>
      </div>

      <div class="form-control">
        <label class="label"><span class="label-text">No. Kad Pengenalan</span></label>
        <div class="relative">
          <i class="fa-solid fa-id-badge absolute left-3 top-3 text-base-content/50"></i>
          <?= $form->field($model, 'ic_number', ['options' => ['class' => 'm-0']])
              ->textInput(['maxlength' => true, 'class' => 'input input-bordered w-full rounded-lg pl-10'])
              ->label(false) ?>
        </div>
      </div>

      <div class="form-control md:col-span-2">
        <label class="label"><span class="label-text">Alamat</span></label>
        <div class="relative">
          <i class="fa-solid fa-location-dot absolute left-3 top-3 text-base-content/50"></i>
          <?= $form->field($model, 'address', ['options' => ['class' => 'm-0']])
              ->textarea(['rows' => 2, 'class' => 'textarea textarea-bordered w-full rounded-lg pl-10 pt-3'])
              ->label(false) ?>
        </div>
      </div>

    </div>
  </div>

  <!-- 🔹 Section 2: Maklumat Pekerjaan -->
  <div>
    <h2 class="text-lg font-semibold text-base-content/80 mb-4 border-b border-base-300 pb-2">
      <i class="fa-solid fa-briefcase text-secondary"></i> Maklumat Pekerjaan
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

      <div class="form-control">
        <label class="label"><span class="label-text">Nama Majikan</span></label>
        <div class="relative">
          <i class="fa-solid fa-building absolute left-3 top-3 text-base-content/50"></i>
          <?= $form->field($model, 'employer_name', ['options' => ['class' => 'm-0']])
              ->textInput(['maxlength' => true, 'class' => 'input input-bordered w-full rounded-lg pl-10'])
              ->label(false) ?>
        </div>
      </div>

      <div class="form-control">
        <label class="label"><span class="label-text">No. Majikan</span></label>
        <div class="relative">
          <i class="fa-solid fa-hashtag absolute left-3 top-3 text-base-content/50"></i>
          <?= $form->field($model, 'employer_number', ['options' => ['class' => 'm-0']])
              ->textInput(['maxlength' => true, 'class' => 'input input-bordered w-full rounded-lg pl-10'])
              ->label(false) ?>
        </div>
      </div>

    </div>
  </div>

  <!-- 🔹 Section 3: Maklumat Kewangan -->
  <div>
    <h2 class="text-lg font-semibold text-base-content/80 mb-4 border-b border-base-300 pb-2">
      <i class="fa-solid fa-piggy-bank text-primary"></i> Maklumat Kewangan
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

      <div class="form-control">
        <label class="label"><span class="label-text">Nama Bank</span></label>
        <div class="relative">
          <i class="fa-solid fa-building-columns absolute left-3 top-3 text-base-content/50"></i>
          <?= $form->field($model, 'bank_name', ['options' => ['class' => 'm-0']])
              ->textInput(['maxlength' => true, 'class' => 'input input-bordered w-full rounded-lg pl-10'])
              ->label(false) ?>
        </div>
      </div>

      <div class="form-control">
        <label class="label"><span class="label-text">No. Akaun Bank</span></label>
        <div class="relative">
          <i class="fa-solid fa-credit-card absolute left-3 top-3 text-base-content/50"></i>
          <?= $form->field($model, 'bank_account', ['options' => ['class' => 'm-0']])
              ->textInput(['maxlength' => true, 'class' => 'input input-bordered w-full rounded-lg pl-10'])
              ->label(false) ?>
        </div>
      </div>

      <div class="form-control md:col-span-2">
        <label class="label"><span class="label-text">No. Cukai</span></label>
        <div class="relative">
          <i class="fa-solid fa-file-invoice-dollar absolute left-3 top-3 text-base-content/50"></i>
          <?= $form->field($model, 'tax_number', ['options' => ['class' => 'm-0']])
              ->textInput(['maxlength' => true, 'class' => 'input input-bordered w-full rounded-lg pl-10'])
              ->label(false) ?>
        </div>
      </div>

    </div>
  </div>

  <!-- 🔹 Section 4: Status Keluarga -->
  <div>
    <h2 class="text-lg font-semibold text-base-content/80 mb-4 border-b border-base-300 pb-2">
      <i class="fa-solid fa-children text-pink-500"></i> Status Keluarga
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

      <div class="form-control">
        <label class="label"><span class="label-text">Status Perkahwinan</span></label>
        <div class="relative">
          <i class="fa-solid fa-ring absolute left-3 top-3 text-base-content/50"></i>
          <?= $form->field($model, 'marital_status', ['options' => ['class' => 'm-0']])
              ->dropDownList([
                  'Bujang' => 'Bujang',
                  'Berkahwin' => 'Berkahwin',
                  'Duda' => 'Duda',
                  'Janda' => 'Janda',
              ], ['prompt' => 'Pilih Status', 'class' => 'select select-bordered w-full rounded-lg pl-10'])
              ->label(false) ?>
        </div>
      </div>

      <div class="form-control">
        <label class="label"><span class="label-text">Bilangan Tanggungan</span></label>
        <div class="relative">
          <i class="fa-solid fa-children absolute left-3 top-3 text-base-content/50"></i>
          <?= $form->field($model, 'dependents', ['options' => ['class' => 'm-0']])
              ->textInput(['type' => 'number', 'min' => 0, 'class' => 'input input-bordered w-full rounded-lg pl-10'])
              ->label(false) ?>
        </div>
      </div>

    </div>
  </div>

<?php ActiveForm::end(); ?>

</div>
