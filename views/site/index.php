<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Receipt Tracker';
?>

<section class="min-h-screen bg-gradient-to-b from-[#0f172a] via-[#111827] to-[#0b1020] text-white">
  
  <!-- NAVBAR -->
  <nav class="navbar bg-base-100/20 backdrop-blur-md shadow-md sticky top-0 z-50">
    <div class="flex-1">
      <a href="<?= Url::to(['site/index']) ?>" class="btn btn-ghost normal-case text-xl text-white">
        Receipt Tracker
      </a>
    </div>
    <div class="flex-none">
      <?php if (!Yii::$app->user->isGuest): ?>
        <span class="mr-3 text-sm opacity-80">Hey, <strong><?= Html::encode($user->full_name ?? $user->username) ?></strong></span>
        <?= Html::beginForm(['site/logout'], 'post', ['class' => 'inline']) ?>
          <?= Html::submitButton('Logout', ['class' => 'btn btn-sm btn-outline btn-error']) ?>
        <?= Html::endForm() ?>
      <?php else: ?>
        <a href="<?= Url::to(['site/login']) ?>" class="btn btn-sm btn-primary mr-2">Login</a>
        <a href="<?= Url::to(['user/create']) ?>" class="btn btn-sm btn-outline">Sign Up</a>
      <?php endif; ?>
    </div>
  </nav>

  <!-- MAIN CONTENT -->
  <div class="container mx-auto px-4 py-16">
    <?php if (Yii::$app->user->isGuest): ?>
      <div class="text-center max-w-xl mx-auto">
        <h1 class="text-5xl font-bold mb-4">Track your receipts easily 📸</h1>
        <p class="text-gray-300 mb-8">
          Store, categorize, and generate reports for tax claims — all in one place.
        </p>
        <a href="<?= Url::to(['site/login']) ?>" class="btn btn-primary px-8 mr-3">Login</a>
        <a href="<?= Url::to(['user/create']) ?>" class="btn btn-outline px-8">Sign Up</a>
      </div>

    <?php else: ?>
      <!-- Logged-in Menu -->
      <div class="grid gap-6 md:grid-cols-3 mt-8">
        <a href="#" class="card bg-base-100/10 hover:bg-base-100/20 shadow-xl border border-white/10 transition duration-300">
          <div class="card-body items-center text-center">
            <h2 class="card-title text-lg text-primary">📁 My Receipts</h2>
            <p class="opacity-80 text-sm">View, edit, or upload your receipts</p>
          </div>
        </a>

        <a href="#" class="card bg-base-100/10 hover:bg-base-100/20 shadow-xl border border-white/10 transition duration-300">
          <div class="card-body items-center text-center">
            <h2 class="card-title text-lg text-primary">📊 Reports</h2>
            <p class="opacity-80 text-sm">Generate LHDN-ready summaries</p>
          </div>
        </a>

        <a href="#" class="card bg-base-100/10 hover:bg-base-100/20 shadow-xl border border-white/10 transition duration-300">
          <div class="card-body items-center text-center">
            <h2 class="card-title text-lg text-primary">⚙️ Settings</h2>
            <p class="opacity-80 text-sm">Manage your account and preferences</p>
          </div>
        </a>
      </div>
    <?php endif; ?>
  </div>
</section>
