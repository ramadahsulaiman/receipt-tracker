<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Reports (Daily & Tax Claimable)';
?>
<div class="card bg-base-100 shadow mb-4">
  <div class="card-body">
    <h1 class="card-title"><?= Html::encode($this->title) ?></h1>
    <form method="get" class="grid md:grid-cols-4 gap-4">
      <label class="form-control">
        <div class="label"><span class="label-text">From</span></div>
        <input type="date" name="from" value="<?= Html::encode($from) ?>" class="input input-bordered w-full">
      </label>
      <label class="form-control">
        <div class="label"><span class="label-text">To</span></div>
        <input type="date" name="to" value="<?= Html::encode($to) ?>" class="input input-bordered w-full">
      </label>
      <div class="flex items-end">
        <button class="btn btn-primary">Filter</button>
      </div>
    </form>
  </div>
</div>

<div class="card bg-base-100 shadow">
  <div class="card-body">
    <h2 class="card-title">Daily Spending</h2>
    <div class="overflow-x-auto">
      <table class="table">
        <thead><tr><th>Date</th><th>Total (RM)</th></tr></thead>
        <tbody>
          <?php $grand=0; foreach($byDay as $d=>$sum): $grand+=$sum; ?>
            <tr>
              <td><?= Html::encode($d) ?></td>
              <td><?= number_format($sum,2) ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
        <tfoot>
          <tr class="font-bold">
            <td>Total</td>
            <td><?= number_format($grand,2) ?></td>
          </tr>
        </tfoot>
      </table>
    </div>

    <div class="divider"></div>
    <h2 class="card-title">Tax-Claimable (LHDN)</h2>
    <p class="opacity-80">Sum of amounts in categories you marked as “tax claimable”.</p>
    <div class="stats bg-base-200 shadow">
      <div class="stat">
        <div class="stat-title">Claimable Amount</div>
        <div class="stat-value">RM <?= number_format($taxSum,2) ?></div>
        <div class="stat-desc">Period: <?= Html::encode($from) ?> → <?= Html::encode($to) ?></div>
      </div>
    </div>
  </div>
</div>
