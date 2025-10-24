<?php
use yii\helpers\Html;

/**
 * @var string $cancelUrl   // URL for Cancel button (optional)
 * @var string $saveLabel   // Label for Save button
 * @var string $cancelLabel // Label for Cancel button
 */

$cancelUrl   = $cancelUrl   ?? ['/site/index'];
$saveLabel   = $saveLabel   ?? '<i class="fa-solid fa-floppy-disk mr-2"></i> Simpan';
$cancelLabel = $cancelLabel ?? '<i class="fa-solid fa-rotate-left mr-2"></i> Kembali';
?>

<div class="flex justify-end gap-4 pt-6">
  <?= Html::a($cancelLabel, $cancelUrl, [
      'class' => 'flex items-center justify-center gap-1 bg-yellow-200 text-black hover:bg-yellow-300 border-none px-4 h-10 rounded-xl font-semibold tracking-wide transition-all duration-300 shadow-sm hover:shadow-md',
  ]) ?>

  <button type="submit" class="flex items-center justify-center gap-1 bg-blue-200 text-blue-800 hover:bg-blue-300 border-none px-4 h-10 rounded-xl font-semibold tracking-wide transition-all duration-300 shadow-sm hover:shadow-md">
    <?= $saveLabel ?>
</button>
</div>
