<div class="col-span-12 grid lg:col-span-8">
    <div class="card">
      <div
        class="border-b border-slate-200 p-4 dark:border-navy-500 sm:px-5"
      >
        <div class="flex items-center space-x-2">
          <div
            class="flex h-7 w-7 items-center justify-center rounded-lg bg-primary/10 p-1 text-primary dark:bg-accent-light/10 dark:text-accent-light"
          >
            <i class="fa-solid fa-layer-group"></i>
          </div>
          <h4 class="text-lg font-medium text-slate-700 dark:text-navy-100">
            Create New Semester
          </h4>
        </div>
      </div>

      <x-alert />

      <div class="space-y-4 p-4 sm:p-5">
        <label class="block">
          <span>Session Duration</span>
          <input wire:model.debounce="duration"
            x-input-mask="{
              delimiter: ' - ',
              blocks: [4, 4],
              numericOnly: true
            }"
            class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
            placeholder="2021 - 2022"
            type="text"
          />
            @error('duration') 
            <span class="text-tiny+ text-error">
                {{ $message }}
            </span> 
            @enderror
        </label>
        
        <div class="grid grid-cols-2 gap-4 sm:grid-cols-4">
            @foreach($levels as $level)
                <label class="block" x-data="{
                    config:{
                        numeral: true,
                        numeralThousandsGroupStyle: 'thousand'
                    }
                }">
                    <span>{{ $level }}Level</span>
                    <input wire:model.debounce="dues.{{$level}}"
                    class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                    placeholder="2000"
                    x-input-mask="config"
                    type="text" id="naira-input" name="naira-input"  
                    
                    />
                @error('dues.'.$level) 
                <span class="text-tiny+ text-error">
                    {{ $message }}
                </span> 
                @enderror
                </label>
            @endforeach
        </div>
        
        <div class="flex justify-center space-x-2 pt-4">
            <button wire:click="createSemester()" class="btn space-x-2 bg-info font-medium text-white hover:bg-info-focus hover:shadow-lg hover:shadow-info/50 focus:bg-info-focus focus:shadow-lg focus:shadow-info/50 active:bg-info-focus/90">
                <span>Click to create semester</span>
            </button>
        </div>
      </div>
    </div>
  </div>


  
