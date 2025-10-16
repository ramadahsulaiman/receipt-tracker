<?php
use yii\helpers\Html;
use yii\helpers\Url;
$this->title = 'Receipt Tracker - Simple by Mada :)';
?>

<!-- Hero Section -->
<section class="relative min-h-screen overflow-hidden bg-base-100 text-base-content flex flex-col">

  <!-- Glow Blobs (theme-aware glow using opacity) -->
  <div class="pointer-events-none absolute -top-24 -left-24 h-96 w-96 rounded-full bg-primary/20 blur-3xl"></div>
  <div class="pointer-events-none absolute -bottom-24 -right-24 h-96 w-96 rounded-full bg-secondary/20 blur-3xl"></div>

  <!-- Navbar -->
  <nav class="container mx-auto px-6 py-6 flex items-center justify-between z-10">
    <div class="flex items-center gap-3">
      <div class="h-9 w-9 rounded-xl bg-primary/10 grid place-items-center">
        <span class="text-xl font-bold text-primary">RT</span>
      </div>
      <span class="text-lg font-semibold tracking-tight">By Ramadah S.</span>
    </div>

    <?php if (Yii::$app->user->isGuest): ?>
      <div class="flex space-x-3">
          <a href="<?= Url::to(['site/login']) ?>" 
            class="btn btn-sm btn-primary rounded-full px-6">
            Masuk
            <i class="fa-solid fa-right-to-bracket ml-2"></i>
          </a>

          <a href="<?= Url::to(['user/create']) ?>" 
            class="btn btn-sm btn-neutral rounded-full px-6">
            Daftar
            <i class="fa-solid fa-user-plus ml-2"></i>
          </a>
      </div>
    <?php else: ?>
      <div class="flex items-center space-x-3">
          <span class="text-lg">
              Welcome,
              <a href="<?= Url::to(['site/index']) ?>" class="link link-hover text-primary font-semibold">
                  Yo! <?= Html::encode($user->username ?? $user->name ?? 'User') ?>
              </a>
          </span>

          <a href="<?= Url::to(['site/logout']) ?>" 
            data-method="post"
            class="btn btn-sm btn-warning rounded-full px-6" 
            title="Logout">
            Logout
          </a>
      </div>
    <?php endif; ?>
  </nav>

  <!-- Hero Content -->
  <div class="container mx-auto px-6 pt-10 pb-20 grid lg:grid-cols-2 items-center gap-10 z-10">
    <div>
      <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-tight">
        Track expenses. <span class="text-primary">Snap receipts.</span><br />
        Claim taxes with confidence.
      </h1>
      <p class="mt-5 text-base-content/70 text-lg max-w-xl">
        A smart, secure way to store receipts, organize by category, and generate LHDN-ready claim reports — all in one place.
      </p>

      <div class="mt-8 flex flex-wrap gap-3">
        <a href="<?= Url::to(['user/create']) ?>" class="btn btn-primary btn-lg normal-case rounded-full">Get Started — It’s Free</a>
        <a href="<?= Url::to(['site/login']) ?>" class="btn btn-outline btn-lg normal-case rounded-full">I already have an account</a>
      </div>

      <div class="mt-6 flex items-center gap-4 text-sm text-base-content/60">
        <div class="badge badge-outline">Cloud Storage</div>
        <div class="badge badge-outline">Categories</div>
        <div class="badge badge-outline">Export Reports</div>
      </div>
    </div>

    <!-- Right: Preview Card -->
    <div class="relative">
      <div class="mockup-window border bg-base-300/30 backdrop-blur">
        <div class="bg-base-200/40 px-6 py-8">
          <div class="card w-full max-w-md mx-auto bg-base-100 shadow-xl">
            <div class="card-body">
              <h2 class="card-title text-primary">Quick Add</h2>
              <div class="grid grid-cols-2 gap-3">
                <div class="form-control">
                  <label class="label"><span class="label-text">Amount (RM)</span></label>
                  <input type="text" class="input input-bordered" value="128.90" />
                </div>
                <div class="form-control">
                  <label class="label"><span class="label-text">Category</span></label>
                  <select class="select select-bordered">
                    <option>Groceries</option>
                    <option>Transport</option>
                    <option>Medical</option>
                    <option>Education</option>
                  </select>
                </div>
              </div>
              <div class="form-control mt-3">
                <label class="label"><span class="label-text">Note</span></label>
                <input type="text" class="input input-bordered" placeholder="e.g. Guardian — Vitamins" />
              </div>
              <div class="card-actions justify-end mt-4">
                <button class="btn btn-primary">Save</button>
              </div>
            </div>
          </div>
          <p class="mt-4 text-center text-sm text-base-content/60">
            Snapshot UI preview — your data stays private and secure.
          </p>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <div class="container mx-auto px-6 pb-10 z-10">
    <div class="divider opacity-30"></div>
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 text-base-content/60">
      <p>© <?= date('Y') ?> Receipt Tracker by Mada. All rights reserved.</p>
      <div class="flex gap-4">
        <a class="link link-hover">Privacy</a>
        <a class="link link-hover">Terms</a>
        <a class="link link-hover">Contact</a>
      </div>
    </div>
  </div>
</section>
