<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" data-theme="light">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Tailwind + DaisyUI (CDN for dev) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        theme: { extend: {} },
        plugins: [],
      }
    </script>
    <link href="<?= Yii::getAlias('@web/css/output.css') ?>" rel="stylesheet">
</head>

<body class="min-h-screen bg-base-200">
<?php $this->beginBody() ?>

<!-- Optional Navbar -->
<header class="navbar bg-base-100 shadow-md sticky top-0 z-50">
  <div class="container mx-auto flex justify-between items-center">
    <a href="<?= Url::to(['/site/landing']) ?>" class="btn btn-ghost normal-case text-xl font-bold">
      Receipt Tracker
    </a>

    <?php if (Yii::$app->user->isGuest): ?>
      <nav class="flex gap-2">
        <a href="<?= Url::to(['/site/login']) ?>" class="btn btn-ghost">Login</a>
        <a href="<?= Url::to(['/user/create']) ?>" class="btn btn-primary">Sign Up</a>
      </nav>
    <?php else: ?>
      <nav class="flex items-center gap-2">
        <a href="<?= Url::to(['/receipt/index']) ?>" class="btn btn-ghost">Receipts</a>
        <a href="<?= Url::to(['/category/index']) ?>" class="btn btn-ghost">Categories</a>
        <a href="<?= Url::to(['/report/index']) ?>" class="btn btn-ghost">Reports</a>
        <form action="<?= Url::to(['/site/logout']) ?>" method="post">
          <?= Html::submitButton('Logout', ['class' => 'btn btn-error btn-sm text-white']) ?>
        </form>
      </nav>
    <?php endif; ?>
  </div>
</header>

<main class="container mx-auto p-6 flex-grow">
  <?= $content ?>
</main>

<footer class="p-4 text-center text-sm text-base-content/70">
  © <?= date('Y') ?> Receipt Tracker
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
