<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Receipt $model */

$this->title = 'Resit #' . Html::encode($model->id);
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
               class="btn btn-sm btn-outline btn-neutral">
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
        <h2 class="text-lg font-semibold text-base-content/80 mb-3">
            <i class="fa-solid fa-circle-info text-secondary"></i> Maklumat Resit
        </h2>
        <?= DetailView::widget([
            'model' => $model,
            'options' => ['class' => 'table table-zebra w-full text-sm rounded-xl'],
            'attributes' => [
                [
                    'label' => 'Tarikh Resit',
                    'value' => Yii::$app->formatter->asDate($model->spent_at, 'php:d M Y'),
                ],
                [
                    'label' => 'Kategori',
                    'value' => $model->category ? $model->category->name : '-',
                ],
                [
                    'label' => 'Vendor / Kedai',
                    'value' => $model->vendor,
                ],
                [
                    'label' => 'Catatan',
                    'value' => $model->notes,
                ],
                [
                    'label' => 'Jumlah (RM)',
                    'value' => Yii::$app->formatter->asDecimal($model->amount, 2),
                ],
                [
                    'label' => 'Status',
                    'format' => 'raw',
                    'value' => function($model) {
                        $color = match($model->status) {
                            'Saved' => 'badge-primary',
                            'Draft' => 'badge-warning',
                            default => 'badge-neutral'
                        };
                        return "<span class='badge $color badge-lg text-white'>" . Html::encode($model->status) . "</span>";
                    },
                ],
            ],
        ]) ?>
    </div>

    <!-- 🔹 Item List Section -->
    <?php if ($model->items): ?>
        <div>
            <h2 class="text-lg font-semibold text-base-content/80 mb-3">
                <i class="fa-solid fa-cart-shopping text-success"></i> Senarai Item
            </h2>
            <div class="overflow-x-auto">
                <table class="table w-full border border-base-300 rounded-lg text-sm">
                    <thead>
                        <tr class="bg-base-200">
                            <th>Item</th>
                            <th>Jumlah (RM)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($model->items as $item): ?>
                            <tr>
                                <td><?= Html::encode($item->name) ?></td>
                                <td><?= Yii::$app->formatter->asDecimal($item->amount, 2) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr class="bg-base-300 font-semibold">
                            <td class="text-right">Jumlah Keseluruhan:</td>
                            <td><?= Yii::$app->formatter->asDecimal($model->amount, 2) ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    <?php endif; ?>
</div>
