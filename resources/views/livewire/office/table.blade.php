<div class="card  col-span-12 lg:col-span-6">
  <div class="grid grid-cols-2 gap-3 px-4 sm:grid-cols-2 sm:gap-5 sm:px-5">
    <div class="mt-2">
        <div class="flex items-center space-x-1">
            <p class="text-2xl font-semibold text-slate-700 dark:text-navy-100">
            {{ number_format($offices->sum('contestants_count')) }}
            </p>
        </div>
        <p class="text-xs text-slate-400 dark:text-navy-300">
            Total Contestants
        </p>
    </div>
    <div class="mt-2">
      <div class="flex items-center space-x-1">
        <p class="text-2xl font-semibold text-slate-700 dark:text-navy-100">
          {{ number_format($offices->sum('votes_count')) }}
        </p>
      </div>
      <p class="text-xs text-slate-400 dark:text-navy-300">
        Total Votes
      </p>
    </div>
  </div>
  
  <div class="mt-5 flex items-center justify-between px-3">
    <h2  class="text-sm+ font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100">
      Office Details
    </h2>
    <button wire:click="$emitTo('office.create', 'addNewOffice')" class="btn space-x-2  h-6 bg-info font-medium text-white hover:bg-info-focus hover:shadow-lg hover:shadow-info/50 focus:bg-info-focus focus:shadow-lg focus:shadow-info/50 active:bg-info-focus/90">
      <span>Create Position</span>
      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="edit" data-lucide="edit" class="lucide lucide-edit"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
    </button>
  </div>

  <x-display_alert :message="$notification_message" />

  <div class=" mt-3">
    <div class="is-scrollbar-hidden min-w-full overflow-x-auto">
      <table class="is-hoverable w-full text-left">
        <thead>
          <tr>
            <th
              class="whitespace-nowrap rounded-tl-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100"
            >
              Position
            </th> 
            <th
              class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
            >
              Contestants
            </th>
            <th
              class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
            >
              Votes
            </th>
            <th
              class="whitespace-nowrap rounded-tr-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
            >
            </th>
          </tr>
        </thead>
        <tbody>
          @forelse ($offices as $office)
          <tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
            <td class="whitespace-nowrap px-4 py-3">
              <p class="text-base font-medium text-slate-700 dark:text-navy-100">
                {{ $office->name }}
              </p>
            </td>
            <td class="text-center px-4 py-3 sm:px-5">
                <span
                  class="font-medium text-slate-700 line-clamp-2 dark:text-navy-100"
                  >{{ $office->contestants_count }}
                </span>
            </td>
            <td class="whitespace-nowrap px-4 py-3 font-medium text-slate-600 dark:text-navy-100 sm:px-5 text-center" 
            >
              {{ $office->votes_count }}
            </td>
            <td class="whitespace-nowrap px-4 py-3 sm:px-5">
              <span><div class="flex justify-center space-x-1">
                <button class="btn h-8 w-6 p-0 text-info hover:bg-info/20 focus:bg-info/20 active:bg-info/25">
                    <i class="fa fa-edit"></i>
                </button>
                <button wire:click.prevent="showDeleteNotification({{ $office->id }})" class="btn h-8 w-6 p-0 text-error hover:bg-error/20 focus:bg-error/20 active:bg-error/25">
                    <i class="fa fa-trash-alt"></i>
                </button>
            </div></span>
            </td>
          </tr>
          @empty
              
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
  <x-delete_notification />

  @livewire('office.create')
</div>