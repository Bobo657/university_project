<div x-data="{showModal:@entangle('showModal')}">
    <div
      class="fixed inset-0 z-[100] flex flex-col items-center justify-center overflow-hidden px-4 py-6 sm:px-5"
      x-show="showModal"
      role="dialog"
      @keydown.window.escape="showModal = false"
    >
      <div
        class="absolute inset-0 bg-slate-900/60 transition-opacity duration-300"
        @click="showModal = false"
        x-show="showModal"
        x-transition:enter="ease-out"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
      ></div>
      <div
        class="relative w-full max-w-md origin-bottom rounded-lg bg-white pb-4 transition-all duration-300 dark:bg-navy-700"
        x-show="showModal"
        x-transition:enter="easy-out"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="easy-in"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
      >
        <div
          class="flex justify-between rounded-t-lg bg-slate-200 px-4 py-3 dark:bg-navy-800 sm:px-5"
        >
          <h3 class="text-base font-medium text-slate-700 dark:text-navy-100">
            Add New Office Contestant
          </h3>
          <button
            @click="showModal = !showModal"
            class="btn -mr-1.5 h-7 w-7 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="h-4.5 w-4.5"
              fill="none"
              viewbox="0 0 24 24"
              stroke="currentColor"
              stroke-width="2"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M6 18L18 6M6 6l12 12"
              ></path>
            </svg>
          </button>
        </div>
        
        <div class="space-y-4 p-4 sm:p-5">
            <x-display_alert :message="$notification_message" />

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <label class="block">
                    <span>Office</span>
                    <select wire:model="office"
                    class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent"
                    >
                    <option value="">Select Office</option>
                    @foreach($offices as $office)
                    <option value="{{ $office->id }}">{{ $office->name }}</option>
                    @endforeach
                    </select>
                    @error('office') 
                    <span class="text-tiny+ text-error">
                        {{ $message }}
                    </span>
                    @enderror
                </label>

                <label class="block">
                  <span>Reg No</span>
                  <input wire:model="reg_no" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Enter student reg_no" type="text">
                    @error('reg_no') 
                    <span class="text-tiny+ text-error">
                        {{ $message }}
                    </span>
                    @enderror
                </label>
            </div>
           
            <div class="flex justify-center space-x-2 pt-4">
              <button  @click="showModal = !showModal" class="btn space-x-2 bg-slate-150 font-medium text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd"></path>
                </svg>
                <span>Close</span>
              </button>
              <button class="btn space-x-2 bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90" wire:click="save()">
                <span>Save</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
              </button>
            </div>
          </div>
      </div>
    </div>
</div>