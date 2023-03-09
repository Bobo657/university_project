
@if(session('message') || session('status'))
    <div class="alert flex space-x-2 rounded-lg border border-error px-4 py-4 text-error pb-5 mt-3">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
        </svg>
        <p> {{ session('status') }}</p>

        <p> {{ session('message') }}</p>
    </div>
@endif

@if (session()->has('error'))
<div class="space-y-4 m-2">
  <div
    x-data="{isShow:true}"
    :class="!isShow && 'opacity-0 transition-opacity duration-300'"
    class="alert flex items-center justify-between overflow-hidden rounded-lg border border-error text-error"
  >
    <div class="flex">
      <div class="bg-error p-3 text-white">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="h-5 w-5"
          fill="none"
          viewbox="0 0 24 24"
          stroke="currentColor"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
          />
        </svg>
      </div>
      <div class="px-4 py-3 sm:px-5">{{ session('error') }}</div>
    </div>
    <div class="px-2">
      <button
        @click="isShow = false; setTimeout(()=>$root.remove(),300)"
        class="btn h-7 w-7 rounded-full p-0 font-medium text-error hover:bg-error/20 focus:bg-error/20 active:bg-error/25"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="h-4 w-4"
          fill="none"
          viewbox="0 0 24 24"
          stroke="currentColor"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M6 18L18 6M6 6l12 12"
          />
        </svg>
      </button>
    </div>
  </div>
</div>
@endif