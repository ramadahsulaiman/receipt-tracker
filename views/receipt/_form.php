<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Receipt $model */
/** @var yii\widgets\ActiveForm $form */
?>
<div class="receipt-form">
<?php $form = ActiveForm::begin([
    'id' => 'receipt-form',
    'options' => ['enctype' => 'multipart/form-data', 'class' => 'space-y-4'],
    'fieldConfig' => [
        'template' => "{label}\n{input}\n{error}",
        'labelOptions' => ['class' => 'font-medium text-base-content'],
        'errorOptions' => ['class' => 'text-red-600 text-sm mt-1'],
    ],
]); ?>

<!-- 🔹 Upload Receipt -->
<div class="mt-1">
  <div class="border border-dashed border-base-300 rounded-xl p-6 bg-base-100/70">
    <!-- Kawasan BUTANG upload (tiada overlay) -->
    <div id="upload-actions" class="<?= $model->cloud_url ? 'hidden' : '' ?> text-center cursor-pointer flex justify-center flex-col items-center">
      <input type="file" id="receiptFile" name="receiptFile" accept=".pdf,image/*" class="hidden">
      <button type="button" 
      class="btn bg-blue-100 text-blue-700 hover:bg-blue-200 border border-blue-300 btn-sm flex items-center gap-2 mt-3 rounded-xl transition-all shadow-sm hover:shadow-md"
      id="btn-choose-file">
        <i class="fa-solid fa-upload"></i> Muat Naik Resit
      </button>
      <p class="text-xs mt-2 text-base-content">Support format PDF dan gambar je. Boleh upload atau nak drag & drop kat sini.</p>
    </div>

    <!-- Paparan PREVIEW (terpisah dari butang upload) -->
    <div id="file-preview" class="mt-1 text-center <?= $model->cloud_url ? '' : 'hidden' ?>">
      <?php if (!empty($model->cloud_url) && strpos($model->cloud_url, '.pdf') !== false): ?>
        <div id="preview-pdf">
          <p class="text-sm text-base-content/70">Fail PDF sedia ada</p>
          <a href="<?= Html::encode($model->cloud_url) ?>" target="_blank" >
          </a>
        </div>
        <img id="preview-image" class="hidden">
      <?php elseif (!empty($model->cloud_url)): ?>
        <img id="preview-image" src="<?= Html::encode($model->cloud_url) ?>" class="max-h-64 rounded-lg shadow-md mx-auto">
        <div id="preview-pdf" class="hidden"></div>
      <?php else: ?>
        <img id="preview-image" class="max-h-64 rounded-lg shadow-md mx-auto hidden">
        <div id="preview-pdf" class="hidden"></div>
      <?php endif; ?>

      <!-- Flag untuk controller -->
      <input type="hidden" id="removeFileInput" name="removeFile" value="0">
      <div class="mt-3 flex justify-center">
        <button type="button" id="btn-remove-file"
          class="btn bg-red-100 text-red-700 hover:bg-red-200 border border-red-300 btn-sm flex items-center gap-2 mt-3 rounded-xl transition-all">
          <i class="fa-solid fa-trash"></i>
          <span>Padam Fail</span>
        </button>
      </div>
    </div>
  </div>
</div>

<!-- 🔹 Tarikh Resit -->
<div class="form-control">
  <label class="label"><span class="label-text font-semibold">Tarikh Resit</span></label>
  <div class="relative">
    <i class="fa-solid fa-calendar-day absolute left-3 top-3 text-base-content"></i>
    <?= $form->field($model, 'spent_at', [
      'options' => ['class' => 'm-0']]
      )
        ->input('date', [
          'class' => 'input input-bordered w-full rounded-lg pl-10 '
          ]
          )
        ->label(false) ?>
  </div>
</div>

<!-- 🔹 Kategori -->
<div>
  <h2 class="text-lg font-semibold text-base-content mb-2">
    <i class="fa-solid fa-tags text-secondary"></i> Kategori
  </h2>
  <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
    <?php foreach ($category as $id => $label): ?>
      <label class="flex items-center gap-1 p-2 bg-white text-black rounded-lg cursor-pointer hover:bg-base-400 transition shadow-md">
        <input type="radio"
               name="Receipt[category_id]"
               value="<?= $id ?>"
               class="radio radio-xs"
               <?= $model->category_id == $id ? 'checked' : '' ?>>
        <span class="text-sm font-medium"><?= Html::encode($label) ?></span>
      </label>
    <?php endforeach; ?>
  </div>
</div>

<!-- 🔹 Vendor -->
<div>
  <label class="label"><span class="label-text font-semibold">Vendor / Kedai</span></label>
  <?= $form->field($model, 'vendor', [
    'options' => [
      'class' => 'm-0'
      ]])
      ->textInput(['placeholder' => 'Contoh: Tesco, GrabFood, Watsons', 'class' => 'input input-bordered w-full'])
      ->label(false) ?>
</div>

<!-- 🔹 Catatan -->
<div>
  <label class="label"><span class="label-text font-semibold">Catatan</span></label>
  <?= $form->field($model, 'notes', ['options' => ['class' => 'm-0']])
      ->textarea(['rows' => 3, 'placeholder' => 'Masukkan sebarang catatan...', 'class' => 'textarea textarea-bordered w-full'])
      ->label(false) ?>
</div>

<!-- 🔹 Senarai Item -->
<div>
  <h2 class="text-lg font-semibold text-base-content mb-3">
    <i class="fa-solid fa-cart-shopping text-primary"></i> Senarai Item
  </h2>

  <div class="text-sm leading-tight">
    <table class="table w-full border border-base-300 rounded-lg text-base-content text-sm" id="items-table">
      <thead>
        <tr class="bg-base-200">
          <th class="w-1/2 px-3 py-2 text-sm text-base-content/90">Item</th>
          <th class="w-1/4 px-3 py-2 text-sm text-base-content/90">Jumlah (RM)</th>
          <th class="w-1/6 px-3 py-2 text-sm text-center text-base-content/90">Tindakan</th>
        </tr>
      </thead>
      <tbody id="item-rows"></tbody>
    </table>
  </div>

  <div class="mt-6">
    <button type="button" class="btn btn-sm flex items-center justify-center bg-green-200 text-black hover:bg-green-300 border-none px-2 h-5 rounded-xl font-semibold tracking-wide transition-all duration-300 shadow-sm hover:shadow-md" id="btn-add-item">
      <i class="fa-solid fa-plus"></i> Tambah Item
    </button>
  </div>

  <div class="mt-4 text-right text-lg font-semibold">
    Jumlah Keseluruhan: RM <span id="total-amount">0.00</span>
  </div>
</div>

<!-- 🔹 Save Buttons -->
<div class="flex justify-between">
  <label class="label cursor-pointer gap-1">
    <input type="checkbox" name="Receipt[status]" value="Draft" class="checkbox checkbox-sm">
    <span class="label-text">Simpan sebagai Draf</span>
  </label>


</div>
  <?= $this->render('../layouts/_formButtons', [
      'saveLabel' => '<i class="fa-solid fa-floppy-disk mr-2"></i> Simpan Resit',
  ]) ?>
<?php ActiveForm::end(); ?>
</div>

<!-- 🔧 JS (SATU blok sahaja, tiada fungsi berganda) -->
<script>
(function() {
  const fileInput     = document.getElementById('receiptFile');
  const btnChoose     = document.getElementById('btn-choose-file');
  const previewWrap   = document.getElementById('file-preview');
  const uploadActions = document.getElementById('upload-actions');
  const imgPreview    = document.getElementById('preview-image');
  const pdfPreview    = document.getElementById('preview-pdf');
  const removeFlag    = document.getElementById('removeFileInput');
  const btnRemove     = document.getElementById('btn-remove-file');

  // ––– Upload –––
  if (btnChoose) {
    // support drag & drop pada butang
    btnChoose.addEventListener('click', function(e) {
      e.preventDefault();
      e.stopPropagation();
      fileInput.click();
    });

    btnChoose.addEventListener('dragover', function(e) {
      e.preventDefault();
    });
    btnChoose.addEventListener('drop', function(e) {
      e.preventDefault();
      if (e.dataTransfer && e.dataTransfer.files && e.dataTransfer.files[0]) {
        fileInput.files = e.dataTransfer.files;
        handlePreview(fileInput.files[0]);
      }
    });
  }

  if (fileInput) {
    fileInput.addEventListener('change', function(e) {
      const f = e.target.files[0];
      if (!f) return;
      handlePreview(f);
    });
  }

  function handlePreview(file) {
    // tunjuk preview section, sembunyi panel upload
    uploadActions.classList.add('hidden');
    previewWrap.classList.remove('hidden');
    removeFlag.value = '0';

    // reset
    if (imgPreview) { imgPreview.classList.add('hidden'); }
    if (pdfPreview) { pdfPreview.classList.add('hidden'); while (pdfPreview.firstChild) pdfPreview.removeChild(pdfPreview.firstChild); }

    if (file.type.includes('pdf')) {
      // PDF: tunjuk ikon + button view tab baru (blob url)
      pdfPreview.classList.remove('hidden');
      const icon = document.createElement('i');
      icon.className = 'fa-solid fa-file-lines text-5xl text-error mb-2 block';
      const view = document.createElement('a');
      view.target = '_blank';
      view.className = 'btn btn-xs text-sm text-primary';
      view.textContent = 'Lihat PDF';
      view.href = URL.createObjectURL(file);
      pdfPreview.appendChild(icon);
      pdfPreview.appendChild(view);
    } else {
      // IMAGE: read & show
      const reader = new FileReader();
      reader.onload = (ev) => {
        if (imgPreview) {
          imgPreview.src = ev.target.result;
          imgPreview.classList.remove('hidden');
        }
      };
      reader.readAsDataURL(file);
    }
  }

  // ––– Delete –––
  if (btnRemove) {
    btnRemove.addEventListener('click', function(e) {
      e.preventDefault();
      e.stopPropagation(); // pastikan tak trigger apa-apa click lain

      // sembunyi preview, aktifkan balik panel upload
      previewWrap.classList.add('hidden');
      uploadActions.classList.remove('hidden');

      // kosongkan input file & set flag untuk controller
      if (fileInput) fileInput.value = '';
      removeFlag.value = '1';
    });
  }

  // ––– Items –––
  const btnAddItem = document.getElementById('btn-add-item');
  if (btnAddItem) {
    btnAddItem.addEventListener('click', function() {
      const tbody = document.getElementById('item-rows');
      const tr = document.createElement('tr');
      tr.innerHTML = `
        <td><input type="text" name="items[name][]" class="input input-sm input-bordered w-full rounded-lg" placeholder="Nama item"></td>
        <td><input type="number" step="0.01" name="items[amount][]" class="input input-sm input-bordered w-full rounded-lg item-amount" placeholder="0.00"></td>
        <td class="text-center align-middle">
          <button type="button" class="btn btn-xs btn-error" data-action="remove-row">
            <i class="fa-solid fa-trash"></i>
          </button>
        </td>
      `;
      tbody.appendChild(tr);
      recalcTotal();
    });

    document.addEventListener('input', function(e) {
      if (e.target && e.target.classList.contains('item-amount')) recalcTotal();
    });

    document.addEventListener('click', function(e) {
      if (e.target.closest('[data-action="remove-row"]')) {
        e.preventDefault();
        e.target.closest('tr').remove();
        recalcTotal();
      }
    });
  }

  function recalcTotal() {
    let total = 0;
    document.querySelectorAll('.item-amount').forEach(i => total += parseFloat(i.value) || 0);
    const target = document.getElementById('total-amount');
    if (target) target.textContent = total.toFixed(2);
  }
})();
</script>
<style>
  /* Sembunyi butang file default */
  /* #receiptFile {
    display: none;
  } */

</style>