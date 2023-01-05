<div>
    <div class="flex items-center space-x-4 py-5 lg:py-6">
        <h2 class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl">
          {{ $academic_session->duration }} Student Records
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
          <li>Academic Records</li>
        </ul>
    </div>

    <x-display_alert :message="$notification_message" />

    <div x-data="{isFilterExpanded:false}">
        <div class="flex items-center justify-between">
            <h2 class="text-base font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100">
                Academic Records Table
            </h2>
            <div class="flex">
                <div class="flex items-center" x-data="{isInputActive:false}">
                <label class="block">
                    <input wire:model.debounce="search" x-effect="isInputActive === true &amp;&amp; $nextTick(() => { $el.focus()});" :class="isInputActive ? 'w-32 lg:w-48' : 'w-0'" class="form-input bg-transparent px-1 text-right transition-all duration-100 placeholder:text-slate-500 dark:placeholder:text-navy-200 w-0" placeholder="Search here..." type="text">
                </label>
                <button @click="isInputActive = !isInputActive" class="btn h-8 w-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
                </div>

                <button @click="isFilterExpanded = !isFilterExpanded" class="btn h-8 w-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M18 11.5H6M21 4H3m6 15h6"></path>
                </svg>
                </button>
            </div>
        </div>

        <div x-show="isFilterExpanded" x-collapse="" hidden="">
            <div class="py-3">
            <div class="grid grid-cols-4 gap-4 sm:grid-cols-4 sm:gap-5 ">
                <label class="block">
                    <span>From:</span>
                    <div class="relative mt-1.5 flex">
                        <input x-init="$el._x_flatpickr = flatpickr($el)" class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent flatpickr-input" placeholder="Choose start date..." type="text" readonly="readonly" wire:model="from_date">
                        <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-colors duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        </span>
                    </div>
                </label>
                <label class="block">
                    <span>To:</span>
                    <div class="relative mt-1.5 flex">
                        <input x-init="$el._x_flatpickr = flatpickr($el)" class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent flatpickr-input" placeholder="Choose start date..." type="text" readonly="readonly" wire:model="to_date">
                        <div class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-colors duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        </div>
                    </div>
                </label>
                <div class="sm:col-span-2">
                    <div class=" grid grid-cols-1 gap-4 sm:grid-cols-3 sm:gap-5 lg:gap-6">
                        <label class="block">
                            <span>Academic Session</span>
                            <select wire:model="selected_academic_session_id"
                              class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent"
                            >
                              <option value="">Select session</option>
                              @foreach($academic_sessions as $year)
                                <option value="{{ $year->id }}">{{ $year->duration }}</option>
                              @endforeach
                            </select>
                        </label>
                        <label class="block">
                            <span>Level </span>
                            <select wire:model="level"
                              class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent"
                            >
                              <option value="">Select level</option>
                              @foreach(config('app.levels') as $level)
                                <option >{{ $level }}Level</option>
                              @endforeach
                            </select>
                        </label>
                        <label class="block">
                            <span>Dues Status</span>
                            <select wire:model="has_paid"
                              class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent"
                            >
                              <option value="">Select Status</option>
                              <option value="1">Paid</option>
                              <option value="0">Unpaid</option>
                            </select>
                        </label>
                    </div>
                </div>
            </div>
            <div class="mt-4 space-x-1 text-right">
                <button @click="isFilterExpanded = false; $wire.resetParameters()" class="btn bg-error font-medium text-white hover:bg-error-focus focus:bg-error-focus active:bg-error-focus/90 ">
                Reset
                </button>
            </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="is-scrollbar-hidden min-w-full overflow-x-auto" x-data="pages.tables.initExample1">
            <table class="is-hoverable w-full text-left">
                <thead>
                    <tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
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
                            Dues
                        </th>
                        <th
                            class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5"
                        >
                            Amount
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
                        <tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                {{ ($students->currentpage()-1) * $students->perpage() + $loop->index + 1 }}
                            </td>
                            <td  class="px-3 py-3 font-medium text-slate-700 dark:text-navy-100 lg:px-5">
                                <a href=" route('admin.student.profile', ['student' => $student->id ]) }}" > 
                                    {{ optional($student->user)->full_name }}
                                </a>
                            </td>
                            <td  class="whitespace-nowrap px-4 py-3 sm:px-5">
                                {{ optional($student->user)->gender }} 
                            </td>
                           
                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                {{ optional($student->user)->reg_no }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                {{ $student->level }}Level
                            </td>
                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                <div class="badge bg-{{ $student->paid ? 'success':  'error'}}/10 text-{{ $student->paid ? 'success':  'error'}} dark:bg-{{ $student->paid ? 'success':  'error'}}/15">
                                    {{ $student->paid ? 'Paid':  'Not Paid'}} 
                                </div>
                            </td>
                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                &#8358;{{ number_format($student->dues) }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                {{ $student->created_at->format('d-m-Y') }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                <div class="flex justify-center items-center">
                                    <a wire:click.prevent="showDeleteNotification({{ $student->id }})" class="flex items-center text-danger" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="trash-2" data-lucide="trash-2" class="lucide lucide-trash-2 w-4 h-4 mr-1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg> Delete
                                    </a>
                                </div>
                                
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

            {{ $students->links('components.pagination_links') }}

            <div class="text-xs+">
                {{ $students ->currentpage() }} - {{ $students ->currentpage() * $students ->perpage() }} 
                of {{ $students ->total() }} entries
            </div>
            </div>
        </div>
    </div>
    
    <x-delete_notification />

</div>
