<?php

use yii\helpers\Html;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\ReceiptSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Senarai Resit Saya';
$this->params['breadcrumbs'][] = $this->title;
?>

<head>
  <style>
    .table td, .table th {
      padding-top: 0.4rem !important;
      padding-bottom: 0.4rem !important;
    }
    .btn-circle i {
        font-size: 0.8rem !important;
        }
        .btn-circle {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 28px !important;
        width: 28px !important;
        border-radius: 50% !important;
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
</head>

<div class="min-h-screen bg-base-200 text-base-content py-10 px-4">
  <div class="max-w-6xl mx-auto bg-base-100 shadow-xl rounded-2xl border border-base-300 overflow-hidden">

    <!-- Header -->
    <div class="bg-gradient-to-r from-primary to-secondary text-base-100 p-8 flex justify-between items-center">
      <div>
        <h1 class="text-2xl font-bold"><?= Html::encode($this->title) ?></h1>
        <p class="opacity-80 text-sm mt-1">Semak dan urus resit yang telah disimpan</p>
      </div>
      <?= Html::a('<i class="fa-solid fa-circle-plus"></i> Tambah Resit', ['create'], [
          'class' => 'btn btn-sm btn-light bg-white text-primary font-semibold',
      ]) ?>
    </div>

    <!-- Filters and Table -->
    <div class="p-6 overflow-x-auto">

      <p class="mb-4 text-right">
        <?= Html::a('<i class="fa-solid fa-rotate-right"></i> Reset Carian', ['index'], [
            'class' => 'btn btn-sm btn-outline btn-secondary',
        ]) ?>
      </p>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'summary' => false,
            'tableOptions' => ['class' => 'table w-full text-sm border border-base-300 rounded-lg'],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn', 'header' => 'No.'],

                [
                    'attribute' => 'vendor',
                    'label' => 'Vendor / Kedai',
                    'filterInputOptions' => [
                        'class' => 'input input-bordered input-sm w-full',
                        'placeholder' => 'Cari vendor...',
                    ],
                    'value' => fn($model) => Html::encode($model->vendor ?: '-'),
                ],
                [
                    'attribute' => 'spent_at',
                    'label' => 'Tarikh Resit',
                    'filterInputOptions' => [
                        'type' => 'date',
                        'class' => 'input input-bordered input-sm w-full',
                    ],
                    'value' => fn($model) => Yii::$app->formatter->asDate($model->spent_at, 'php:d M Y'),
                ],
                [
                    'attribute' => 'amount',
                    'label' => 'Jumlah (RM)',
                    'format' => ['decimal', 2],
                    'contentOptions' => ['class' => 'text-right font-semibold'],
                    'filterInputOptions' => [
                        'class' => 'input input-bordered input-sm w-full',
                        'placeholder' => 'RM ...',
                    ],
                ],
                [
                    'attribute' => 'category_id',
                    'label' => 'Kategori',
                    'format' => 'raw',
                    'value' => fn($model) =>
                        $model->category
                            ? "<span class='badge badge-outline badge-primary px-3 py-2 text-xs font-semibold whitespace-nowrap'>"
                                . Html::encode($model->category->name)
                            . "</span>"
                            : "<span class='badge badge-outline badge-neutral px-3 py-2 text-xs font-semibold whitespace-nowrap'>Tiada</span>",
                    'filter' => \yii\helpers\ArrayHelper::map(
                        \app\models\Category::find()->orderBy('name')->all(),
                        'id',
                        'name'
                    ),
                    'filterInputOptions' => [
                        'class' => 'select select-bordered select-sm w-full',
                        'prompt' => 'Semua Kategori',
                    ],
                ],
                [
                    'attribute' => 'status',
                    'label' => 'Status',
                    'format' => 'raw',
                    'value' => function ($model) {
                        $color = match (strtolower($model->status)) {
                            'saved' => 'badge-success',
                            'draft' => 'badge-warning',
                            'pending' => 'badge-info',
                            'deleted' => 'badge-error',
                            default => 'badge-neutral',
                        };
                        return "<span class='badge {$color} px-3 py-2 text-xs font-semibold uppercase whitespace-nowrap'>"
                            . Html::encode($model->status ?: 'N/A')
                            . "</span>";
                    },
                    'filter' => [
                        'Saved' => 'Saved',
                        'Draft' => 'Draft',
                        'Pending' => 'Pending',
                        'Deleted' => 'Deleted',
                    ],
                    'filterInputOptions' => ['class' => 'select select-bordered select-sm w-full'],
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
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
                            ['title' => 'Lihat Resit']
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
                                'title' => 'Padam Resit',
                                'data' => [
                                    'confirm' => 'Padam resit ini?',
                                    'method' => 'post',
                                ],
                            ]
                        ),
                    ],
                ],
            ],
        ]) ?>

    </div>
  </div>
</div>

<script>
document.querySelectorAll('.btn[title]').forEach(btn => {
  btn.setAttribute('data-tip', btn.getAttribute('title'));
  btn.removeAttribute('title');
  btn.classList.add('tooltip', 'tooltip-top');
});
</script>
