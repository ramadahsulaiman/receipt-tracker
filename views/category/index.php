<?php

use app\models\Category;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\CategorySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Senarai Kategori';
$this->params['breadcrumbs'][] = $this->title;
?>
<head>
    <!-- Tailwind + DaisyUI -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="<?= Yii::getAlias('@web/css/output.css') ?>">
</head>

<div class="category-index space-y-9 p-2 bg-base-100 rounded-2xl shadow-lg">

    <!-- Header Section -->
    <div class="bg-gradient-to-r from-neutral to-info text-base-100 p-4 flex justify-between items-center rounded-t-2xl">
        <div>
            <h1 class="text-2xl font-bold"><?= Html::encode($this->title) ?></h1>
            <p class="opacity-80 text-sm mt-1">Semak dan urus kategori resit anda</p>
        </div>
        <?= Html::a('<i class="fa-solid fa-circle-plus"></i> Tambah Kategori', ['create'], [
            'class' => 'btn btn-sm bg-white text-primary font-semibold',
        ]) ?>
    </div>

    <!-- Table Section -->
    <div class="p-2 bg-white rounded-2xl overflow-x-auto">
        <div class="bg-base-100 rounded-2xl shadow-lg border border-base-200">

            <p class="mb-3 text-right">
                <?= Html::a('<i class="fa-solid fa-rotate-right"></i> Reset Carian', ['index'], [
                    'class' => 'btn btn-sm btn-outline btn-secondary text-white font-semibold',
                ]) ?>
            </p>

            <div class="overflow-x-auto">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'tableOptions' => ['class' => 'table w-full text-sm text-base-content'],
                    'summaryOptions' => ['class' => 'px-4 py-2 text-xs text-base-content/60'],

                    'columns' => [
                        [
                            'class' => 'yii\grid\SerialColumn',
                            'headerOptions' => ['class' => 'bg-base-200 text-base-content/70 uppercase text-xs text-center'],
                            'contentOptions' => ['class' => 'font-semibold text-center'],
                        ],
                        [
                            'attribute' => 'name',
                            'filterInputOptions' => [
                                'class' => 'input input-bordered input-sm w-full',
                            ],
                            'value' => fn($model) => Html::encode($model->name ?: '-'),
                        ],
                        [
                            'attribute' => 'is_tax_claimable',
                            'format' => 'raw',
                            'filter' => [
                                1 => 'Ya',
                                0 => 'Tidak',
                            ],
                            'filterInputOptions' => [
                                'class' => 'select select-bordered select-sm w-full',
                            ],
                            'value' => function ($model) {
                                if ($model->is_tax_claimable === null) {
                                    return "<span class='badge badge-neutral px-3 py-2 text-xs font-semibold uppercase flex justify-center item-center'>N/A</span>";
                                }
                                return $model->is_tax_claimable
                                    ? "<span class='badge badge-success px-3 py-2 text-xs font-semibold uppercase flex justify-center item-center'>YA</span>"
                                    : "<span class='badge badge-warning px-3 py-2 text-xs font-semibold uppercase flex justify-center item-center'>TIDAK</span>";
                            },
                            'contentOptions' => ['class' => 'text-center align-middle'],
                        ],
                        [
                            'attribute' => 'max_deduction',
                            'filterInputOptions' => [
                                'class' => 'input input-bordered input-sm w-full',
                            ],
                            'format' => 'raw',
                            'value' => fn($model) => $model->max_deduction
                                ? 'RM ' . number_format($model->max_deduction, 2)
                                : '-',
                            'contentOptions' => ['class' => 'text-center'],
                        ],
                        [
                            'attribute' => 'created_at',
                            'filterInputOptions' => [
                                'class' => 'input input-bordered input-sm w-full',
                            ],
                            'format' => ['date', 'php:d M Y'],
                            'contentOptions' => ['class' => 'text-center text-xs text-base-content/70'],
                        ],
                        [
                            'class' => ActionColumn::class,
                            'header' => 'Tindakan',
                            'headerOptions' => ['class' => 'text-center w-36'],
                            'contentOptions' => ['class' => 'text-center align-middle'],
                            'template' => '<div class="flex justify-center gap-1 flex-wrap">{view} {update} {delete}</div>',
                            'buttons' => [
                                'view' => fn($url) => Html::a(
                                    '<span class="badge bg-blue-100 text-blue-700 hover:bg-blue-500 hover:text-white transition-all duration-300">
                                        <i class="fa-solid fa-eye"></i>
                                    </span>',
                                    $url,
                                    ['title' => 'Lihat Kategori']
                                ),
                                'update' => fn($url) => Html::a(
                                    '<span class="badge bg-pink-100 text-pink-700 hover:bg-pink-500 hover:text-white transition-all duration-300">
                                        <i class="fa-solid fa-pen"></i>
                                    </span>',
                                    $url,
                                    ['title' => 'Kemaskini']
                                ),
                                'delete' => fn($url) => Html::a(
                                    '<span class="badge bg-red-100 text-red-600 hover:bg-red-500 hover:text-white transition-all duration-300">
                                        <i class="fa-solid fa-trash"></i>
                                    </span>',
                                    $url,
                                    [
                                        'title' => 'Padam Kategori',
                                        'data' => [
                                            'confirm' => 'Padam kategori ini?',
                                            'method' => 'post',
                                        ],
                                    ]
                                ),
                            ],
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>
