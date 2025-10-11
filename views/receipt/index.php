<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Receipts';
?>
<div class="flex justify-between mb-4">
  <h1 class="text-2xl font-bold"><?= Html::encode($this->title) ?></h1>
  <a class="btn btn-primary" href="<?= Url::to(['create']) ?>">Add Receipt</a>
</div>

<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
<?php foreach($receipts as $r): ?>
  <div class="card bg-base-100 shadow">
    <div class="card-body">
      <div class="flex items-center gap-3">
        <?php if ($r->cloud_url): ?>
          <img src="<?= htmlspecialchars($r->cloud_url) ?>" class="w-20 h-20 object-cover rounded">
        <?php else: ?>
          <div class="w-20 h-20 bg-base-300 rounded grid place-content-center">No Image</div>
        <?php endif; ?>
        <div>
          <div class="font-semibold">RM <?= number_format($r->amount,2) ?></div>
          <div class="text-sm opacity-70"><?= htmlspecialchars($r->spent_at) ?> • <?= htmlspecialchars($r->vendor ?? 'Unknown') ?></div>
          <div class="text-xs opacity-60"><?= $r->category ? htmlspecialchars($r->category->name) : 'No category' ?></div>
        </div>
      </div>
      <div class="card-actions justify-end">
        <a class="btn btn-ghost" href="<?= Url::to(['view','id'=>$r->id]) ?>">View</a>
        <a class="btn btn-ghost" href="<?= Url::to(['update','id'=>$r->id]) ?>">Edit</a>
        <a class="btn btn-error" data-confirm="Delete?" href="<?= Url::to(['delete','id'=>$r->id]) ?>">Delete</a>
      </div>
    </div>
  </div>
<?php endforeach; ?>
</div>
