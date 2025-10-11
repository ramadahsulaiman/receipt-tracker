<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var $model app\models\Receipt */
/** @var $categories app\models\Category[] */

$this->title = $model->isNewRecord ? 'New Receipt' : 'Edit Receipt';
?>
<div class="max-w-2xl card bg-base-100 shadow">
  <div class="card-body">
    <h1 class="card-title"><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin([
      'options' => ['enctype'=>'multipart/form-data']
    ]); ?>

    <div class="grid md:grid-cols-2 gap-4">
      <?= $form->field($model,'amount')->textInput(['type'=>'number','step'=>'0.01','class'=>'input input-bordered w-full']) ?>
      <?= $form->field($model,'spent_at')->textInput(['type'=>'date','class'=>'input input-bordered w-full']) ?>
    </div>

    <?= $form->field($model,'vendor')->textInput(['class'=>'input input-bordered w-full','placeholder'=>'Shop/Store']) ?>

    <label class="form-control w-full mb-4">
      <div class="label"><span class="label-text">Category</span></div>
      <select name="Receipt[category_id]" class="select select-bordered">
        <option value="">-- None --</option>
        <?php foreach($categories as $c): ?>
          <option value="<?= $c->id ?>" <?= $model->category_id==$c->id?'selected':'' ?>>
            <?= htmlspecialchars($c->name) ?><?= $c->is_tax_claimable ? ' (Tax)' : '' ?>
          </option>
        <?php endforeach; ?>
      </select>
    </label>

    <?= $form->field($model,'notes')->textarea(['class'=>'textarea textarea-bordered w-full']) ?>

    <div class="mb-4">
      <label class="label"><span class="label-text">Receipt Image (camera supported)</span></label>
      <input class="file-input file-input-bordered w-full"
             type="file" name="image" accept="image/*" capture="environment">
      <?php if ($model->cloud_url): ?>
        <div class="mt-2">
          <img src="<?= htmlspecialchars($model->cloud_url) ?>" class="rounded-lg max-h-64">
        </div>
      <?php endif; ?>
    </div>

    <div class="card-actions justify-end">
      <?= Html::submitButton('Save',['class'=>'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
  </div>
</div>
