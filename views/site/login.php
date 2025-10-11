<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Login';
?>
<div class="max-w-md mx-auto card bg-base-100 shadow">
  <div class="card-body">
    <h1 class="card-title">Login</h1>
    <?php $form = ActiveForm::begin(); ?>
      <?= $form->field($model,'username')->textInput(['class'=>'input input-bordered w-full']) ?>
      <?= $form->field($model,'password')->passwordInput(['class'=>'input input-bordered w-full']) ?>
      <div class="card-actions justify-end">
        <?= Html::submitButton('Login', ['class'=>'btn btn-primary']) ?>
      </div>
    <?php ActiveForm::end(); ?>
  </div>
</div>
