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
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" />

    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="min-h-screen bg-base-200">
<?php $this->beginBody() ?>

<header class="navbar bg-base-100 shadow">
  <div class="container mx-auto flex justify-between">
    <a href="<?= Url::to(['/']) ?>" class="btn btn-ghost text-xl">Receipt Tracker</a>
    <nav class="flex gap-2">
      <a class="btn btn-ghost" href="<?= Url::to(['/receipt/index']) ?>">Receipts</a>
      <a class="btn btn-ghost" href="<?= Url::to(['/category/index']) ?>">Categories</a>
      <a class="btn btn-primary" href="<?= Url::to(['/report/index']) ?>">Reports</a>
    </nav>
  </div>
</header>

<main class="container mx-auto p-4">
  <?= $content ?>
</main>

<footer class="p-4 text-center text-sm text-base-content/70">
  © <?= date('Y') ?> Receipt Tracker
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
