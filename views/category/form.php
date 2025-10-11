<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

/** @var $model app\models\Category */
?>
<div class="max-w-xl card bg-base-100 shadow">
  <div class="card-body">
    <?php $form = ActiveForm::begin(); ?>
      <?= $form->field($model,'name')->textInput(['class'=>'input input-bordered w-full']) ?>
      <label class="label cursor-pointer justify-start gap-3">
        <?= $form->field($model,'is_tax_claimable')->checkbox(['class'=>'checkbox'])->label(false) ?>
        <span class="label-text">Is tax claimable?</span>
      </label>
      <?= $form->field($model,'tax_code')->textInput(['placeholder'=>"e.g. 'Lifestyle', 'Medical'", 'class'=>'input input-bordered w-full']) ?>
      <div class="card-actions justify-end">
        <?= Html::submitButton('Save',['class'=>'btn btn-primary']) ?>
      </div>
    <?php ActiveForm::end(); ?>
  </div>
</div>
