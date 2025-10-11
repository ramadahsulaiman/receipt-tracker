<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
// use app\widgets\Alert;
// use yii\bootstrap5\Breadcrumbs;
// use yii\bootstrap5\Html;
// use yii\bootstrap5\Nav;
// use yii\bootstrap5\NavBar;
use yii\helpers\Html;
use yii\helpers\Url;

AppAsset::register($this);

// $this->registerCsrfMetaTags();
// $this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
// $this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
// $this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
// $this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
// $this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" data-theme="light">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
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
