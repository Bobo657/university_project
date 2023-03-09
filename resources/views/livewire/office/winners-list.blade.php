<div>
    @foreach($winners as $winner)
    <div class="card items-center justify-between lg:flex-row mt-2">
        <div class="flex flex-col items-center p-4 text-center sm:p-5 lg:flex-row lg:space-x-4 lg:text-left">
          <div class="avatar h-18 w-18 lg:h-12 lg:w-12">
            <img class="rounded-full" src="{{ $winner->lastestWinner->user->profile_photo_path ?? "#" }}" alt="avatar">
          </div>
          <div class="mt-2 lg:mt-0">
            <div class="flex items-center justify-center space-x-1">
              <h4 class="font-medium text-slate-700 line-clamp-1 dark:text-navy-100">
                <a href="{{ $winner->lastestWinner->user->path ?? '#' }}" > {{ $winner->lastestWinner->user->fullname ?? 'n/a' }}  </a>
              </h4>
              <button class="btn hidden h-6 rounded-full px-2 text-xs font-medium text-primary hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:text-accent-light dark:hover:bg-accent-light/20 dark:focus:bg-accent-light/20 dark:active:bg-accent-light/25 lg:inline-flex">
                {{ $winner->lastestWinner->semester->duration ?? 'n/a' }}
              </button>
            </div>
            <p class="text-xs+"> {{ $winner->name }}</p>
          </div>
         
        </div>
    </div>
    @endforeach 

    @if($election_ongoing)
    <div class="alert mt-2 items-center space-y-4 rounded-lg border border-slate-300 px-4 py-3 text-center text-slate-800 dark:border-navy-450 dark:text-navy-50 sm:flex-row sm:space-y-0 sm:px-5"
    >
        <p class="py-4 mt3">The outcome of the on going election has not yet been announced.</p>
        <button wire:click="calActiveElectionResult()" class="btn space-x-2 mt-4 rounded-full bg-slate-150 font-medium text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90">
            <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" class="h-7 h-8">
                <circle cx="50" cy="50" r="45" fill="#ffd700"/>
                <text x="50" y="50" font-size="30" text-anchor="middle" dominant-baseline="central" fill="#ffffff">🏆</text>
                </svg>
            <br>
            <span>Get election winners</span>
        </button>
    </div>
    @endif
   
</div>
