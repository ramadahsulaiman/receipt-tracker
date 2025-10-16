<?php
use app\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;

AppAsset::register($this);
$this->beginPage();
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" data-theme="light">
<head>
  <meta charset="<?= Yii::$app->charset ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= Html::encode($this->title) ?></title>

  <!-- TailwindCSS + DaisyUI -->
  <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css"
        rel="stylesheet"
        type="text/css"
    />
  <!-- Font Awesome -->
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <?php $this->head() ?>
</head>

<body class="min-h-screen bg-gradient-to-b from-[#f6f8fc] via-[#eef2ff] to-[#e0e7ff] text-base-content flex">
<?php $this->beginBody(); ?>

<!-- Sidebar -->
<aside class="w-64 bg-gradient-to-b from-primary to-blue-900 text-primary-content shadow-2xl hidden md:flex flex-col fixed h-full">
  <div class="p-5 border-b border-base-300/30">
    <h1 class="text-xl font-bold tracking-tight">
      <a href="<?= Url::to(['site/index']) ?>" class="text-white">Receipt Tracker</a>
    </h1>
  </div>

  <nav class="flex-1 p-4 space-y-2">
    <?php
    $currentRoute = Yii::$app->controller->route;
    $menuItems = [
        ['label' => 'Dashboard', 'icon' => 'fa-chart-line', 'url' => ['site/dashboard']],
        ['label' => 'Receipts', 'icon' => 'fa-receipt', 'url' => ['receipt/index']],
        ['label' => 'Categories', 'icon' => 'fa-tags', 'url' => ['category/index']],
        ['label' => 'Reports', 'icon' => 'fa-file-invoice', 'url' => ['report/index']],
    ];
    foreach ($menuItems as $item):
        $isActive = Yii::$app->urlManager->createUrl($item['url']) === Url::to([$currentRoute]);
    ?>
      <a href="<?= Url::to($item['url']) ?>"
         class="flex items-center gap-3 px-4 py-2 rounded-lg transition-all duration-300
         <?= $isActive
           ? 'bg-white/20 text-white font-semibold shadow-inner'
           : 'hover:bg-white/10 text-white/80 hover:text-white' ?>">
        <i class="fa-solid <?= $item['icon'] ?>"></i>
        <?= Html::encode($item['label']) ?>
      </a>
    <?php endforeach; ?>
  </nav>

  <div class="p-4 border-t border-base-300/30">
    <a href="<?= Url::to(['site/logout']) ?>" data-method="post"
       class="btn btn-error w-full normal-case shadow-md">
       <i class="fa-solid fa-right-from-bracket mr-2"></i> Logout
    </a>
  </div>
</aside>

<!-- Main Content -->
<div class="flex-1 md:ml-64 flex flex-col">
  <!-- Navbar -->
<header class="navbar bg-base-100 border-b border-base-300/50 sticky top-0 z-40 shadow-sm px-6 py-3">
  <div class="flex items-center gap-3">
    <h2 class="text-lg font-semibold text-primary"><?= Html::encode($this->title) ?></h2>
  </div>
  <div class="flex items-center gap-4">
    <span class="text-sm text-base-content/80">
      Hey, <strong class="text-primary"><?= Html::encode(Yii::$app->user->identity->username ?? 'User') ?></strong> 👋
    </span>
  </div>
</header>

  <!-- Page Content -->
  <main class="flex-1 p-6 bg-base-200/40 backdrop-blur-sm rounded-tl-xl">
    <?= $content ?>
  </main>

  <!-- Footer -->
  <footer class="p-4 border-t border-base-300 text-center text-sm text-base-content/60 bg-base-100">
    &copy; <?= date('Y') ?> Receipt Tracker — All rights reserved.
  </footer>
</div>

    <!-- Beautiful Theme Switcher -->
    <div class="fixed bottom-6 left-6 z-50">
      <div class="dropdown dropdown-top dropdown-hover">
        <div tabindex="0" role="button" class="btn btn-circle bg-white/20 border-0 backdrop-blur-md hover:bg-white/30 text-base-content shadow-lg">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M12 3v1m0 16v1m8.485-8.485l.707.707M4.808 4.808l.707.707M21 12h1M2 12H1m16.97 4.243l.707.707M4.808 19.192l.707.707M12 5a7 7 0 107 7h-7z" />
          </svg>
        </div>
        <ul tabindex="0" class="dropdown-content menu p-2 shadow-lg bg-base-100 rounded-box w-40 text-base-content">
          <li><a onclick="setTheme('light')">🌤 Light</a></li>
          <li><a onclick="setTheme('dark')">🌙 Dark</a></li>
          <li><a onclick="setTheme('cupcake')">🧁 Cupcake</a></li>
          <li><a onclick="setTheme('business')">💼 Business</a></li>
          <li><a onclick="setTheme('dracula')">🦇 Dracula</a></li>
          <li><a onclick="setTheme('Paste')">🦇 Paste;</a></li>
          <li><a onclick="setTheme('MadaCustom')">🌆 Mada Custom</a></li>
        </ul>
      </div>
    </div>
    <script>
      function setTheme(theme) {
        document.documentElement.setAttribute("data-theme", theme);
        localStorage.setItem("theme", theme);
      }

      // Apply saved theme on load
      (function() {
        const saved = localStorage.getItem("theme");
        if (saved) document.documentElement.setAttribute("data-theme", saved);
      })();
    </script>

<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>
