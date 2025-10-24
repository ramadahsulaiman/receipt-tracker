<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Category $model */

$this->title = 'Kategori: ' . Html::encode($model->name);
$this->params['breadcrumbs'][] = ['label' => 'Senarai Kategori', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
.category-view table td, .category-view table th {
    padding-top: 0.5rem !important;
    padding-bottom: 0.5rem !important;
}
.badge i {
    font-size: 0.75rem !important;
    vertical-align: middle;
}
.badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 4px;
    min-width: 70px;
}
@media (max-width: 768px) {
    .table td, .table th {
        font-size: 13px !important;
    }
    .badge {
        padding: 0.25rem 0.4rem !important;
        font-size: 11px !important;
    }
}
</style>

<div class="category-view p-6 bg-base-100 rounded-2xl shadow-lg">

    <!-- 🔹 Header -->
    <div class="flex flex-col md:flex-row justify-between md:items-center mb-6 border-b border-base-300 pb-4">
        <div class="mb-3 md:mb-0">
            <h1 class="text-2xl font-bold text-base-content">
                <i class="fa-solid fa-tags text-primary"></i>
                <?= Html::encode($this->title) ?>
            </h1>
            <p class="text-sm text-base-content/70 mt-1">
                Lihat butiran penuh bagi kategori ini termasuk status tuntutan cukai dan maklumat potongan maksimum.
            </p>

            <?php if (!empty($model->updated_at)): ?>
                <p class="text-xs text-base-content/50 mt-1">
                    <i class="fa-regular fa-clock text-primary"></i>
                    Dikemaskini kali terakhir pada:
                    <?= Yii::$app->formatter->asDatetime($model->updated_at, 'php:d M Y, h:i A') ?>
                </p>
            <?php endif; ?>
        </div>
    </div>

    <!-- 🔹 Maklumat Kategori -->
    <div class="mb-8">
        <h2 class="text-lg font-semibold text-base-content mb-3">
            <i class="fa-solid fa-circle-info text-secondary"></i> Maklumat Kategori
        </h2>

        <div class="overflow-hidden rounded-xl border border-base-300">
            <table class="w-full text-base-content border-collapse text-sm">
                <tbody class="divide-y divide-base-300">

                    <tr>
                        <td class="w-[30%] bg-base-200 font-semibold text-base-content px-4 py-2 border-r border-base-300">
                            Nama Kategori
                        </td>
                        <td class="px-4 py-2"><?= Html::encode($model->name ?: '-') ?></td>
                    </tr>

                    <tr>
                        <td class="bg-base-200 font-semibold text-base-content px-4 py-2 border-r border-base-300">
                            Boleh Tuntut Cukai
                        </td>
                        <td class="px-4 py-2">
                            <?php
                            $badge = $model->is_tax_claimable
                                ? "<span class='badge badge-success px-3 py-2 text-xs font-semibold uppercase flex justify-center items-center'>YA</span>"
                                : "<span class='badge badge-warning px-3 py-2 text-xs font-semibold uppercase flex justify-center items-center'>TIDAK</span>";
                            echo $badge;
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td class="bg-base-200 font-semibold text-base-content px-4 py-2 border-r border-base-300">
                            Jumlah Maksimum Potongan (RM)
                        </td>
                        <td class="px-4 py-2 font-semibold text-success">
                            <?= $model->max_deduction ? 'RM ' . number_format($model->max_deduction, 2) : '-' ?>
                        </td>
                    </tr>

                    <tr>
                        <td class="bg-base-200 font-semibold text-base-content px-4 py-2 border-r border-base-300">
                            Penerangan
                        </td>
                        <td class="px-4 py-2 text-base-content/80">
                            <?= nl2br(Html::encode($model->description ?: '-')) ?>
                        </td>
                    </tr>

                    <tr>
                        <td class="bg-base-200 font-semibold text-base-content px-4 py-2 border-r border-base-300">
                            Dicipta Pada
                        </td>
                        <td class="px-4 py-2">
                            <?= Yii::$app->formatter->asDatetime($model->created_at, 'php:d M Y, h:i A') ?>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>

    <!-- 🔹 Buttons Section -->
    <div class="flex justify-center gap-3 py-6">
        <?= Html::a('<i class="fa-solid fa-pen-to-square"></i> Kemaskini',
            ['update', 'id' => $model->id],
            [
                'class' => 'flex items-center justify-center gap-2 bg-blue-200 text-blue-800 hover:bg-blue-300 border-none px-3 h-9 rounded-lg font-semibold text-sm tracking-wide transition-all duration-300 shadow-sm hover:shadow-md',
            ]) ?>

        <?= Html::a('<i class="fa-solid fa-trash"></i> Padam',
            ['delete', 'id' => $model->id],
            [
                'class' => 'flex items-center justify-center gap-2 bg-red-200 text-red-800 hover:bg-red-300 border-none px-3 h-9 rounded-lg font-semibold text-sm tracking-wide transition-all duration-300 shadow-sm hover:shadow-md',
                'data' => [
                    'confirm' => 'Adakah anda pasti mahu memadam kategori ini?',
                    'method' => 'post',
                ],
            ]) ?>

        <a href="<?= Yii::$app->urlManager->createUrl(['category/index']) ?>"
            class="flex items-center justify-center gap-2 bg-yellow-200 text-black hover:bg-yellow-300 border-none px-3 h-9 rounded-lg font-semibold text-sm tracking-wide transition-all duration-300 shadow-sm hover:shadow-md">
            <i class="fa-solid fa-list"></i> Senarai Kategori
        </a>
    </div>
</div>
