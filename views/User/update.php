<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\User $model */

$this->title = 'Kemaskini Akaun: ' . Html::encode($model->full_name);
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->full_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Kemaskini';
?>

<div class="min-h-screen bg-base-200 flex justify-center py-10 px-4">
  <div class="w-full max-w-5xl bg-base-100 rounded-2xl shadow-xl border border-base-300 overflow-hidden">

    <!-- Header Section -->
    <div class="bg-gradient-to-r from-primary to-secondary p-8 text-center text-base-100 relative">
      <div class="avatar">
        <div class="w-24 h-24 rounded-full ring ring-offset-2 ring-base-100 mx-auto shadow-lg">
          <img src="https://ui-avatars.com/api/?name=<?= urlencode($model->full_name ?: $model->username) ?>&background=random&color=fff" alt="User Avatar">
        </div>
      </div>
      <h1 class="text-2xl font-bold mt-4"><?= Html::encode($this->title) ?></h1>
      <p class="text-sm opacity-90">Sila semak dan kemaskini maklumat akaun anda di bawah.</p>
    </div>

    <!-- Form Container -->
    <div class="p-8">
      <div class="bg-base-100/80 backdrop-blur-md border border-base-300 rounded-xl shadow-md p-6">

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>

      </div>

      <!-- Action Buttons -->
      <div class="mt-8 flex justify-between items-center">
        <a href="<?= \yii\helpers\Url::to(['view', 'id' => $model->id]) ?>"
           class="btn btn-outline btn-neutral hover:btn-primary">
           <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>

        <?= Html::submitButton('<i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan', [
            'form' => 'user-form',
            'class' => 'btn btn-info text-white px-6',
        ]) ?>
      </div>
    </div>
  </div>
</div>
