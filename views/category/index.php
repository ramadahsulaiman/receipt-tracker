<?php
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = 'Categories';
?>
<div class="flex justify-between items-center mb-4">
  <h1 class="text-2xl font-bold"><?= Html::encode($this->title) ?></h1>
  <a class="btn btn-primary" href="<?= Url::to(['create']) ?>">New Category</a>
</div>

<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
<?php foreach($categories as $c): ?>
  <div class="card bg-base-100 shadow">
    <div class="card-body">
      <h2 class="card-title"><?= Html::encode($c->name) ?></h2>
      <p class="text-sm opacity-70">
        Tax-claimable: <?= $c->is_tax_claimable ? 'Yes' : 'No' ?>
        <?= $c->tax_code ? " • Code: ".Html::encode($c->tax_code) : '' ?>
      </p>
      <div class="card-actions justify-end">
        <a class="btn btn-ghost" href="<?= Url::to(['update','id'=>$c->id]) ?>">Edit</a>
        <a class="btn btn-error" data-confirm="Delete?" href="<?= Url::to(['delete','id'=>$c->id]) ?>">Delete</a>
      </div>
    </div>
  </div>
<?php endforeach; ?>
</div>
