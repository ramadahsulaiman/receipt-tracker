<?php
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Receipt $model */

$this->title = 'Resit #' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Resit', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="min-h-screen bg-base-200 text-base-content py-10 px-4">
  <div class="max-w-5xl mx-auto bg-base-100 shadow-xl rounded-2xl border border-base-300 overflow-hidden">

    <!-- Header -->
    <div class="bg-gradient-to-r from-primary to-secondary text-base-100 p-8 text-center relative">
      <h1 class="text-2xl font-bold"><?= Html::encode($this->title) ?></h1>
      <p class="text-sm opacity-80 mt-2">
        <?= Html::encode($model->spent_at) ?> • <?= Html::encode($model->currency) ?>
      </p>

      <div class="absolute top-6 right-6 flex gap-2">
        <?= Html::a('<i class="fa-solid fa-pen-to-square"></i>', ['update', 'id' => $model->id], [
            'class' => 'btn btn-sm btn-outline btn-light',
            'title' => 'Edit Resit',
        ]) ?>
        <?= Html::a('<i class="fa-solid fa-trash"></i>', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-sm btn-error text-white',
            'data' => [
                'confirm' => 'Padam resit ini?',
                'method' => 'post',
            ],
        ]) ?>
      </div>
    </div>

    <!-- Body -->
    <div class="p-8 space-y-8">

      <!-- File Preview -->
      <?php if ($model->cloud_url): ?>
      <div class="text-center">
        <h2 class="text-lg font-semibold text-base-content/80 mb-3">Resit Dimuat Naik</h2>
        <?php if (str_contains($model->cloud_url, '.pdf')): ?>
          <div class="text-error text-sm">
            <i class="fa-solid fa-file-pdf text-4xl"></i>
            <p class="mt-2">Fail PDF dimuat naik</p>
            <?= Html::a('Buka PDF', $model->cloud_url, ['class' => 'btn btn-outline btn-sm mt-3', 'target' => '_blank']) ?>
          </div>
        <?php else: ?>
          <img src="<?= Html::encode($model->cloud_url) ?>" alt="Receipt Image" class="rounded-xl shadow-md max-h-96 mx-auto">
        <?php endif; ?>
      </div>
      <?php endif; ?>

      <!-- Info Table -->
      <div class="overflow-x-auto">
        <table class="table w-full border border-base-300 rounded-lg text-sm">
          <tbody>
            <tr><th>Kategori</th><td><?= Html::encode($model->category?->name ?? '-') ?></td></tr>
            <tr><th>Tarikh</th><td><?= Html::encode($model->spent_at) ?></td></tr>
            <tr><th>Vendor</th><td><?= Html::encode($model->vendor ?? '-') ?></td></tr>
            <tr><th>Catatan</th><td><?= Html::encode($model->notes ?? '-') ?></td></tr>
            <tr><th>Status</th><td><?= Html::encode($model->status ?? 'Saved') ?></td></tr>
          </tbody>
        </table>
      </div>

      <!-- Items -->
      <div>
        <h2 class="text-lg font-semibold mb-4 text-base-content/80">
          <i class="fa-solid fa-cart-shopping text-primary"></i> Item dalam Resit
        </h2>
        <div class="overflow-x-auto">
          <table class="table w-full border border-base-300 rounded-lg text-sm">
            <thead>
              <tr class="bg-base-200">
                <th>Item</th>
                <th class="text-right">Jumlah (RM)</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $total = 0;
              foreach ($model->items as $item): 
                  $total += $item->amount;
              ?>
              <tr>
                <td><?= Html::encode($item->name) ?></td>
                <td class="text-right"><?= number_format($item->amount, 2) ?></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
            <tfoot>
              <tr class="bg-base-200 font-bold">
                <td>Jumlah Keseluruhan</td>
                <td class="text-right text-primary"><?= number_format($total, 2) ?> RM</td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
