<?php
use yii\helpers\Url;
?>

<!-- Pretty Toast Notification -->
<div id="successToast" class="toast toast-bottom toast-end z-50 transition-all duration-700 translate-y-10 opacity-0 pointer-events-auto">
  <div class="alert shadow-lg bg-white border border-gray-300 rounded-2xl text-black px-5 py-4">
    <div class="flex items-start justify-between w-full gap-4">
      
      <!-- Left: Icon + Text -->
      <div class="flex items-start gap-4">
        <!-- Glowing Icon -->
        <div class="relative flex items-center justify-center">
          <div class="absolute w-8 h-8 bg-black/20 rounded-full animate-ping"></div>
          <i class="fa-solid fa-circle-check text-black text-2xl relative z-10"></i>
        </div>

        <!-- Text -->
        <div class="text-left">
          <h3 class="font-bold text-lg leading-none mb-1">Nahh siap dah!</h3>
          <p class="text-sm opacity-90">
            Boleh login sekarang, yaaay!🎉
          </p>
        </div>
      </div>

      <!-- Right: Buttons -->
      <div class="flex flex-col sm:flex-row items-center gap-2">
        <a href="<?= Url::to(['site/login']) ?>"
           class="btn btn-sm bg-grey text-black font-semibold hover:bg-base-100 border-none rounded-full normal-case px-4">
           Go to Login
        </a>
        <button id="closeToast"
                class="btn btn-sm btn-ghost text-black hover:bg-success/30 rounded-full normal-case px-4">
          <i class="fa-solid fa-xmark text-lg"></i>
        </button>
      </div>

    </div>
  </div>
</div>

<!-- JS: slide-in / fade-out -->
<script>
  const toast = document.getElementById('successToast');
  const closeBtn = document.getElementById('closeToast');

  // Slide in animation
  setTimeout(() => {
    toast.classList.remove('translate-y-10', 'opacity-0');
    toast.classList.add('translate-y-0', 'opacity-100');
  }, 100);

  // Close animation
  function closeToast() {
    toast.classList.remove('opacity-100', 'translate-y-0');
    toast.classList.add('opacity-0', 'translate-y-10');
    setTimeout(() => toast.remove(), 600);
  }

  setTimeout(closeToast, 4000); // auto-hide after 4s
  closeBtn.addEventListener('click', closeToast);
</script>
