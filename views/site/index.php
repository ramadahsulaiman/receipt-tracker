<?php
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var int $totalReceipt */
/** @var int $totalReport */
/** @var int $totalCategory */
/** @var array $taxReliefs */

$this->title = 'Receipt Tracker by Ramadah S.';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
// Register Google Font properly (Yii2 way)
$this->registerCssFile('https://fonts.googleapis.com/css2?family=Andika:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet', [
    'rel' => 'stylesheet',
    'crossorigin' => 'anonymous',
]);
?>

<style>
    h1, p, th, td, span, div, body {
    font-family: 'Andika', sans-serif;
    /* letter-spacing: 0.px; */
    }
</style>


<!-- Main Container -->
<div class="pt-5 pb-16 px-6 min-h-screen bg-gradient-to-br from-slate-50 via-slate-100 to-slate-200 
             dark:from-black-900 dark:via-black-950 dark:to-black-800 transition-all duration-700 rounded-lg">

    <!-- Header -->
    <div class="text-center mb-12 animate-fade-in">
        <h1 class="text-4xl sm:text-5xl font-extrabold text-black-800 dark:text-white tracking-tight drop-shadow-sm">
            🧾 Receipt Tracker Summary
        </h1>
        <p class="text-gray-500 dark:text-gray-400 mt-3 text-base sm:text-lg">
            Keep track of your receipts, reports, and tax relief insights — all in one glance.
        </p>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-8 mb-16">

        <!-- Total Receipts -->
        <div class="group relative p-8 rounded-2xl bg-gradient-to-br from-blue-50 to-blue-100 
                    dark:from-blue-900/30 dark:to-blue-800/10 
                    shadow-lg hover:shadow-2xl hover:-translate-y-2 
                    transition-all duration-500 backdrop-blur">
            <div class="absolute top-4 right-4 opacity-20 group-hover:opacity-40 transition-opacity">
                <i class="fa-solid fa-receipt text-6xl text-blue-500"></i>
            </div>
            <h2 class="text-gray-700 dark:text-gray-300 text-sm font-semibold uppercase tracking-wide">Total Receipts</h2>
            <p class="text-5xl font-extrabold text-blue-600 dark:text-blue-400 mt-3">
                <?= Html::encode($totalReceipt) ?>
            </p>
        </div>

        <!-- Reports Generated -->
        <div class="group relative p-8 rounded-2xl bg-gradient-to-br from-green-50 to-green-100 
                    dark:from-green-900/30 dark:to-green-800/10 
                    shadow-lg hover:shadow-2xl hover:-translate-y-2 
                    transition-all duration-500 backdrop-blur">
            <div class="absolute top-4 right-4 opacity-20 group-hover:opacity-40 transition-opacity">
                <i class="fa-solid fa-chart-pie text-6xl text-green-500"></i>
            </div>
            <h2 class="text-gray-700 dark:text-gray-300 text-sm font-semibold uppercase tracking-wide">Reports Generated</h2>
            <p class="text-5xl font-extrabold text-green-600 dark:text-green-400 mt-3">
                <?= Html::encode($totalReport) ?>
            </p>
        </div>

        <!-- Total Categories -->
        <div class="group relative p-8 rounded-2xl bg-gradient-to-br from-yellow-50 to-yellow-100 
                    dark:from-yellow-900/30 dark:to-yellow-800/10 
                    shadow-lg hover:shadow-2xl hover:-translate-y-2 
                    transition-all duration-500 backdrop-blur">
            <div class="absolute top-4 right-4 opacity-20 group-hover:opacity-40 transition-opacity">
                <i class="fa-solid fa-layer-group text-6xl text-yellow-500"></i>
            </div>
            <h2 class="text-gray-700 dark:text-gray-300 text-sm font-semibold uppercase tracking-wide">Total Categories</h2>
            <p class="text-5xl font-extrabold text-yellow-600 dark:text-yellow-400 mt-3">
                <?= Html::encode($totalCategory) ?>
            </p>
        </div>
    </div>

    <!-- Tax Relief Table -->
    <div class="max-w-5xl mx-auto bg-white/90 dark:bg-gray-900/40 
                rounded-2xl shadow-xl backdrop-blur-xl 
                border border-gray-200/40 dark:border-gray-700/40 p-10 
                hover:shadow-2xl hover:-translate-y-1 transition-all duration-500">
        <div class="flex items-center justify-center mb-8">
            <span class="text-2xl font-bold text-gray-800 dark:text-white">
                💰 Core Tax Relief (LHDN Malaysia)
            </span>
        </div>

        <div class="overflow-x-auto animate-fade-in-up">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-100/80 dark:bg-gray-800/50 border-b border-gray-200 dark:border-gray-700">
                        <th class="px-5 py-3 font-semibold text-gray-700 dark:text-gray-300">
                            <i class="fa-solid fa-folder-open"></i>
                            Kategori
                        </th>
                        <th class="px-5 py-3 font-semibold text-right text-gray-700 dark:text-gray-300">
                            <i class="fa-solid fa-dollar-sign"></i>
                            Jumlah (RM)
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($taxReliefs as $name => $amount): ?>
                        <tr class="border-b border-gray-200/70 dark:border-gray-700/40 hover:bg-gray-50/70 dark:hover:bg-gray-800/50 transition-all duration-200">
                            <td class="px-5 py-3 text-gray-700 dark:text-gray-300"><?= Html::encode($name) ?></td>
                            <td class="px-5 py-3 text-right font-semibold text-gray-800 dark:text-gray-200">
                                <?= number_format($amount, 0) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- Small animations -->
<style>
@keyframes fade-in {
  from {opacity: 0; transform: translateY(10px);}
  to {opacity: 1; transform: translateY(0);}
}
.animate-fade-in {
  animation: fade-in 0.8s ease-in-out;
}
.animate-fade-in-up {
  animation: fade-in 1.2s ease-in-out;
}
</style>
