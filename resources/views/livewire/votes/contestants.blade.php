<div class="card px-4 pb-4 sm:px-5">
    <div class="my-3 flex h-8 items-center justify-between">
        <h2 class="font-medium tracking-wide text-slate-700 dark:text-navy-100">
         Contestants
        </h2>
    </div>
    <div class="space-y-3.5">
        @forelse($contestants as $contestant)
        <div class="flex cursor-pointer items-center justify-between">
        <div class="flex items-center space-x-3.5">
            <div class="avatar">
            <img class="rounded-full" src="images/avatar/avatar-20.jpg" alt="avatar">
            </div>
            <div>
            <p class="font-medium text-slate-700 dark:text-navy-100">
                {{ $contestant->full_name}}
            </p>
            <p class="text-xs text-slate-400 line-clamp-1 dark:text-navy-300">
                {{ $contestant->award }}
            </p>
            </div>
        </div>
        <p class="font-medium text-slate-600 dark:text-navy-100">
            {{ $contestant->votes_count }}Votes
        </p>
        </div>
        @empty
        <div class="alert text-center flex rounded-lg bg-slate-200 px-4 py-4 text-slate-600 dark:bg-navy-500 dark:text-navy-100 sm:px-5"
        >
            No contestant found in database
        </div>
        @endforelse
        
    </div>
</div>