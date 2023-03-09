<div class="grid grid-cols-1 sm:grid-cols-3 mt-2"> 
    <div class=" col-span-2">
        <input wire:model="name"
            class="form-input h-9 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
            placeholder="New award name"
            type="text"
        />
        
    </div>
    <button wire:click="createAward()" class="btn sm:grid-cols-1 font-medium text-primary hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 text-xs ">
        Create Award
    </button>
    @error('name') 
    <span class="text-tiny+ text-error sm:grid-cols-3">
        {{ $message }}
    </span> 
    @enderror
</div>
