<div class="">
    <div class="flex items-center justify-between py-3 px-3">
      <h2
        class="text-sm+ font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100"
      >
        Academic Session Details
      </h2>
      <button class="btn space-x-2  h-6 bg-info font-medium text-white hover:bg-info-focus hover:shadow-lg hover:shadow-info/50 focus:bg-info-focus focus:shadow-lg focus:shadow-info/50 active:bg-info-focus/90" wire:click="$emitTo('academic-session.create', 'addNewAcademicSession')" >
        <span>Create Academic Session</span>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
          <path d="M5.5 16a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 16h-8z"></path>
        </svg>
      </button>
    </div>
    
    <x-display_alert :message="$notification_message" />

    <div class=" mt-1">
      <div class="is-scrollbar-hidden min-w-full overflow-x-auto">
        <table class="is-hoverable w-full text-left">
            <thead>
                <tr>
                <th class="whitespace-nowrap rounded-tl-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100">
                    Year
                </th>
                <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                    Students
                </th>
                <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                    Contestants
                </th>
                <th class="whitespace-nowrap rounded-tr-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                    Votes
                </th>
                </tr>
            </thead>
            <tbody> 
                @forelse ($academic_sessions as $academic_session)
                <tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
                    <td class="whitespace-nowrap py-3 px-3">
                    <p class="text-base font-medium text-slate-700 dark:text-navy-100">
                        {{  $academic_session->duration }}
                    </p>
                    </td>
                    <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                    <div class="flex items-center space-x-4">  
                        <span class="font-medium text-slate-700 line-clamp-2 dark:text-navy-100">
                            {{ number_format($academic_session->academic_records_count) }}
                        </span>
                    </div>
                    </td>
                    <td class="whitespace-nowrap px-4 py-3 font-medium text-slate-600 dark:text-navy-100 sm:px-5">
                        {{ number_format($academic_session->contestants_count) }}
                    </td>
                    <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                        {{ number_format($academic_session->votes_count) }}
                    </td>
                </tr>
                @empty
                    <tr  class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
                        <td colspan="9" class="whitespace-nowrap px-4 py-3 sm:px-5"> 
                            <div class="flex justify-center items-center"> 
                            <span class="text-cool-gray-600 text"> No Academic Session found </span>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
      </div>
    </div>

    @livewire('academic-session.create')
</div>
