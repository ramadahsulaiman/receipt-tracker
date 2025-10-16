<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = 'Login';
?>

<div class="min-h-screen flex flex-col items-center justify-center bg-base-200 text-base-content px-6 py-12">

  <!-- Animated Gradient Circle (soft background accent) -->
  <div class="absolute inset-0 overflow-hidden -z-10">
    <div class="absolute top-[-10rem] left-[-10rem] w-96 h-96 bg-primary/20 rounded-full blur-3xl animate-pulse"></div>
    <div class="absolute bottom-[-10rem] right-[-10rem] w-96 h-96 bg-secondary/20 rounded-full blur-3xl animate-pulse"></div>
  </div>

  <!-- Card -->
  <div class="card w-full max-w-md bg-base-100 shadow-2xl border border-base-300 animate-fadeIn">
    <div class="card-body">

      <!-- Logo + Title -->
      <div class="flex flex-col items-center mb-6">
      <div class="bg-primary/10 p-3 rounded-2xl mb-3">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" class="w-14 h-14 text-primary">
          <rect x="10" y="18" width="44" height="28" rx="6" ry="6" stroke="currentColor" stroke-width="4" fill="none"/>
          <circle cx="44" cy="32" r="4" fill="currentColor"/>
          <path d="M10 26h44" stroke="currentColor" stroke-width="4"/>
        </svg>
      </div>
        <h2 class="text-3xl font-extrabold text-primary mb-1">Welcome Back</h2>
        <p class="text-sm text-base-content/70">Log in to continue to <strong>Receipt Tracker</strong></p>
      </div>

      <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

      <!-- Username -->
      <div class="form-control mb-4">
        <label class="label">
          <span class="label-text font-medium">Username</span>
        </label>
        <div class="input input-bordered flex items-center gap-3">
          <!-- Offline SVG user icon -->
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 opacity-70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M15 19a4 4 0 00-8 0m8 0a4 4 0 00-8 0m8 0H7m8 0h2a2 2 0 002-2v-5a8 8 0 10-16 0v5a2 2 0 002 2h2" />
          </svg>
          <?= $form->field($model, 'username', [
            'template' => '{input}{error}',
            'inputOptions' => [
              'class' => 'grow bg-transparent outline-none',
              'placeholder' => 'Enter your username',
            ],
          ]) ?>
        </div>
      </div>

      <!-- Password -->
      <div class="form-control mb-2">
        <label class="label">
          <span class="label-text font-medium">Password</span>
        </label>
        <div class="input input-bordered flex items-center gap-3">
          <!-- Offline SVG lock icon -->
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 opacity-70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M12 11c1.104 0 2 .896 2 2v2a2 2 0 11-4 0v-2c0-1.104.896-2 2-2zM7 11V9a5 5 0 1110 0v2m-5 10a9 9 0 100-18 9 9 0 000 18z" />
          </svg>
          <?= $form->field($model, 'password', [
            'template' => '{input}{error}',
            'inputOptions' => [
              'class' => 'grow bg-transparent outline-none',
              'placeholder' => 'Enter your password',
              'type' => 'password',
            ],
          ]) ?>
        </div>
      </div>

      <!-- Remember Me -->
      <div class="flex items-center justify-between mt-3 mb-4">
        <label class="label cursor-pointer gap-2">
          <?= $form->field($model, 'rememberMe')->checkbox(['class' => 'checkbox checkbox-primary'], false)->label(false) ?>
          <span class="label-text text-sm">Remember me</span>
        </label>
        <a href="#" class="text-sm link link-hover text-primary">Forgot password?</a>
      </div>

      <!-- Login Button -->
      <div class="form-control mt-2">
        <?= Html::submitButton('<span class="mr-2">🔐</span> Login', [
          'class' => 'btn btn-primary w-full normal-case font-semibold tracking-wide',
        ]) ?>
      </div>

      <!-- Divider -->
      <div class="divider text-sm text-base-content/60">or sign in with</div>

      <!-- Social Buttons (SVG only, no external image) -->
      <div class="flex flex-col gap-2">
        <button type="button" class="btn btn-outline w-full normal-case flex items-center justify-center gap-3">
          <!-- Google SVG -->
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="w-5 h-5">
            <path fill="#fbc02d" d="M43.6 20.5H42V20H24v8h11.3A11.97 11.97 0 0112 24a12 12 0 0120.4-8.5l5.7-5.7A20 20 0 1044 24c0-.9-.1-1.7-.4-2.5z"/>
            <path fill="#e53935" d="M6.3 14.7l6.6 4.8A12 12 0 0124 12c3.1 0 6 1.2 8.2 3.2l6.1-6.1A20 20 0 006.3 14.7z"/>
            <path fill="#4caf50" d="M24 44a19.9 19.9 0 0013.9-5.4l-6.4-5.4A11.96 11.96 0 0112 24H4v8a20 20 0 0020 12z"/>
            <path fill="#1565c0" d="M43.6 20.5H42V20H24v8h11.3A12 12 0 0124 36c3.1 0 6-1.2 8.2-3.2l5.7 5.7A20 20 0 0044 24c0-.9-.1-1.7-.4-2.5z"/>
          </svg>
          Google
        </button>
      </div>

      <!-- Sign Up -->
      <div class="text-center mt-6">
        <p class="text-sm text-base-content/70">
          Dont have an account?
          <a href="<?= Url::to(['user/create']) ?>" class="link link-hover text-primary font-medium">Sign Up</a>
        </p>
      </div>

      <?php ActiveForm::end(); ?>
    </div>
  </div>
</div>
