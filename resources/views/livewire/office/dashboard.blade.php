<div>
    <div class="mt-6 flex flex-col items-center justify-between space-y-2 text-center sm:flex-row sm:space-y-0 sm:text-left">
        <div>
            <h2 class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl">
                {{ $academic_session->duration }} Academic Session Executives
             </h2>
             <div class="hidden h-full py-1 sm:flex">
               <div class="h-full w-px bg-slate-300 dark:bg-navy-600"></div>
             </div>
             <ul class="hidden flex-wrap items-center space-x-2 sm:flex">
               <li class="flex items-center space-x-2">
                 <a class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent" href="#">Dashboard</a>
                 <svg x-ignore="" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                 </svg>
               </li>
               <li>Executives</li>
             </ul>
        </div>
        <div class="justify-between space-y-2 flex flex-col items-center " > 
           
            <button wire:click="$emitTo('office.add-contestant', 'showNewContestantForm');" class="btn space-x-2 bg-info font-medium text-white shadow-lg shadow-primary/50 hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:shadow-accent/50 dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="edit" data-lucide="edit" class="lucide lucide-edit"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                <span> New Contestant </span>
              </button>
            <label>
                <select wire:model="selected_academic_session_id"
                  class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent"
                >
                  <option value="">Select Academic Session</option>
                  @foreach($academic_sessions as $year)
                    <option value="{{ $year->id }}">{{ $year->duration }}</option>
                  @endforeach
                </select>
            </label>
        </div>
    </div>

    <div class="mt-4 grid grid-cols-12 gap-4 sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6">
        <div class="pb-3 lg:col-span-5 col-span-12">
            <div class="grid grid-cols-2 gap-4 sm:grid-cols-2 sm:gap-5 lg:grid-cols-2 lg:gap-6">
                <div class="relative flex flex-col overflow-hidden rounded-lg bg-gradient-to-br from-info to-info-focus p-3.5">
                  <p class="text-xs uppercase text-sky-100">Total Conntestants</p>
                  <div class="flex items-end justify-between space-x-2">
                    <p class="mt-4 text-2xl font-medium text-white">
                      {{ number_format($contestants->count()) }}
                    </p>
                   
                  </div>
                  <div class="mask is-reuleaux-triangle absolute top-0 right-0 -m-3 h-16 w-16 bg-white/20"></div>
                </div>
                 
                <div class="rounded-lg bg-gradient-to-br from-pink-500 to-rose-500 p-3.5">
                  <p class="text-xs uppercase text-pink-100">Total Votes</p>
                  <div class=" items-end justify-between space-x-2">
                    <p class="mt-4 text-2xl font-medium text-white"> {{ number_format($contestants->sum('votes_count')) }}</p>
                    </a>
                  </div>
                </div>
            </div>

            @livewire('office.winners', ['academic_session_id' => $academic_session->id])
        </div>

        <div class="col-span-12 lg:col-span-7">
            <x-display_alert :message="$notification_message" />
            <div class="card is-scrollbar-hidden min-w-full overflow-x-auto p-3.5">
                <h2 class="font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100 lg:text-base">
                    Office Contestants Table
                  </h2>
                <table class="w-full text-left">
                  <thead>
                    <tr class="border border-transparent border-b-slate-200 dark:border-b-navy-500">
                      <th
                        class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5"
                      >
                        Student
                      </th>
                      <th
                        class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5"
                      >
                        Office
                      </th>
                      <th
                        class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5 text-center"
                      >
                        Vote(s)
                      </th>
                      <th
                        class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5"
                      >
                        Date
                      </th>
                      <th
                        class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5"
                      >
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($contestants as $student)
                    <tr class="border border-transparent border-b-slate-200 dark:border-b-navy-500">
                      <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                        {{ $student->user->fullname }}
                      </td>
                      <td class="whitespace-nowrap px-4 py-3 sm:px-5">{{ $student->contestantable->office }}</td>
                      <td class="whitespace-nowrap px-4 py-3 sm:px-5 text-center">
                        {{ $student->votes_count }}
                      </td>
                      <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                        {{ $student->created_at->format('Y-m-d') }}
                      </td>
                      <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                        <a class="flex items-center text-error" href="javascript:;" wire:click.prevent="showDeleteNotification({{ $student->id }})">
                            <i class="w-4 h-4 mr-1"></i> 
                            Remove
                        </a>
                      </td>
                    </tr>
                    @empty
                    <tr  class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
                        <td colspan="5" class="whitespace-nowrap px-4 py-3 sm:px-5"> 
                            <div class="flex justify-center items-center"> 
                            <span class="text-cool-gray-600 font-medium text-slate-700 dark:text-navy-100"> No record found </span>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
        </div>
    </div>

    <x-delete_notification />

    @livewire('office.add-contestant')
</div> 
