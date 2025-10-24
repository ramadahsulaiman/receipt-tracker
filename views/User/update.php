<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\User $model */

$this->title = 'Kemaskini Akaun: ' . Html::encode($model->full_name);
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->full_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Kemaskini';
?>

<div class="user-update p-3 bg-base-100 rounded-2xl shadow-lg">

    <!-- Header Section -->
    <div class="bg-gradient-to-r from-primary to-secondary p-10 text-center text-base-100 relative">
      <div class="avatar">
        <div class="w-20 h-20 rounded-full ring ring-offset-2 ring-base-100 mx-auto shadow-lg">
          <img src="https://ui-avatars.com/api/?name=<?= urlencode($model->full_name ?: $model->username) ?>&background=random&color=fff" alt="User Avatar">
        </div>
      </div>
      <h1 class="text-xl font-bold mt-4"><?= Html::encode($this->title) ?></h1>
      <p class="text-sm opacity-90">Sila semak dan kemaskini maklumat akaun anda di bawah.</p>
    </div>

    <!-- Form Container -->
    <div class="p-10">
      <div class="bg-base-100/80 backdrop-blur-md border border-base-300 rounded-xl shadow-md p-6">

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>

      </div>

        <!-- 🟩 Action Buttons -->
        <?= $this->render('../layouts/_formButtons', [
            'cancelUrl' => ['/site/index'],
            'saveLabel' => '<i class="fa-solid fa-floppy-disk mr-2"></i> Simpan Perubahan',
            'cancelLabel' => '<i class="fa-solid fa-rotate-left mr-2"></i> Kembali',
        ]) ?>
      </div>
    </div>
  </div>
</div>
