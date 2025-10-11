<?php
use yii\helpers\Html;

$this->title = 'Receipt #'.$model->id;
?>
<div class="grid md:grid-cols-2 gap-6">
  <div class="card bg-base-100 shadow">
    <div class="card-body">
      <h2 class="card-title">Details</h2>
      <div>Amount: <strong>RM <?= number_format($model->amount,2) ?></strong></div>
      <div>Date: <strong><?= htmlspecialchars($model->spent_at) ?></strong></div>
      <div>Vendor: <strong><?= htmlspecialchars($model->vendor ?? '-') ?></strong></div>
      <div>Category: <strong><?= $model->category? htmlspecialchars($model->category->name):'-' ?></strong></div>
      <div>Notes: <pre class="whitespace-pre-wrap"><?= htmlspecialchars($model->notes ?? '-') ?></pre></div>
    </div>
  </div>
  <div class="card bg-base-100 shadow">
    <div class="card-body">
      <h2 class="card-title">Image</h2>
      <?php if ($model->cloud_url): ?>
        <img src="<?= htmlspecialchars($model->cloud_url) ?>" class="rounded-lg">
      <?php else: ?>
        <div class="p-10 text-center opacity-60">No image</div>
      <?php endif; ?>
    </div>
  </div>
</div>
