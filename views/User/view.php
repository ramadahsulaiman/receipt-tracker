<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->full_name ?: $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

\yii\web\YiiAsset::register($this);
?>

<?php
// ✅ Proper Google Font import
$this->registerCssFile('https://fonts.googleapis.com/css2?family=Spectral:wght@400;500;600&display=swap', [
    'rel' => 'stylesheet',
]);
?>

<style>
  h1, h2, p, th, td, span, div {
    font-family: 'Spectral', sans-serif;
    letter-spacing: 0.3px;
  }
  th, td {
    font-size: 15px;
  }
</style>

<div class="min-h-screen bg-base-200 text-base-content flex justify-center py-10 px-4">
  <div class="w-full max-w-4xl bg-base-100 shadow-xl rounded-2xl border border-base-300 overflow-hidden">

    <!-- Header -->
    <div class="bg-gradient-to-r from-primary to-secondary text-base-100 p-8 text-center relative">
      <div class="avatar">
        <div class="w-28 h-28 rounded-full ring ring-offset-2 ring-base-100 mx-auto shadow-lg">
          <img src="https://ui-avatars.com/api/?name=<?= urlencode($model->full_name ?: $model->username) ?>&background=random&color=fff" alt="Profile Avatar">
        </div>
      </div>
      <h1 class="text-2xl font-bold mt-4"><?= Html::encode($this->title) ?></h1>
      <p class="text-sm opacity-90"><?= Html::encode($model->email) ?></p>

      <div class="absolute top-6 right-6">
        <?= Html::a('<i class="fa-solid fa-pen-to-square"></i> Edit', ['update', 'id' => $model->id], [
            'class' => 'btn btn-sm btn-outline btn-light hover:btn-primary',
        ]) ?>
      </div>
    </div>

    <!-- Body -->
    <div class="p-8 space-y-8">

      <!-- 🔹 Section 1: Maklumat Peribadi -->
      <div>
        <h2 class="text-lg font-semibold text-base-content/80 mb-4 border-b border-base-300 pb-2">
          <i class="fa-solid fa-user text-primary"></i> Maklumat Peribadi
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div><span class="font-semibold text-base-content/70">Nama Penuh:</span><br><?= Html::encode($model->full_name) ?></div>
          <div><span class="font-semibold text-base-content/70">Nama Pengguna:</span><br><?= Html::encode($model->username) ?></div>
          <div><span class="font-semibold text-base-content/70">Emel:</span><br><?= Html::encode($model->email) ?></div>
          <div><span class="font-semibold text-base-content/70">No. Telefon:</span><br><?= Html::encode($model->phone_number) ?></div>
          <div><span class="font-semibold text-base-content/70">No. Kad Pengenalan:</span><br><?= Html::encode($model->ic_number) ?></div>
          <div class="md:col-span-2"><span class="font-semibold text-base-content/70">Alamat:</span><br><?= nl2br(Html::encode($model->address)) ?></div>
        </div>
      </div>

      <!-- 🔹 Section 2: Maklumat Pekerjaan -->
      <div>
        <h2 class="text-lg font-semibold text-base-content/80 mb-4 border-b border-base-300 pb-2">
          <i class="fa-solid fa-briefcase text-secondary"></i> Maklumat Pekerjaan
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div><span class="font-semibold text-base-content/70">Nama Majikan:</span><br><?= Html::encode($model->employer_name) ?></div>
          <div><span class="font-semibold text-base-content/70">No. Majikan:</span><br><?= Html::encode($model->employer_number) ?></div>
        </div>
      </div>

      <!-- 🔹 Section 3: Maklumat Kewangan -->
      <div>
        <h2 class="text-lg font-semibold text-base-content/80 mb-4 border-b border-base-300 pb-2">
          <i class="fa-solid fa-piggy-bank text-primary"></i> Maklumat Kewangan
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div><span class="font-semibold text-base-content/70">Nama Bank:</span><br><?= Html::encode($model->bank_name) ?></div>
          <div><span class="font-semibold text-base-content/70">No. Akaun Bank:</span><br><?= Html::encode($model->bank_account) ?></div>
          <div class="md:col-span-2"><span class="font-semibold text-base-content/70">No. Cukai:</span><br><?= Html::encode($model->tax_number) ?></div>
        </div>
      </div>

      <!-- 🔹 Section 4: Status Keluarga -->
      <div>
        <h2 class="text-lg font-semibold text-base-content/80 mb-4 border-b border-base-300 pb-2">
          <i class="fa-solid fa-children text-pink-500"></i> Status Keluarga
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div><span class="font-semibold text-base-content/70">Status Perkahwinan:</span><br><?= Html::encode($model->marital_status ?: '-') ?></div>
          <div><span class="font-semibold text-base-content/70">Bilangan Tanggungan:</span><br><?= Html::encode($model->dependents ?: 0) ?></div>
        </div>
      </div>
    </div>

    <!-- Danger Zone -->
    <div class="border-t border-base-300 bg-error/10 p-8 text-center mt-6">
      <h2 class="text-lg font-semibold text-error mb-3">⚠️ Nak delete akaun ke?</h2>
      <sppan class="text-sm text-base-content mb-5">
        Tindakan ini tidak boleh diundurkan selepas akaun dipadam.
        </span>
        <br>
      <?= Html::a('<i class="fa-solid fa-trash"></i> Delete Akaun', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-sm bg-red-500/50 text-white-600 border border-red-500/20 hover:bg-red-500 hover:text-white hover:border-transparent transition-all duration-300',
          'data' => [
              'confirm' => 'Nak delete akaun ke? Tindakan ini tidak boleh diundurkan.',
              'method' => 'post',
          ],
      ]) ?>
    </div>
  </div>
</div>
