<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper; 
use app\models\Category;

/** @var yii\web\View $this */
/** @var app\models\Receipt $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="receipt-form">
<?php $form = ActiveForm::begin([
    'id' => 'receipt-form',
    'options' => ['enctype' => 'multipart/form-data', 'class' => 'space-y-8'],
]); ?>

<!-- 🔹 Upload Receipt -->
<div>
  <h2 class="text-lg font-semibold text-base-content/80 mb-4 border-b border-base-300 pb-2">
    <i class="fa-solid fa-cloud-arrow-up text-primary"></i> Muat Naik Resit
  </h2>

  <div class="flex flex-col items-center justify-center border-2 border-dashed border-base-300 rounded-xl p-6 bg-base-100/70 hover:border-primary transition group relative">
    <i class="fa-solid fa-file-arrow-up text-4xl text-base-content/50 mb-3 group-hover:text-primary transition"></i>

    <input type="file" id="receiptFile" name="receiptFile" accept=".pdf,image/*"
      class="absolute inset-0 opacity-0 cursor-pointer" onchange="previewFile(event)">

    <p class="text-sm text-base-content/70">Klik atau seret fail PDF / imej untuk dimuat naik</p>

    <!-- Paparan sedia ada -->
    <div id="file-preview" class="mt-5 text-center <?= $model->cloud_url ? '' : 'hidden' ?>">
      <?php if ($model->cloud_url): ?>
        <?php if (strpos($model->cloud_url, '.pdf') !== false): ?>
          <div id="preview-pdf">
            <i class="fa-solid fa-file-pdf text-4xl text-error"></i>
            <p class="mt-2 text-sm">Fail PDF sedia ada dimuat naik</p>
          </div>
        <?php else: ?>
          <img id="preview-image" src="<?= Html::encode($model->cloud_url) ?>" class="max-h-64 rounded-lg shadow-md mx-auto">
        <?php endif; ?>
      <?php else: ?>
        <img id="preview-image" class="max-h-64 rounded-lg shadow-md mx-auto hidden">
        <div id="preview-pdf" class="hidden text-base-content/70">
          <i class="fa-solid fa-file-pdf text-4xl text-error"></i>
          <p class="mt-2 text-sm">Fail PDF dimuat naik</p>
        </div>
      <?php endif; ?>

      <input type="hidden" id="removeFileInput" name="removeFile" value="0">
      <button type="button" onclick="removeFile()" class="btn btn-xs btn-outline btn-error mt-3">
        <i class="fa-solid fa-trash"></i> Padam Fail
      </button>
    </div>
  </div>
</div>

<!-- 🔹 Date of Receipt -->
<div class="form-control">
  <label class="label"><span class="label-text font-semibold">Tarikh Resit</span></label>
  <div class="relative">
    <i class="fa-solid fa-calendar-day absolute left-3 top-3 text-base-content/50"></i>
    <?= $form->field($model, 'spent_at', ['options' => ['class' => 'm-0']])
        ->input('date', ['class' => 'input input-bordered w-full rounded-lg pl-10'])
        ->label(false) ?>
  </div>
</div>

<!-- 🔹 Category -->
<div>
  <h2 class="text-lg font-semibold text-base-content/80 mb-3">
    <i class="fa-solid fa-tags text-secondary"></i> Kategori
  </h2>

  <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
    <?php foreach ($category as $id => $label): ?>
      <label class="flex items-center gap-2 p-3 bg-base-200 rounded-lg cursor-pointer hover:bg-base-300 transition shadow-sm">
        <input type="radio"
               name="Receipt[category_id]"
               value="<?= $id ?>"
               class="radio radio-primary"
               <?= $model->category_id == $id ? 'checked' : '' ?>>
        <span class="text-sm font-medium"><?= Html::encode($label) ?></span>
      </label>
    <?php endforeach; ?>
  </div>
</div>


<!-- 🔹 Vendor -->
<div>
  <label class="label"><span class="label-text font-semibold">Vendor / Kedai</span></label>
  <?= $form->field($model, 'vendor', ['options' => ['class' => 'm-0']])
      ->textInput(['placeholder' => 'Contoh: Tesco, GrabFood, Watsons', 'class' => 'input input-bordered w-full'])
      ->label(false) ?>
</div>

<!-- 🔹 Notes -->
<div>
  <label class="label"><span class="label-text font-semibold">Catatan</span></label>
  <?= $form->field($model, 'notes', ['options' => ['class' => 'm-0']])
      ->textarea(['rows' => 3, 'placeholder' => 'Masukkan sebarang catatan...', 'class' => 'textarea textarea-bordered w-full'])
      ->label(false) ?>
</div>

<!-- 🔹 Dynamic Items -->
<div>
  <h2 class="text-lg font-semibold text-base-content/80 mb-3">
    <i class="fa-solid fa-cart-shopping text-primary"></i> Senarai Item
  </h2>
  <div class="overflow-x-auto">
    <table class="table w-full border border-base-300 rounded-lg text-sm" id="items-table">
      <thead>
        <tr class="bg-base-200">
          <th>Item</th>
          <th>Jumlah (RM)</th>
          <th class="text-center">Tindakan</th>
        </tr>
      </thead>
      <tbody id="item-rows"></tbody>
    </table>
  </div>
  <div class="mt-3">
    <button type="button" class="btn btn-sm btn-outline btn-primary" onclick="addItemRow()">
      <i class="fa-solid fa-plus"></i> Tambah Item
    </button>
  </div>

  <div class="mt-4 text-right text-lg font-semibold">
    Jumlah Keseluruhan: RM <span id="total-amount">0.00</span>
  </div>
</div>

<!-- 🔹 Save Buttons -->
<div class="pt-6 flex justify-between">
  <label class="label cursor-pointer gap-2">
    <input type="checkbox" name="Receipt[status]" value="Draft" class="checkbox checkbox-sm">
    <span class="label-text">Simpan sebagai Draf</span>
  </label>

  <button type="submit" name="action" value="save" class="btn btn-primary text-white">
    <i class="fa-solid fa-floppy-disk"></i> Simpan Resit
  </button>
</div>

<?php ActiveForm::end(); ?>
</div>

<!-- ✅ JS Scripts -->
<script>
function previewFile(event) {
  const file = event.target.files[0];
  const previewContainer = document.getElementById('file-preview');
  const imagePreview = document.getElementById('preview-image');
  const pdfPreview = document.getElementById('preview-pdf');
  const removeInput = document.getElementById('removeFileInput');

  if (!file) return;
  previewContainer.classList.remove('hidden');
  removeInput.value = '0'; // user upload new file

  if (file.type.includes('pdf')) {
    pdfPreview.classList.remove('hidden');
    imagePreview.classList.add('hidden');
  } else {
    const reader = new FileReader();
    reader.onload = e => {
      imagePreview.src = e.target.result;
      imagePreview.classList.remove('hidden');
      pdfPreview.classList.add('hidden');
    };
    reader.readAsDataURL(file);
  }
}

function removeFile() {
  document.getElementById('file-preview').classList.add('hidden');
  document.getElementById('preview-image').classList.add('hidden');
  document.getElementById('preview-pdf').classList.add('hidden');
  document.getElementById('receiptFile').value = '';
  document.getElementById('removeFileInput').value = '1'; // mark file to remove
}

function addItemRow() {
  const tbody = document.getElementById('item-rows');
  const row = document.createElement('tr');
  row.innerHTML = `
    <td><input type="text" name="items[name][]" class="input input-bordered w-full rounded-lg" placeholder="Nama item"></td>
    <td><input type="number" step="0.01" name="items[amount][]" class="input input-bordered w-full rounded-lg item-amount" placeholder="0.00" oninput="updateTotal()"></td>
    <td class="text-center">
      <button type="button" class="btn btn-xs btn-error" onclick="removeRow(this)">
        <i class="fa-solid fa-trash"></i>
      </button>
    </td>
  `;
  tbody.appendChild(row);
}

function removeRow(btn) {
  btn.closest('tr').remove();
  updateTotal();
}

function updateTotal() {
  let total = 0;
  document.querySelectorAll('.item-amount').forEach(input => {
    total += parseFloat(input.value) || 0;
  });
  document.getElementById('total-amount').textContent = total.toFixed(2);
}
</script>
