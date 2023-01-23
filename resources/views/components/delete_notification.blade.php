<div x-data="{displayModal: @entangle('showDeleteNotification'), student: @entangle('selected_student')}">
    <div
      class="fixed inset-0 z-[100] flex flex-col items-center justify-center overflow-hidden px-4 py-6 sm:px-5"
      x-show="displayModal"
      role="dialog"
      @keydown.window.escape="displayModal = false"
    >
      <div
        class="absolute inset-0 bg-slate-900/60 backdrop-blur transition-opacity duration-300"
        @click="displayModal = false"
        x-show="displayModal"
        x-transition:enter="ease-out"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
      ></div>
      <div
        class="relative max-w-lg rounded-lg bg-white px-4 py-10 text-center transition-opacity duration-300 dark:bg-navy-700 sm:px-5"
        x-show="displayModal"
        x-transition:enter="ease-out"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="inline h-28 w-28 text-error"
          fill="none"
          viewbox="0 0 24 24"
          stroke="currentColor"
        >
            <circle cx="12" cy="12" r="10"></circle>
            <line x1="15" y1="9" x2="9" y2="15"></line>
            <line x1="9" y1="9" x2="15" y2="15"></line>
        </svg>

        <div class="mt-4">
          <p class="mt-2">
            Do you really want to delete these records? <br>This process cannot be undone.
          </p>
          
          <div class="space-x-3 mt-5">
            <button
              @click="displayModal = false"
              class="btn min-w-[7rem] rounded-full border border-slate-300 font-medium text-slate-800 hover:bg-slate-150 focus:bg-slate-150 active:bg-slate-150/80 dark:border-navy-450 dark:text-navy-50 dark:hover:bg-navy-500 dark:focus:bg-navy-500 dark:active:bg-navy-500/90"
            >
              Cancel
            </button>
            <button
              x-on:click="$wire.deleteRecord()"
              class="btn min-w-[7rem] rounded-full bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90"
            >
              Apply
            </button>
        </div>
      </div>
    </div>
  
</div>