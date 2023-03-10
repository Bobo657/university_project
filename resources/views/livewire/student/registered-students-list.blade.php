<div>
    <div class="flex items-center space-x-4 py-5 lg:py-6">
        <h2 class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl">
          Registered Students
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
          <li>Students</li>
        </ul>
    </div>

    <div class="grid grid-cols-2 gap-3 sm:grid-cols-4 sm:gap-5 sm:my-1.5" wire:ignore>
        <div class="rounded-lg bg-slate-100 p-4 dark:bg-navy-600">
            <div class="flex justify-between space-x-1">
            <p class="text-xl font-semibold text-slate-700 dark:text-navy-100">
                {{ number_format($stats->total_students) }}
            </p>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary dark:text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 00-3-3.87"></path><path d="M16 3.13a4 4 0 010 7.75"></path>
                </svg>
            </div>
            <p class="mt-1 text-xs+">Total Students</p>
        </div>
        <div class="rounded-lg bg-slate-100 p-4 dark:bg-navy-600">
            <div class="flex justify-between">
            <p class="text-xl font-semibold text-slate-700 dark:text-navy-100">
                {{ number_format($stats->male_students) }}
            </p>
            
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-success" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path fill="#000" d="M12,2c-4.41,0-8,3.59-8,8s3.59,8,8,8s8-3.59,8-8S16.41,2,12,2z M12,16c-2.76,0-5-2.24-5-5s2.24-5,5-5s5,2.24,5,5S14.76,16,12,16z"/>
                <circle fill="#000" cx="12" cy="8" r="2"/>
            </svg>
            </div>
            <p class="mt-1 text-xs+">Male Students</p>
        </div>
        <div class="rounded-lg bg-slate-100 p-4 dark:bg-navy-600">
            <div class="flex justify-between">
            <p class="text-xl font-semibold text-slate-700 dark:text-navy-100">
                {{ number_format($stats->total_students - $stats->male_students) }}
            </p>
           
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-8 w-8 text-warning" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="8" r="7" />
                <path d="M16.2839 15.9556C14.4567 17.7828 11.5433 17.7828 9.71613 15.9556M7.50539 13.7449C6.15421 15.0961 6.15421 17.1758 7.50539 18.527C8.85657 19.8782 10.9363 19.8782 12.2874 18.527M12.2874 18.527C13.6386 19.8782 15.7183 19.8782 17.0695 18.527M16.2839 15.9556C17.6351 14.6044 17.6351 12.5247 16.2839 11.1735C14.9327 9.82236 12.853 9.82236 11.5018 11.1735M16.2839 15.9556C17.106 14.1337 16.4565 11.9752 14.6345 11.1532C12.8126 10.3311 10.6541 10.9807 9.83198 12.8027M9.71613 15.9556C8.89402 14.1337 9.54355 11.9752 11.3655 11.1532C13.1874 10.3311 15.3459 10.9807 16.168 12.8027" />
            </svg>
            </div>
            <p class="mt-1 text-xs+">Female Studennts</p>
        </div>
        <div class="rounded-lg bg-slate-100 p-4 dark:bg-navy-600">
            <div class="flex justify-between">
            <p class="text-xl font-semibold text-slate-700 dark:text-navy-100">
                {{ number_format($stats->total_students - $stats->verified_students) }}
            </p>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-info" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
               
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm.5-11h-1v5h1V9zm0 6h-1v1h1v-1z"/>
            </svg>
            </div>
            <p class="mt-1 text-xs+">Unverified Students</p>
        </div>
    </div>

    <div x-data="{isFilterExpanded:false}">
        <div class="grid grid-cols-2 gap-4 sm:grid-cols-4 sm:gap-5 ">
            <label class="block">
                <span>Search</span>
                <input wire:model="search" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Enter search" type="text">
            </label>
            <label class="block">
                <span>From:</span>
                <div class="relative mt-1.5 flex">
                    <input x-init="$el._x_flatpickr = flatpickr($el)" class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent flatpickr-input" placeholder="Choose start date..." type="text" readonly="readonly" wire:model="fromDate">
                    <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-colors duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    </span>
                </div>
            </label>
            <label class="block" x-data="{ fromDate : 2023-02-07 }">
                <span>To:</span>
                <div class="relative mt-1.5 flex">
                    <input x-init="$el._x_flatpickr = flatpickr($el,{minDate: 'fromDate' })" class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent flatpickr-input" placeholder="Choose start date..." type="text" readonly="readonly" wire:model="toDate">
                    <div class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-colors duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    </div>
                </div>
            </label>
            <label class="block">
                <span>Gender</span>
                <select wire:model="gender"
                  class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent"
                >
                  <option value="">Select gender</option>
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                </select>
            </label>
            <label class="block">
                <span>Email Verification</span>
                <select wire:model="emailVerification" class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent"
                >
                  <option value="">Select Status</option>
                  <option value="0">Unverified</option>
                  <option value="1">Verified</option>
                </select>
            </label>
            <label class="block">
                <span>Status</span>
                <select wire:model="active"
                  class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent"
                >
                  <option value="">Select account status</option>
                  <option value="1">Active</option>
                  <option value="0">Inactive</option>
                </select>
            </label>
            <div class="inline-space mt-5 flex flex-wrap">
                <button wire:click="resetParameters()" class="btn font-medium text-error hover:bg-error/20 focus:bg-error/20 active:bg-error/25  mt-2">
                Reset
                </button>
            </div>
        </div>

        <div class="flex items-center justify-between">
            <h2 class="text-base font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100">
                Students Table
            </h2>
        </div> 
        <div class="card mt-3">
            <div class="is-scrollbar-hidden min-w-full overflow-x-auto" x-data="pages.tables.initExample1">
            <table class="is-hoverable w-full text-left">
                <thead>
                    <tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500 bg-slate-200">
                        <th
                        class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5"
                        >
                        #
                        </th>
                        <th
                        class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5"
                        >
                        Name
                        </th>
                        <th
                        class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5"
                        >
                        Sex
                        </th>
                        <th
                        class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5"
                        >
                        Phone
                        </th>
                        <th
                            class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5"
                        >
                            Reg No
                        </th>
                        <th
                            class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5"
                        >
                            Level
                        </th>
                        <th
                            class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5"
                        >
                            Email  
                        </th>
                        <th
                            class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5"
                        >
                            Debt
                        </th>
                        <th
                            class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5"
                        >
                            Status
                        </th>
                        <th
                            class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5"
                        >
                            Date
                        </th>
                        <th class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5">   
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $student)
                        <tr @class(['bg-slate-100' => $student->graduated]) class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                {{ ($students->currentpage()-1) * $students->perpage() + $loop->index + 1 }}
                            </td>
                            <td  class="px-3 py-3 font-medium text-slate-700 dark:text-navy-100 lg:px-5">
                                <div class="flex items-center space-x-4">
                                    <div class="avatar h-9 w-9">
                                        <img class="mask is-squircle" src="{{ $student->profile_photo_path }}" alt="avatar">
                                    </div>
                                    <span class="font-medium text-slate-700 dark:text-navy-100">
                                        <a href="{{ $student->path }}"> 
                                            {{ $student->full_name }} 
                                        </a>
                                    </span>
                                </div>
                            </td>
                            <td  class="whitespace-nowrap px-4 py-3 sm:px-5">
                                {{ $student->gender }} 
                            </td>
                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                {{ $student->phone }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                {{ $student->reg_no }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                            {{ optional($student->last_level)->level }}Level
                            </td>
                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                <div class="badge space-x-2.5 px-0 text-{{ $student->email_verified_at ? 'success' : 'error'}}">
                                    <div class="h-2 w-2 rounded-full bg-current"></div>
                                    <span>{{ $student->email_verified_at ? 'Verified' : 'Not Verified'}}</span>
                                </div>
                            </td>
                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                            &#8358;{{ number_format($student->total_debt) }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                <label class="inline-flex items-center">
                                <input {{ $student->active ? "checked": "" }} wire:click="toggleStatus({{$student->id}})"
                                    class="form-switch h-4 w-8 rounded-full bg-slate-300 before:rounded-full before:bg-slate-50 checked:bg-primary checked:before:bg-white dark:bg-navy-900 dark:before:bg-navy-300 dark:checked:bg-accent dark:checked:before:bg-white" type="checkbox" 
                                />  
                                </label>
                            </td>
                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                            {{ $student->created_at->format('d-m-Y') }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                <a wire:click.prevent="confirmDelete({{ $student->id }})" class="flex items-center text-error" href="javascript:;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="trash-2" data-lucide="trash-2" class="lucide lucide-trash-2 w-4 h-4 mr-1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg> Delete
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr  class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
                        <td colspan="9" class="whitespace-nowrap px-4 py-3 sm:px-5"> 
                            <div class="flex justify-center items-center"> 
                            <span class="text-cool-gray-600 text"> No record found </span>
                            </div>
                        </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            </div>

            @if($students->total()  > $noOfRecords)
            <div class="flex flex-col justify-between space-y-4 px-4 py-4 sm:flex-row sm:items-center sm:space-y-0 sm:px-5">
                <div class="flex items-center space-x-2 text-xs+">
                    <span>Show</span>
                    <label class="block">
                    <select wire:model="noOfRecords" class="form-select rounded-full border border-slate-300 bg-white px-2 py-1 pr-6 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent">
                        <option>10</option>
                        <option>30</option>
                        <option>50</option>
                    </select>
                    </label>
                    <span>entries</span>
                </div>

                {{ $students->links('components.pagination_links') }}

                <div class="text-xs+">
                    {{ $students ->currentpage() }} - {{ $students->currentpage() * $students->perpage() }} 
                    of {{ $students ->total() }} entries
                </div>
            </div>
            @endif
        </div>
    </div> 

    <x-delete_notification />
</div>
