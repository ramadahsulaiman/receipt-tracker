<?php
use yii\helpers\Html;
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" data-theme="cupcake">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= Html::encode($this->title) ?></title>

    <!-- TailwindCSS + DaisyUI via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css"
        rel="stylesheet"
        type="text/css"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


    <?php $this->head() ?>
</head>

<body class="min-h-screen overflow-x-hidden bg-gradient-to-b from-[#0f172a] via-[#111827] to-[#0b1020] text-base-content">
<?php $this->beginBody() ?>

    <?= $content ?>

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
          <li><a onclick="setTheme('cupcake')">🧁 Cupcake</a></li>
          <li><a onclick="setTheme('dracula')">🦇 Dracula</a></li>
          <li><a onclick="setTheme('valentine')">💖 Valentine</a></li>
          <li><a onclick="setTheme('lofi')">🎵 Lofi</a></li>
          <li><a onclick="setTheme('pastel')">🖌 Pastel</a></li>

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


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
