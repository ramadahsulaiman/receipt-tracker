<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = 'Create Account';
?>

<section class="min-h-screen flex flex-col items-center justify-center bg-white text-base-content px-6 py-12">

  <!-- Glow Blobs (theme-aware glow using opacity) -->
  <div class="pointer-events-none absolute -top-24 -left-24 h-96 w-96 rounded-full bg-primary/20 blur-3xl"></div>
  <div class="pointer-events-none absolute -bottom-24 -right-24 h-96 w-96 rounded-full bg-secondary/20 blur-3xl"></div>

  <!-- Card -->
  <div class="card w-full max-w-md bg-base-100 shadow-2xl border border-base-300 animate-fadeIn">
    <div class="card-body">

      <!-- Logo + Title -->
      <div class="flex flex-col items-center mb-6">
        <div class="bg-primary/10 p-3 rounded-2xl mb-3">
          <!-- Offline SVG icon -->
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" class="w-12 h-12 text-primary">
            <rect x="16" y="8" width="32" height="48" rx="4" ry="4" fill="none" stroke="currentColor" stroke-width="4"/>
            <line x1="22" y1="20" x2="42" y2="20" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
            <line x1="22" y1="28" x2="42" y2="28" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
            <line x1="22" y1="36" x2="34" y2="36" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
          </svg>
        </div>
        <h2 class="text-3xl font-extrabold text-primary mb-1">Create Account</h2>
        <p class="text-sm text-base-content/70">Join <strong>Receipt Tracker</strong> — it’s free!</p>
      </div>

    <?php $form = ActiveForm::begin([
        'id' => 'user-create',
        'options' => ['enctype' => 'multipart/form-data', 'class' => 'space-y-4'],
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'font-medium text-base-content'],
            'errorOptions' => ['class' => 'text-red-600 text-sm mt-1'],
        ],
    ]); ?>

      <!-- Full Name -->
      <div class="form-control">
        <div class="input input-bordered flex items-center gap-3">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 opacity-70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M12 12a5 5 0 100-10 5 5 0 000 10zM4 20v-1a7 7 0 0116 0v1H4z"/>
          </svg>
          <?= $form->field($model, 'full_name', [
              'template' => '{input}{error}',
              'inputOptions' => [
                  'class' => 'grow bg-transparent outline-none',
                  'placeholder' => 'Full Name',
              ],
          ]) ?>
        </div>
      </div>

      <!-- Username -->
      <div class="form-control">
        <div class="input input-bordered flex items-center gap-3">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 opacity-70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
          </svg>
          <?= $form->field($model, 'username', [
              'template' => '{input}{error}',
              'inputOptions' => [
                  'class' => 'grow bg-transparent outline-none',
                  'placeholder' => 'Username',
              ],
          ]) ?>
        </div>
      </div>

      <!-- Email -->
      <div class="form-control">
        <div class="input input-bordered flex items-center gap-3">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 opacity-70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" d="M4 8l8 6 8-6"/>
            <rect x="4" y="4" width="16" height="16" rx="2" ry="2" stroke="currentColor" stroke-width="1.6" fill="none"/>
          </svg>
          <?= $form->field($model, 'email', [
              'template' => '{input}{error}',
              'inputOptions' => [
                  'class' => 'grow bg-transparent outline-none',
                  'placeholder' => 'Email Address',
                  'type' => 'email',
              ],
          ]) ?>
        </div>
      </div>

      <!-- Password (with Show/Hide Toggle) -->
      <div class="form-control relative">
        <div class="input input-bordered flex items-center gap-3 pr-10">
          <!-- lock icon -->
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 opacity-70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M12 11a2 2 0 012 2v3a2 2 0 11-4 0v-3a2 2 0 012-2zM6 11V9a6 6 0 1112 0v2"/>
          </svg>
          <?= $form->field($model, 'password', [
              'template' => '{input}{error}',
              'inputOptions' => [
                  'class' => 'grow bg-transparent outline-none password-input',
                  'placeholder' => 'Password',
                  'type' => 'password',
              ],
          ]) ?>
          <!-- eye icon button -->
          <button type="button" id="togglePassword" class="absolute right-3 opacity-70 hover:opacity-100 transition">
            <!-- eye icon -->
            <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M1.5 12s4.5-7.5 10.5-7.5S22.5 12 22.5 12 18 19.5 12 19.5 1.5 12 1.5 12z"/>
              <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.8"/>
            </svg>
          </button>
        </div>
      </div>

      <!-- Submit -->
      <div class="pt-2">
        <?= Html::submitButton('Create Account', [
            'class' => 'btn btn-primary w-full normal-case font-semibold tracking-wide',
        ]) ?>
      </div>

      <?php ActiveForm::end(); ?>

      <!-- Divider -->
      <div class="divider text-sm text-base-content/60">or sign up with</div>

      <!-- Offline Google Button -->
      <button type="button" class="btn btn-outline w-full normal-case flex items-center justify-center gap-3">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="w-5 h-5">
          <path fill="#EA4335" d="M24 9.5c3.1 0 5.8 1.1 7.9 3l5.9-5.9C34.3 3 29.5 1 24 1 14.7 1 7 7.1 4.1 15.1l7 5.4C12.8 14.3 17.9 9.5 24 9.5z"/>
          <path fill="#34A853" d="M24 44c5.4 0 10-1.8 13.3-5l-6.2-4.9c-1.7 1.1-3.9 1.8-7.1 1.8-5.5 0-10.2-3.7-11.9-8.8l-7.1 5.5C8.5 39.6 15.6 44 24 44z"/>
          <path fill="#4A90E2" d="M43.6 24.5c0-1.5-.1-3-.4-4.5H24v8h11.3c-.5 2.5-1.9 4.7-3.9 6.3l6.2 4.9C41.3 35.7 43.6 30.6 43.6 24.5z"/>
          <path fill="#FBBC05" d="M12.1 26.1a11.97 11.97 0 010-8.2l-7-5.4A19.96 19.96 0 004 24a20 20 0 001.1 6.5l7.1-5.5z"/>
        </svg>
        Continue with Google
      </button>

      <!-- Sign In -->
      <div class="text-center mt-6">
        <p class="text-sm text-base-content/70">
          Already have an account?
          <a href="<?= Url::to(['site/login']) ?>" class="link link-hover text-primary font-medium">Sign In</a>
        </p>
      </div>

    </div>
  </div>
</div>

<!-- Show/Hide Password Script -->
<script>
  const togglePassword = document.getElementById('togglePassword');
  const passwordInput = document.querySelector('.password-input');
  const eyeIcon = document.getElementById('eyeIcon');

  togglePassword.addEventListener('click', () => {
    const isPassword = passwordInput.type === 'password';
    passwordInput.type = isPassword ? 'text' : 'password';
    eyeIcon.innerHTML = isPassword
      ? `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2 2l20 20M9.9 9.9A5 5 0 0012 19a5 5 0 005-5 5 5 0 00-2.1-4.1M12 5c6 0 10.5 7 10.5 7s-4.5 7-10.5 7S1.5 12 1.5 12s4.5-7 10.5-7z"/>`
      : `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M1.5 12s4.5-7.5 10.5-7.5S22.5 12 22.5 12 18 19.5 12 19.5 1.5 12 1.5 12z"/><circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.8"/>`;
  });
</script>

<!-- Success Toast (after account creation) -->
<?php if (Yii::$app->session->hasFlash('showSuccessToast')): ?>
  <?= $this->render('success-toast') ?>
<?php endif; ?>
