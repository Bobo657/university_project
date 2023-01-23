<div>
    <div class="mt-6 flex flex-col items-center justify-between space-y-2 text-center sm:flex-row sm:space-y-0 sm:text-left">
        <div>
            <h2 class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl">
                Award Election Votes
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
               <li>Award Votes</li>
             </ul>
        </div>
        <div class="justify-between space-y-2 flex flex-col items-center " > 
            
        
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

    <div class="mt-4 grid grid-cols-12 gap-4 sm:mt-5 lg:mt-6 lg:gap-6">
      <div class="col-span-12 pb-3 lg:col-span-4" >
        <div class="grid grid-cols-2 gap-4 sm:grid-cols-2 sm:gap-5 lg:grid-cols-2 lg:gap-6">
            <div class="relative flex flex-col overflow-hidden rounded-lg bg-gradient-to-br from-info to-info-focus p-3.5">
              <p class="text-xs uppercase text-sky-100">Total Conntestants</p>
              <div class="flex items-end justify-between space-x-2">
                <p class="mt-4 text-2xl font-medium text-white"> {{ number_format($total_contestants) }}</p>
                
              </div>
              <div class="mask is-reuleaux-triangle absolute top-0 right-0 -m-3 h-16 w-16 bg-white/20"></div>
            </div>
            <div class="rounded-lg bg-gradient-to-br from-pink-500 to-rose-500 p-3.5">
              <p class="text-xs uppercase text-pink-100">Total Votes</p>
              <div class=" items-end justify-between space-x-2">
                <p class="mt-4 text-2xl font-medium text-white"> {{ number_format($total_votes) }}</p>
                </a>
              </div>
            </div>
        </div>

        <div class="mt-4 sm:mt-5 lg:mt-6">
          @livewire('votes.contestants', ['academic_session_id' => $academic_session->id])
        </div>
      </div>

        <div class="col-span-12 lg:col-span-8">
            <x-display_alert :message="$notification_message" />
            <div class="card is-scrollbar-hidden min-w-full overflow-x-auto p-3.5">
                <div class="grid lg:grid-cols-3 gap-3 px-4">
                    <h2 class="font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100 lg:text-base sm:col-span-2">
                        {{ $academic_session->duration}} Award Votes Table
                    </h2>
                    <label class="block ">
                        <input wire:model.debounce="search"
                          class="form-input w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                          placeholder="Search name"
                          type="text"
                        />
                    </label>
                </div>
               
                
                <table class="w-full is-zebra text-left">
                  <thead>
                    <tr class="border border-transparent border-b-slate-200 dark:border-b-navy-500">
                      <th
                        class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5"
                      >
                        Voter
                      </th>
                      <th
                        class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5"
                      >
                        Award
                      </th>
                      <th
                        class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5 text-center"
                      >
                        Contestant
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
                    @forelse($votes as $vote)
                    <tr class="border border-transparent border-b-slate-200 dark:border-b-navy-500">
                      <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                         {{ $vote->first_name }} {{ $vote->middle_name }} {{ $vote->last_name }}
                      </td>
                      <td class="whitespace-nowrap px-4 py-3 sm:px-5"> 
                         {{ $vote->name }}
                      </td>
                      <td class="whitespace-nowrap px-4 py-3 sm:px-5 text-center">
                        {{ $vote->first}} {{ $vote->middle}} {{ $vote->last}}
                      </td>
                      <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                         {{ $vote->created_at }}
                      </td>
                      <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                        <a class="flex items-center text-error" wire:click.prevent="showDeleteNotification({{ $vote->id }})" href="javascript:;">
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

                @if($votes->total() > $no_of_records)
                <div class="flex flex-col justify-between space-y-4 px-4 py-4 sm:flex-row sm:items-center sm:space-y-0 sm:px-5">
                    
                    <div class="flex items-center space-x-2 text-xs+">
                        <span>Show</span>
                        <label class="block">
                        <select wire:model="no_of_records" class="form-select rounded-full border border-slate-300 bg-white px-2 py-1 pr-6 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent">
                            <option>10</option>
                            <option>30</option>
                            <option>50</option>
                        </select>
                        </label>
                        <span>entries</span>
                    </div>
                    
                    
                    <div class="text-xs+ text-center">
                        {{ $votes->currentpage() }} - {{ $votes->currentpage() * $votes->perpage() }} 
                        of {{ $votes ->total() }} entries
                    </div>
                </div>
                <div class="grid  place-items-center">
                    {{ $votes->links('components.pagination_links') }}
                </div>
                @endif
            </div>
            
        </div>
    </div>

    <x-delete_notification />
</div> 
