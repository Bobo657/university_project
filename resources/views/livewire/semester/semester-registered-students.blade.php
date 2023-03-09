<div>
    <div class="flex items-center space-x-4 py-5 lg:py-6">
        <h2 class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl">
         Semesters Student Records
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
          <li>Semesters Registrations</li>
        </ul>
    </div>

    <div class="py-3">
        <div class="grid grid-cols-4 gap-4 sm:grid-cols-4 sm:gap-5 ">
            <label class="block">
                <span>Search</span>
                <input wire:model="search" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Enter search" type="text">
            </label>
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
            <label class="block">
                <span>Academic Semester</span>
                <select wire:model="selected_semester_id"
                    class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent"
                >
                    <option value="">Select semester</option>
                    @foreach($semesters as $semester)
                    <option value="{{ $semester->id }}">{{ $semester->duration }}</option>
                    @endforeach
                </select>
            </label>
            <label class="block">
                <span>Level </span>
                <select wire:model="level" class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent"
                >
                    <option value="">Select level</option>
                    @foreach($levels as $level)
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
            <div class="inline-space mt-5 flex flex-wrap">
                <button wire:click="resetParameters()" class="btn font-medium text-error hover:bg-error/20 focus:bg-error/20 active:bg-error/25  mt-2">
                Reset
                </button>
            </div>
        </div>
    </div>

    <div x-data="{isFilterExpanded:false}">
        <div class="flex items-center justify-between">
            <h2 class="text-base font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100">
              Academic Semester Table
            </h2>
        </div>


        <div class="card mt-3">
            <div class="is-scrollbar-hidden min-w-full overflow-x-auto" x-data="pages.tables.initExample1">
            <table class="is-hoverable w-full text-left is-zebra">
                <thead>
                    <tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
                        <th class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5">
                        # 
                        </th>
                        <th class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5"
                        >
                        Name
                        </th>
                        <th class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5"
                        >
                        Sex
                        </th>
                        <th
                        class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5"
                        >
                        Year
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
                                <div class="flex items-center space-x-4">
                                    <div class="avatar h-9 w-9">
                                        <img class="mask is-squircle" src="{{  optional($student->user)->profile_photo_path }}" alt="avatar">
                                    </div>
                                    <span class="font-medium text-slate-700 dark:text-navy-100">
                                        <a href="{{ optional($student->user)->path }}" > 
                                            {{ optional($student->user)->full_name }}
                                        </a>
                                    </span>
                                </div>
                            </td>
                            <td  class="whitespace-nowrap px-4 py-3 sm:px-5">
                                {{ optional($student->user)->gender }} 
                            </td>
                            <td  class="whitespace-nowrap px-4 py-3 sm:px-5">
                                {{ optional($student->semester)->duration }} 
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
                                &#8358;{{ number_format($student->amount) }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                {{ $student->created_at->format('d F, Y') }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                <div class="flex justify-center items-center">
                                    <a wire:click.prevent="confirmDelete({{ $student->id }})" class="flex items-center text-error" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal">
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

            @if($students->count() > $no_of_records)
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
            @endif
        </div>
    </div>

    <x-delete_notification />
</div>
