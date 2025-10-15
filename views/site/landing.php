<?php
use yii\helpers\Html;
use yii\helpers\Url;
$this->title = 'Receipt Tracker - Simple by Mada :)';
?>

<!-- Hero Section -->
<section class="min-h-screen overflow-hidden bg-gradient-to-b from-[#0f172a] via-[#111827] to-[#0b1020] text-white">
  <!-- Glow Blobs -->
  <div class="pointer-events-none absolute -top-24 -left-24 h-96 w-96 rounded-full bg-indigo-500/30 blur-3xl"></div>
  <div class="pointer-events-none absolute -bottom-24 -right-24 h-96 w-96 rounded-full bg-fuchsia-500/30 blur-3xl"></div>

  <!-- Navbar -->
  <nav class="container mx-auto px-6 py-6 flex items-center justify-between">
    <div class="flex items-center gap-3">
      <div class="h-9 w-9 rounded-xl bg-white/10 grid place-items-center">
        <span class="text-xl font-bold">RT</span>
      </div>
      <span class="text-lg font-semibold tracking-tight">By Ramadah S.</span>
    </div>

    <!-- existing button for login / signup -->
    <!-- <div class="flex items-center gap-3">
      <a href="</?= Url::to(['site/login']) ?>" class="btn btn-ghost text-white normal-case">Login</a>
      <a href="</?= Url::to(['user/create']) ?>" class="btn btn-primary normal-case">Sign Up</a>
    </div> -->
    <?php if (Yii::$app->user->isGuest): ?>
        <div class="flex space-x-3">
            <a href="<?= Url::to(['site/login']) ?>" 
              class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                Login
            </a>
            <a href="<?= Url::to(['site/signup']) ?>" 
              class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition">
                Sign Up
            </a>
        </div>
    <?php else: ?>
        <div class="flex space-x-3">
            <span class="text-lg text-base-content text-white">
                Welcome,
              <a href="<?= Url::to(['site/index']) ?>" class="link link-hover">
                Yo! <strong><?= Html::encode($user->username ?? $user->name ?? 'User') ?></strong>
              </a>
            </span>
            <a href="<?= Url::to(['site/logout']) ?>" 
              data-method="post"
              class="btn btn-error btn-sm normal-case">
                Logout
            </a>
        </div>
    <?php endif; ?>
  </nav>

  <!-- Hero Content -->
  <div class="container mx-auto px-6 pt-10 pb-20 grid lg:grid-cols-2 items-center gap-10">
    <div>
      <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-tight">
        Track expenses. <span class="text-indigo-400">Snap receipts.</span><br />
        Claim taxes with confidence.
      </h1>
      <p class="mt-5 text-gray-300 text-lg max-w-xl">
        A smart, secure way to store receipts, organize by category, and generate LHDN-ready claim reports — all in one place.
      </p>

      <div class="mt-8 flex flex-wrap gap-3">
        <a href="<?= Url::to(['user/create']) ?>" class="btn btn-primary btn-lg normal-case">Get Started — It’s Free</a>
        <a href="<?= Url::to(['site/login']) ?>" class="btn btn-outline btn-lg normal-case border-white/40 text-white">I already have an account</a>
      </div>

      <div class="mt-6 flex items-center gap-4 text-sm text-gray-400">
        <div class="badge badge-outline">Cloud Storage</div>
        <div class="badge badge-outline">Categories</div>
        <div class="badge badge-outline">Export Reports</div>
      </div>
    </div>

    <!-- Right: Preview Card -->
    <div class="relative">
      <div class="mockup-window border bg-base-300/20 backdrop-blur">
        <div class="bg-base-200/20 px-6 py-8">
          <div class="card w-full max-w-md mx-auto bg-base-100 shadow-xl">
            <div class="card-body">
              <h2 class="card-title">Quick Add</h2>
              <div class="grid grid-cols-2 gap-3">
                <div class="form-control text-base-content">
                  <label class="label"><span class="label-text">Amount (RM)</span></label>
                  <input type="text" class="input input-bordered" value="128.90" />
                </div>
                <div class="form-control text-base-content">
                  <label class="label"><span class="label-text">Category</span></label>
                  <select class="select select-bordered">
                    <option>Groceries</option>
                    <option>Transport</option>
                    <option>Medical</option>
                    <option>Education</option>
                  </select>
                </div>
              </div>
              <div class="form-control mt-3 text-base-content">
                <label class="label"><span class="label-text">Note</span></label>
                <input type="text" class="input input-bordered" placeholder="e.g. Guardian — Vitamins" />
              </div>
              <div class="card-actions justify-end mt-4">
                <button class="btn btn-primary">Save</button>
              </div>
            </div>
          </div>
          <p class="mt-4 text-center text-sm text-gray-400">Snapshot UI preview — your data stays private and secure.</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer / CTA -->
  <div class="container mx-auto px-6 pb-10">
    <div class="divider opacity-30"></div>
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 text-gray-400">
      <p>© <?= date('Y') ?> Receipt Tracker by Mada. All rights reserved.</p>
      <div class="flex gap-4">
        <a class="link link-hover">Privacy</a>
        <a class="link link-hover">Terms</a>
        <a class="link link-hover">Contact</a>
      </div>
    </div>
  </div>
</section>

