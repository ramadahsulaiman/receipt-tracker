<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Receipt $model */

$this->title = 'Resit: ' . Html::encode($model->category->name);
$this->params['breadcrumbs'][] = ['label' => 'Resit', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="receipt-view p-6 bg-base-100 rounded-2xl shadow-lg">
    <!-- 🔹 Header -->
    <div class="flex flex-col md:flex-row justify-between md:items-center mb-6 border-b border-base-300 pb-4">
        <div class="mb-3 md:mb-0">
            <h1 class="text-2xl font-bold text-base-content">
                <i class="fa-solid fa-receipt text-primary"></i>
                <?= Html::encode($this->title) ?>
            </h1>
            <p class="text-sm text-base-content/70 mt-1">
                Lihat butiran penuh bagi resit ini termasuk fail yang dimuat naik dan senarai item.
            </p>

            <?php if (!empty($model->updated_at)): ?>
                <p class="text-xs text-base-content/50 mt-1">
                    <i class="fa-regular fa-clock text-primary"></i>
                    Dikemaskini kali terakhir pada:
                    <?= Yii::$app->formatter->asDatetime($model->updated_at, 'php:d M Y, h:i A') ?>
                </p>
            <?php endif; ?>
        </div>

        <div class="flex gap-2">
            <?= Html::a('<i class="fa-solid fa-pen-to-square"></i> Kemaskini', 
                ['update', 'id' => $model->id], 
                ['class' => 'btn btn-sm btn-primary text-white']) ?>

            <?= Html::a('<i class="fa-solid fa-trash"></i> Padam', 
                ['delete', 'id' => $model->id], 
                [
                    'class' => 'btn btn-sm btn-outline btn-error',
                    'data' => [
                        'confirm' => 'Adakah anda pasti mahu memadam resit ini?',
                        'method' => 'post',
                    ],
                ]) ?>

            <a href="<?= Yii::$app->urlManager->createUrl(['receipt/index']) ?>" 
               class="btn btn-outline btn-neutral">
                <i class="fa-solid fa-list"></i> Senarai Resit
            </a>
        </div>
    </div>

    <!-- 🔹 Fail Resit Section -->
    <div class="mb-8">
        <h2 class="text-lg font-semibold text-base-content/80 mb-3">
            <i class="fa-solid fa-cloud-arrow-down text-primary"></i> Fail Resit
        </h2>

        <?php if ($model->cloud_url): ?>
            <?php if (strpos($model->cloud_url, '.pdf') !== false): ?>
                <div class="p-5 border border-base-300 rounded-xl bg-base-200/70 text-center">
                    <i class="fa-solid fa-file-pdf text-5xl text-error"></i>
                    <p class="mt-2 text-sm text-base-content/70">Fail PDF dimuat naik</p>
                    <a href="<?= Html::encode($model->cloud_url) ?>" target="_blank" class="btn btn-sm btn-outline btn-primary mt-3">
                        <i class="fa-solid fa-eye"></i> Lihat PDF
                    </a>
                </div>
            <?php else: ?>
                <div class="p-5 border border-base-300 rounded-xl bg-base-200/70 text-center">
                    <img src="<?= Html::encode($model->cloud_url) ?>" class="max-h-80 rounded-lg shadow-md mx-auto" alt="Receipt Image">
                </div>
            <?php endif; ?>
        <?php else: ?>
            <div class="p-6 border-2 border-dashed border-base-300 rounded-xl text-base-content/60 text-center">
                <i class="fa-solid fa-file-circle-xmark text-5xl mb-2"></i>
                <p>Tiada fail resit dimuat naik.</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- 🔹 Maklumat Resit Section -->
    <div class="mb-8">
        <h2 class="text-lg font-semibold text-base-content mb-3">
            <i class="fa-solid fa-circle-info text-secondary"></i> Maklumat Resit
        </h2>

        <div class="overflow-hidden rounded-xl border border-base-300">
            <table class="w-full text-base-content border-collapse text-sm">
                <tbody class="divide-y divide-base-300">
                    <tr>
                        <td class="w-[30%] bg-base-200 font-semibold text-base-content px-4 py-2 border-r border-base-300">
                            Tarikh Resit
                        </td>
                        <td class="px-4 py-2"><?= Yii::$app->formatter->asDate($model->spent_at, 'php:d M Y') ?></td>
                    </tr>
                    <tr>
                        <td class="bg-base-200 font-semibold text-base-content px-4 py-2 border-r border-base-300">Kategori</td>
                        <td class="px-4 py-2"><?= Html::encode($model->category ? $model->category->name : '-') ?></td>
                    </tr>
                    <tr>
                        <td class="bg-base-200 font-semibold text-base-content px-4 py-2 border-r border-base-300">Vendor / Kedai</td>
                        <td class="px-4 py-2"><?= Html::encode($model->vendor) ?></td>
                    </tr>
                    <tr>
                        <td class="bg-base-200 font-semibold text-base-content px-4 py-2 border-r border-base-300">Catatan</td>
                        <td class="px-4 py-2"><?= Html::encode($model->notes) ?></td>
                    </tr>
                    <tr>
                        <td class="bg-base-200 font-semibold text-base-content px-4 py-2 border-r border-base-300">Jumlah (RM)</td>
                        <td class="px-4 py-2 font-bold text-success"><?= Yii::$app->formatter->asDecimal($model->amount, 2) ?></td>
                    </tr>
                    <tr>
                        <td class="bg-base-200 font-semibold text-base-content px-4 py-2 border-r border-base-300">Status</td>
                        <td class="px-4 py-2">
                            <?php
                            $color = match($model->status) {
                                'Saved' => 'badge-primary',
                                'Draft' => 'badge-warning',
                                default => 'badge-neutral'
                            };
                            ?>
                            <span class="badge <?= $color ?> badge-md"><?= Html::encode($model->status) ?></span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- 🔹 Senarai Item Section -->
    <?php if ($model->items): ?>
        <div>
            <h2 class="text-lg font-semibold text-base-content mb-3">
                <i class="fa-solid fa-cart-shopping text-success"></i> Senarai Item
            </h2>
            <div class="overflow-x-auto">
                <table class="w-full border border-base-300 rounded-lg text-base-content text-sm">
                    <thead>
                        <tr class="bg-base-200 font-semibold text-base">
                            <th class="w-1/2 text-base font-semibold text-base-content px-3 py-2">Item</th>
                            <th class="w-1/4 text-base font-semibold text-base-content px-3 py-2">Jumlah (RM)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($model->items as $item): ?>
                            <tr>
                                <td class="px-4 py-2"><?= Html::encode($item->name) ?></td>
                                <td class="px-4 py-2"><?= Yii::$app->formatter->asDecimal($item->amount, 2) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr class="bg-base-300 font-bold text-base-content text-lg">
                            <td class="w-1/2 text-right px-4 py-2">Jumlah Keseluruhan:</td>
                            <td class="w-1/4 px-4 py-2 text-bold">RM <?= Yii::$app->formatter->asDecimal($model->amount, 2) ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    <?php endif; ?>
</div>
