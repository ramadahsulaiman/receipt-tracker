<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\YiiAsset;
use app\assets\AppAsset;
use yii\bootstrap5\BootstrapAsset;
use yii\bootstrap5\BootstrapPluginAsset;
use yii\icons\IconAsset;
use yii\web\View;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap5\Modal;
use yii\helpers\ArrayHelper;
use app\models\Receipt;


YiiAsset::register($this);

app\assets\AppAsset::register($this);
$username = Yii::$app->user->isGuest ? 'Guest' : Yii::$app->user->identity->username;
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" data-theme="light">

<?php
// Register Google Font properly (Yii2 way)
$this->registerCssFile('https://fonts.googleapis.com/css2?family=Andika:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet', [
    'rel' => 'stylesheet',
    'crossorigin' => 'anonymous',
]);
?>


<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?> 

    <title><?= Html::encode($this->title) ?></title>

    <!-- 1. Set theme early -->
    <script>
      const savedTheme = localStorage.getItem("theme") || "light";
      document.documentElement.setAttribute("data-theme", savedTheme);
    </script>

    <!-- 2. Tailwind + DaisyUI -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="<?= Yii::getAlias('@web/css/output.css') ?>">

    <style>
      /* Smooth fade animation for sidebar overlay */
      #overlay {
        transition: opacity 0.3s ease-in-out, visibility 0.3s;
      }
      #sidebar {
        transition: transform 0.3s ease-in-out;
      }
      .menu li a i,
      .menu li summary i {
        margin-right: 0.5rem;
      }

      h1, p, th, td, span, div, body {
      font-family: 'Andika', sans-serif;
      /* letter-spacing: 0.px; */
      }
    
    </style>

    <?php $this->head() ?>
</head>

<body class="font-sans min-h-screen overflow-x-hidden text-base-content
             bg-gradient-to-br from-[oklch(var(--b3))] to-[oklch(var(--n))] 
             transition-colors duration-700 relative">

<?php $this->beginBody() ?>

<!-- Sidebar Overlay (mobile only) -->
<div id="overlay" 
     class="fixed inset-0 bg-black/40 backdrop-blur-sm z-30 hidden opacity-0 md:hidden"></div>

<!-- Sidebar Wrapper -->
<aside id="sidebar"
  class="fixed inset-y-0 left-0 z-50 flex items-center justify-center
         transition-transform duration-300 ease-in-out
         -translate-x-full md:translate-x-0">

  <!--- Sidebar Panel -->
  <div class="relative w-64 h-[80vh] bg-base-100/95 backdrop-blur-xl border border-base-300/70
              rounded-2xl shadow-2xl flex flex-col justify-between overflow-hidden pointer-events-auto">

    <!-- Floating Close Button (only visible on mobile) -->
    <button class="absolute -top-3 -right-3 btn btn-xs btn-circle btn-error text-white shadow-lg md:hidden"
            onclick="toggleSidebar()">
      <i class="fa-solid fa-xmark"></i>
    </button>

    <!-- Sidebar Menu -->
    <nav class="flex-1 overflow-y-auto p-4">
      <ul class="menu menu-md">
        <li>
          <a href="<?= Url::to(['/site/index']) ?>">
            <i class="fa-solid fa-gauge-high w-5 text-base-content/70"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li>
          <details>
            <summary>
              <i class="fa-solid fa-user-gear w-5 text-base-content/"></i>
              <span>Profile</span>
            </summary>
            <ul>
              <li>
                  <a href="<?= Url::to(['/user/view','id' => Yii::$app->user->id]) ?>">
                  <i class="fa-solid fa-id-card w-4 text-base-content/70"></i> My Profile</a></li>
              <li>
                  <a href="<?= Url::to(['/user/update','id' => Yii::$app->user->id]) ?>">
                  <i class="fa-solid fa-user-pen w-4 text-base-content/70"></i> Setting My Profile</a>
              </li>
            </ul>
          </details>
        </li>

        <li>
          <details>
            <summary>
              <i class="fa-solid fa-receipt w-5 text-base-content/"></i>
              <span>Receipt</span>
            </summary>
            <ul>
              <li>
                  <a href="<?= Url::to(['/receipt/create']) ?>">
                  <i class="fa-solid fa-plus w-4 text-base-content/70"></i> My New Receipt</a>
              </li>
              <li>
                  <a href="<?= Url::to(['/receipt/index'])?>">
                  <i class="fa-solid fa-magnifying-glass-dollar w-4 text-base-content/70"></i> Track Receipt</a>
              </li>
            </ul>
          </details>
        </li>

        <li>
          <details>
            <summary>
              <i class="fa-solid fa-tags w-5 text-base-content/"></i>
              <span>Category</span>
            </summary>
            <ul>
              <li>
                  <a href="<?= Url::to(['/category/create']) ?>">
                  <i class="fa-solid fa-folder-tree w-4 text-base-content/70"></i> Set the Category</a>
              </li>
              <li>
                  <a href="<?= Url::to(['/category/index']) ?>">
                  <i class="fa-solid fa-list w-4 text-base-content/70"></i> List of My Category</a>
              </li>
            </ul>
          </details>
        </li>

        <li>
          <details>
            <summary>
              <i class="fa-solid fa-chart-column w-5 text-base-content/"></i>
              <span>Report</span>
            </summary>
            <ul>
              <li>
                  <a href="#">
                  <i class="fa-solid fa-file-export w-4 text-base-content/70"></i> Generate Report</a>
              </li>
              <li>
                  <a href="#">
                  <i class="fa-solid fa-list-check w-4 text-base-content/70"></i> List of My Report</a>
              </li>
            </ul>
          </details>
        </li>
      </ul>
    </nav>


</aside>




<!-- Main Content -->
<div class="flex flex-col md:ml-64 transition-all">

  <!-- Navbar -->
<nav class="fixed top-0 left-0 right-0 bg-base-100 border-b border-base-300 shadow-sm
            backdrop-blur-md px-6 py-3 flex justify-between items-center z-40">
  <div class="flex items-center gap-2">
    <button class="btn btn-sm btn-ghost text-base-content hover:bg-base-200 md:hidden" onclick="toggleSidebar()">
      <i class="fa-solid fa-bars"></i>
    </button>
      <i class="fa-solid fa-cloud"></i>
      <h2 class="text-lg font-semibold text-base-content">
      <?= Html::encode($this->title) ?>
    </h2>
  </div>

  <div class="flex items-center gap-3 text">
    <span class="hidden sm:inline text-base-content/80">
      <strong>Yo!</strong> <span class="text-base-content font-semibold"><?= Html::encode($username) ?></span>
    </span>

<?= Html::beginForm(['site/logout'], 'post', ['class' => 'inline']) ?>
    <?= Html::submitButton(
        '<i class="fa-solid fa-right-from-bracket"></i> Keluar',                
        [
            'class' => 'btn btn-sm bg-red-500/10 text-red-600 border border-red-500/20 hover:bg-red-500 hover:text-white hover:border-transparent transition-all duration-300',
            'title' => 'Logout',
        ]
    ) ?>
<?= Html::endForm() ?>
  </div>
</nav>


  <!-- Page Content -->
  <main class="flex-1 p-6">
    <div class="pt-14 md:pt-14">
      <?php foreach (Yii::$app->session->getAllFlashes() as $type => $message): ?>
          <div class="alert alert-<?= $type ?> alert-dismissible fade show" role="alert">
              <?= Html::encode($message) ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
      <?php endforeach; ?>
        <?= $content ?>
    </div>
  </main>
</div>

<!-- Floating Theme Switcher -->
<div class="fixed bottom-6 left-6 z-50">
  <div class="dropdown dropdown-top dropdown-hover">
    <div tabindex="0" role="button"
         class="flex items-center justify-center w-14 h-14 rounded-full 
                bg-base-100 text-base-content shadow-[8px_8px_16px_rgba(0,0,0,0.15),-8px_-8px_16px_rgba(255,255,255,0.7)]
                transition-all duration-300 ease-in-out cursor-pointer hover:shadow-[4px_4px_10px_rgba(0,0,0,0.1),-4px_-4px_10px_rgba(255,255,255,0.8)]
                hover:scale-105">
          <svg xmlns="http://www.w3.org/2000/svg" 
            class="h-6 w-6" 
            fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M12 3v1m0 16v1m8.485-8.485l.707.707M4.808 4.808l.707.707M21 12h1M2 12H1m16.97 4.243l.707.707M4.808 19.192l.707.707M12 5a7 7 0 107 7h-7z" />
          </svg>
    </div>
    <ul tabindex="0" class="dropdown-content menu p-2 shadow-lg bg-base-100 rounded-box w-44 text-sm text-base-content">
            <li><a onclick="setTheme('cupcake')">🧁 Cupcake</a></li>
            <li><a onclick="setTheme('pastel')">🖌 Pastel</a></li>
            <li><a onclick="setTheme('light')">☀️ Light</a></li>
            <li><a onclick="setTheme('fantasy')">🦄 Fantasy</a></li>
    </ul>
  </div>
</div>

<!-- JS Logic -->
<script>
  const sidebar = document.getElementById("sidebar");
  const overlay = document.getElementById("overlay");

  function toggleSidebar() {
    const isOpen = !sidebar.classList.contains("-translate-x-full");

    if (isOpen) {
      // Close sidebar
      sidebar.classList.add("-translate-x-full");
      overlay.classList.add("opacity-0");
      setTimeout(() => overlay.classList.add("hidden"), 300);
    } else {
      // Open sidebar
      sidebar.classList.remove("-translate-x-full");
      overlay.classList.remove("hidden");
      setTimeout(() => overlay.classList.remove("opacity-0"), 10);
    }
  }

  if (overlay)overlay.addEventListener("click", toggleSidebar);

  function setTheme(theme) {
    document.documentElement.setAttribute("data-theme", theme);
    localStorage.setItem("theme", theme);
  }
</script>

<script>
  // Automatically hide Bootstrap alert after 3 seconds
  setTimeout(() => {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
      // Use Bootstrap's fade class to animate
      alert.classList.remove('show');
      alert.classList.add('fade');
      // Remove from DOM after fade-out animation
      setTimeout(() => alert.remove(), 500);
    });
  }, 3000);
</script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
