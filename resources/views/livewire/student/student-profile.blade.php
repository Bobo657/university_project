<div class="mt-4 grid grid-cols-12 gap-4 sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6">
    <div class="col-span-12 lg:col-span-4 xl:col-span-3">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 sm:gap-5 lg:grid-cols-1 lg:gap-6">
          <div class="rounded-lg bg-info/10 px-4 pb-5 dark:bg-navy-800 sm:px-5">
            
            <div class="space-y-4 mt-4">
              <div class="flex justify-between">
                <div class="avatar h-16 w-16">
                  <img class="rounded-full" src="{{ $student->profile_photo_path}}" alt="image">
                </div>
               
              </div>
              <div>
                <h3 class="text-lg font-medium text-slate-700 dark:text-navy-100">
                 {{ $student->fullname }}
                </h3>
                <p class="text-xs text-slate-400 dark:text-navy-300">
                    {{ $student->reg_no }}
                </p>
              </div>
              <div class="space-y-3 text-xs+">
                <div class="flex justify-between">
                    <p class="font-medium text-slate-700 dark:text-navy-100">
                      Graduated
                    </p>
                    <p class="text-right"> {{ $student->graduated ? 'Yes' : 'No' }}</p>
                  </div>
                <div class="flex justify-between">
                  <p class="font-medium text-slate-700 dark:text-navy-100">
                    D.O.B.
                  </p>
                  <p class="text-right"> {{ $student->dob }}</p>
                </div>
                <div class="flex justify-between">
                  <p class="font-medium text-slate-700 dark:text-navy-100">
                    Phone
                  </p>
                  <p class="text-right"> {{ $student->phone }}</p>
                </div>
                <div class="flex justify-between">
                  <p class="font-medium text-slate-700 dark:text-navy-100">
                    Email
                  </p>
                  <p class="text-right"> {{ $student->email }}</p>
                </div>
                <div class="flex justify-between">
                  <p class="font-medium text-slate-700 dark:text-navy-100">
                    Hobby
                  </p>
                  <p class="text-right"> {{ $student->hobby }}</p>
                </div>
                <div class="flex justify-between">
                  <p class="font-medium text-slate-700 dark:text-navy-100">
                    Register Date
                  </p>
                  <p class="text-right"> {{ $student->created_at->format('d M Y') }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <ol class="timeline line-space max-w-sm mt-5">
            @forelse($ballots as $ballot)
            <li class="timeline-item">
              <div class="timeline-item-point rounded-full bg-{{ !$ballot->winner ? "slate-300" : "primary" }} dark:bg-navy-400"></div>
              <div class="timeline-item-content flex-1 pl-4 sm:pl-8">
                <div class="flex flex-col justify-between pb-2 sm:flex-row sm:pb-0">
                  <p
                    class="pb-2 font-medium leading-none text-slate-600 dark:text-navy-100 sm:pb-0"
                  >
                    {{ $ballot->ballotable_type == 'award' ? 'Award Nominated' : 'Election Contested' }}
                  </p>
                  <span class="text-xs text-slate-400 dark:text-navy-300"
                    >{{ $ballot->created_at->diffForHumans() }}</span
                  >
                </div>
                <p class="py-1">{{ $ballot->ballotable->name }}</p>
              </div>
            </li>
            @empty

            @endforelse
            
        </ol>

        <div class="card px-4 pb-4 sm:px-5 mt-4">
            <div class="my-3 flex h-8 items-center justify-between">
              <h2 class="text-sm+ font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100">
                Account Setting
              </h2>
            </div>
           
            <div class="mt-4 space-y-3.5">
              <label class="flex items-center justify-between space-x-2">
                <span class="font-medium">Mark as graduated </span>
                <input wire:click="toggleGraduation" {{ $student->graduated ? 'checked' : '' }}  class="form-switch is-outline h-5 w-10 rounded-full border border-slate-400/70 bg-transparent before:rounded-full before:bg-slate-300 checked:!border-success checked:before:!bg-success dark:border-navy-400 dark:before:bg-navy-300" type="checkbox">
              </label>
              <label class="flex items-center justify-between space-x-2">
                <span class="font-medium">Change Status </span>
                <input wire:click="toggleStatus()" {{ $student->active ? 'checked' : '' }} class="form-switch is-outline h-5 w-10 rounded-full border border-slate-400/70 bg-transparent before:rounded-full before:bg-slate-300 checked:border-primary checked:before:bg-primary dark:border-navy-400 dark:before:bg-navy-300 dark:checked:border-accent dark:checked:before:bg-accent" type="checkbox">
              </label>
             
            </div>
          </div>
    </div>
    <div class="col-span-12 lg:col-span-8 xl:col-span-9">

      <div class="card col-span-12 lg:col-span-8 xl:col-span-9">
        <div class="mt-5 grid grid-cols-1 gap-4 px-4 sm:grid-cols-4 sm:px-5">
          <div class="relative flex flex-col overflow-hidden rounded-lg bg-gradient-to-br from-info to-info-focus p-3.5">
            <p class="text-xs uppercase text-sky-100">Total Dues</p>
            <div class="flex items-end justify-between space-x-2">
              <p class="mt-4 text-2xl font-medium text-white">&#8358;{{ number_format($registered_semesters->sum('amount')) }}</p>
             
            </div>
            <div class="mask is-reuleaux-triangle absolute top-0 right-0 -m-3 h-16 w-16 bg-white/20"></div>
          </div>
          <div class="relative flex flex-col overflow-hidden rounded-lg bg-gradient-to-br from-amber-400 to-orange-600 p-3.5">
            <p class="text-xs uppercase text-amber-50">Total Paid</p>
            <div class="flex items-end justify-between space-x-2">
              <p class="mt-4 text-2xl font-medium text-white">
                &#8358;{{ number_format($registered_semesters->where('paid', 1)->sum('amount')) }}
            </p>
             
            </div>
            <div class="mask is-diamond absolute top-0 right-0 -m-3 h-16 w-16 bg-white/20"></div>
          </div>
          <div class="relative flex flex-col overflow-hidden rounded-lg bg-gradient-to-br from-pink-500 to-rose-500 p-3.5">
            <p class="text-xs uppercase text-pink-100">Total Unpaid</p>
            <div class="flex items-end justify-between space-x-2">
              <p class="mt-4 text-2xl font-medium text-white">&#8358;{{ number_format($registered_semesters->where('paid', 0)->sum('amount')) }}</p>
              
            </div>
            <div class="mask is-hexagon-2 absolute top-0 right-0 -m-3 h-16 w-16 bg-white/20"></div>
          </div>
          <div class="rounded-lg bg-slate-100 p-4 dark:bg-navy-600">
            <div class="flex justify-between space-x-1">
              <p class="text-xl font-semibold text-slate-700 dark:text-navy-100">
                {{ number_format($votes->count())}}
              </p>
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary dark:text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path d="M14 9V5a3 3 0 00-3-3l-4 9v11h11.28a2 2 0 002-1.7l1.38-9a2 2 0 00-2-2.3zM7 22H4a2 2 0 01-2-2v-7a2 2 0 012-2h3"></path>
              </svg>
            </div>
            <p class="mt-1 text-xs+">Total Votes</p>
          </div>
        </div>

        <div class="scrollbar-sm mt-5 min-w-full overflow-x-auto">
          <table class="is-hoverable w-full text-left">
            <tbody>
            @forelse($registered_semesters as $semester)
            <tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                    <p class="font-medium text-slate-600 dark:text-navy-100">
                        {{ $semester->semester->duration }}
                    </p>  
                </td>
                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                    {{ $semester->level }}Level
                </td>
                {{-- 	DUES	AMOUNT	DATE --}}
                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                    &#8358;{{ number_format($semester->amount) }}
                </td>
                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                    <div class="badge space-x-2.5 text-{{ $semester->paid ? 'success' : 'error'}}  dark:text-{{ $semester->paid ? 'success' : 'error'}} -light">
                        <div class="h-2 w-2 rounded-full bg-current"></div>
                        <span>{{ $semester->paid ? 'Paid' : 'Pending'}} </span>
                      </div>
                </td>
                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                    {{ $semester->created_at->format('d M Y h:i A') }}
                </td>
            </tr>
            @empty
            @endforelse
            </tbody>
          </table>
        </div>
      </div>

      <div class="mt-4 sm:mt-5 lg:mt-6">
        <div class="card mt-3">
          <div class="is-scrollbar-hidden min-w-full overflow-x-auto">
            <table class="is-hoverable w-full text-left">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap rounded-tl-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5" colspan="4">
                            Votes
                        </th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($votes as $vote)
                    <tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
                        <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                            <div class="flex items-center space-x-4">
                                <div class="avatar h-9 w-9">
                                    <img class="rounded-full" src="{{ $vote->voteOwner->profile_photo_path  ?? 'n/a'}}" alt="avatar">
                                </div>
                                <a href="{{ $vote->voteOwner->path ?? '#' }}">
                                  <span class="font-medium text-slate-700 dark:text-navy-100">
                                      {{ $vote->voteOwner->full_name ?? 'n/a'}}
                                  </span>
                                </a>
                            </div>
                        </td>
                        <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                            {{ $vote->semester->duration ?? 'na' }}
                        </td>
                        <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                            {{ $vote->ballot->ballotable->name ?? 'na' }}
                        </td>
                        <td class="whitespace-nowrap px-4 py-3 font-medium text-slate-600 dark:text-navy-100 sm:px-5">
                            {{ $vote->created_at->format('d M Y h:i A')}}
                        </td>
                    </tr>
                @empty
                    
                @endforelse
                </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    
</div>