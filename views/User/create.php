<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = 'Create Account';
?>

<section class="min-h-screen flex items-center justify-center bg-gradient-to-b from-[#0f172a] via-[#111827] to-[#0b1020] text-white relative">
  <div class="pointer-events-none absolute -top-24 -left-24 h-96 w-96 rounded-full bg-indigo-500/30 blur-3xl"></div>
  <div class="pointer-events-none absolute -bottom-24 -right-24 h-96 w-96 rounded-full bg-fuchsia-500/30 blur-3xl"></div>

  <div class="w-full max-w-md bg-white/10 backdrop-blur-md shadow-2xl rounded-2xl p-8 z-10">
    <h1 class="text-3xl font-bold text-center mb-2">Sign Up</h1>
    <p class="text-center text-gray-300 mb-6">Join Receipt Tracker — it’s free!</p>

    <?php $form = ActiveForm::begin(['options' => ['class' => 'space-y-4']]); ?>

      <?= $form->field($model, 'full_name')
          ->textInput(['class' => 'input input-bordered w-full text-black', 'placeholder' => 'Full Name'])
          ->label(false) ?>

      <?= $form->field($model, 'username')
          ->textInput(['class' => 'input input-bordered w-full text-black', 'placeholder' => 'Username'])
          ->label(false) ?>

      <?= $form->field($model, 'email')
          ->textInput(['class' => 'input input-bordered w-full text-black', 'placeholder' => 'Email'])
          ->label(false) ?>

      <?= $form->field($model, 'password')
          ->passwordInput(['class' => 'input input-bordered w-full text-black', 'placeholder' => 'Password'])
          ->label(false) ?>

      <div class="pt-2">
        <?= Html::submitButton('Create Account', [
          'class' => 'btn btn-primary w-full normal-case text-lg font-semibold'
        ]) ?>
      </div>

    <?php ActiveForm::end(); ?>

    <p class="text-center text-gray-400 text-sm mt-5">
      Already have an account?
      <a href="<?= \yii\helpers\Url::to(['site/login']) ?>" class="text-indigo-300 hover:text-indigo-400">Sign in here</a>.
    </p>
  </div>
</section>
