<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = 'Login';
?>

<div class="min-h-screen flex flex-col items-center justify-center bg-gradient-to-br from-primary/10 to-base-200 p-6">
  <!-- Card -->
  <div class="card w-full max-w-md bg-base-100 shadow-2xl border border-base-300 animate-fadeIn">
    <div class="card-body">

      <!-- Title -->
      <h2 class="text-3xl font-bold text-center text-primary mb-2">Welcome Back 👋</h2>
      <p class="text-center text-sm text-base-content/70 mb-6">
        Log in to continue to <strong>Receipt Tracker</strong>
      </p>

      <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

      <!-- Username -->
      <div class="form-control mb-4">
        <?= $form->field($model, 'username', [
          'template' => '{input}{error}',
          'inputOptions' => [
            'class' => 'input input-bordered w-full',
            'placeholder' => 'Username',
          ],
        ]) ?>
      </div>

      <!-- Password -->
      <div class="form-control mb-2">
        <?= $form->field($model, 'password', [
          'template' => '{input}{error}',
          'inputOptions' => [
            'class' => 'input input-bordered w-full',
            'placeholder' => 'Password',
            'type' => 'password',
          ],
        ]) ?>
      </div>

      <!-- Remember me -->
      <div class="form-control flex-row items-center mb-4">
        <label class="label cursor-pointer gap-2">
          <?= $form->field($model, 'rememberMe')->checkbox(['class' => 'checkbox checkbox-primary'], false)->label(false) ?>
          <span class="label-text text-sm">Remember me</span>
        </label>
      </div>

      <!-- Login button -->
      <div class="form-control mt-2">
        <?= Html::submitButton('Login', [
          'class' => 'btn btn-primary w-full normal-case',
        ]) ?>
      </div>

      <!-- Divider -->
      <div class="divider text-sm text-gray-500">or continue with</div>

      <!-- Social Buttons -->
      <div class="flex flex-col gap-2">
        <button type="button" class="btn btn-outline w-full normal-case">
          <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/google/google-original.svg" alt="Google" class="w-5 h-5 mr-2">
          Continue with Google
        </button>
        <button type="button" class="btn btn-outline w-full normal-case">
          <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/facebook/facebook-original.svg" alt="Facebook" class="w-5 h-5 mr-2">
          Continue with Facebook
        </button>
      </div>

      <!-- Sign up -->
      <div class="text-center mt-6">
        <p class="text-sm text-gray-500">
          Don’t have an account?
          <a href="<?= Url::to(['site/signup']) ?>" class="link link-hover text-primary font-medium">Sign Up</a>
        </p>
      </div>

      <?php ActiveForm::end(); ?>
    </div>
  </div>
</div>
<!-- End of Card -->
