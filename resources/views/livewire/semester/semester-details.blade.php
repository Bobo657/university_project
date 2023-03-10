<div>
    <div class="mt-6 flex flex-col items-center justify-between space-y-2 text-center sm:flex-row sm:space-y-0 sm:text-left">
        <div>
            <h3 class="text-xl font-semibold text-slate-700 dark:text-navy-100">
            {{ $semester->duration}} Semester   
            </h3>
        </div>
        <div>
            @if($students->count() == 0)
            <button wire:click.prevent="startStudentsEnrollment()" class="btn space-x-2 bg-primary font-medium text-white shadow-lg shadow-primary/50 hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:shadow-accent/50 dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                <span>Start Students Enrollment </span>
            </button>
            @endif

            @if($students->count() > 0 && $semester->current == 1)
            <button wire:click.prevent="setSemesterToCompleted({{ $semester->id }})" class="btn space-x-2 bg-info font-medium text-white shadow-lg shadow-info/50 hover:bg-info-focus focus:bg-info-focus active:bg-info-focus/90 dark:bg-accent dark:shadow-accent/50 dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none"  class="h-4 w-4" viewBox="0 0 24 24" width="24" height="24">
                    <path stroke="currentColor" d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z"/>
                    </svg>
                <span>Mark as completed </span>
            </button>
            @endif  

            @if($students->total()  == 0)
            <button wire:click.prevent="confirmDeleteSemeter({{$semester->id}})" class="btn space-x-2 bg-error font-medium text-white shadow-lg shadow-error/50 hover:bg-error-focus focus:bg-error-focus active:bg-error-focus/90 dark:bg-accent dark:shadow-accent/50 dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                <span>Delete Semester </span>
            </button>
            @endif
        </div>
    </div>

    <div class="mt-4 grid grid-cols-12 gap-4 transition-all duration-[.25s] sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6">
        <div class="col-span-12 lg:col-span-4" wire:ignore>
            <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 sm:gap-5 lg:grid-cols-2" wire;ignore>
                <div class="rounded-lg bg-slate-150 p-4 dark:bg-navy-700">
                    <div class="flex justify-between space-x-1">
                        <p
                        class="text-xl font-semibold text-slate-700 dark:text-navy-100"
                        >
                        {{  number_format($stats->total_students) }}
                        </p>
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 text-error"
                            fill="none"
                            viewbox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                            >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"
                            />
                        </svg>
                    </div>
                    <p class="mt-1 text-xs+">Total Students</p>
                </div>
                <div class="rounded-lg bg-slate-150 p-4 dark:bg-navy-700">
                    <div class="flex justify-between">
                        <p
                        class="text-xl font-semibold text-slate-700 dark:text-navy-100"
                        >
                        {{  number_format($stats->male_students) }}
                        </p>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-success" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path fill="#000" d="M12,2c-4.41,0-8,3.59-8,8s3.59,8,8,8s8-3.59,8-8S16.41,2,12,2z M12,16c-2.76,0-5-2.24-5-5s2.24-5,5-5s5,2.24,5,5S14.76,16,12,16z"></path>
                            <circle fill="#000" cx="12" cy="8" r="2"></circle>
                        </svg>
                    </div>
                    <p class="mt-1 text-xs+">Male Students</p>
                </div>
                <div class="rounded-lg bg-slate-150 p-4 dark:bg-navy-700">
                <div class="flex justify-between">
                    <p
                    class="text-xl font-semibold text-slate-700 dark:text-navy-100"
                    >
                    {{  number_format($stats->female_students) }}
                    </p>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-6 w-6 text-warning" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="8" r="7"></circle>
                        <path d="M16.2839 15.9556C14.4567 17.7828 11.5433 17.7828 9.71613 15.9556M7.50539 13.7449C6.15421 15.0961 6.15421 17.1758 7.50539 18.527C8.85657 19.8782 10.9363 19.8782 12.2874 18.527M12.2874 18.527C13.6386 19.8782 15.7183 19.8782 17.0695 18.527M16.2839 15.9556C17.6351 14.6044 17.6351 12.5247 16.2839 11.1735C14.9327 9.82236 12.853 9.82236 11.5018 11.1735M16.2839 15.9556C17.106 14.1337 16.4565 11.9752 14.6345 11.1532C12.8126 10.3311 10.6541 10.9807 9.83198 12.8027M9.71613 15.9556C8.89402 14.1337 9.54355 11.9752 11.3655 11.1532C13.1874 10.3311 15.3459 10.9807 16.168 12.8027"></path>
                    </svg>
                </div>
                <p class="mt-1 text-xs+">Female Students</p>
                </div>
                <div class="rounded-lg bg-slate-150 p-4 dark:bg-navy-700">
                <div class="flex justify-between">
                    <p
                    class="text-xl font-semibold text-slate-700 dark:text-navy-100"
                    >
                    {{  number_format($stats->debtors) }}
                    </p>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-info" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
               
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm.5-11h-1v5h1V9zm0 6h-1v1h1v-1z"></path>
                    </svg>
                </div>
                <p class="mt-1 text-xs+">Student Debtors</p>
                </div>
            </div>

            @livewire('semester.semester-level-dues', ['semester' => $semester->id])
        </div>
       
        <div class="col-span-12 lg:col-span-8">
            @if (session()->has('enrollement'))
            <div class="bg-info/10 border-t-4 border-info rounded-b text-info px-4 py-3 shadow-md" role="alert">
                <div class="flex">
                    <div class="py-1">
                        <svg class="fill-current h-6 w-6 text-info mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                    <div>
                    <p class="font-bold">Students Enrollment completed </p>
                    @if($noOfGraduated > 0)
                        <p class="text-sm">{{ number_format($noOfGraduated) }} students was marked as graduated.</p>
                    @endif
                    @if($noOfGraduated > 0)
                        <p class="text-sm">{{ number_format($noOfEnrolled) }} students was enrolled into the new semester.</p>
                    @endif
                    </div>
                </div>
            </div>
            @endif

            <div class="col-span-12">
                <div class="flex items-center justify-between">
                    <h2 class="text-base font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100">
                    Students List
                    </h2>
                    <div class="flex">
                        <select wire:model="level" class="form-select mt-1.5 rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent">
                            <option value="">All levels</option>
                            @foreach($levels as $level)
                            <option>{{ $level }} </option>
                            @endforeach
                        </select>

                        <select wire:model="has_paid" class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent">
                            <option value="">select dues status</option>
                            <option value="1">Paid</option>
                            <option value="0">Not Paid</option>
                           
                        </select>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="is-scrollbar-hidden min-w-full overflow-x-auto">
                        <table class="is-hoverable w-full text-left">
                        <thead>
                            <tr>
                                <th class="whitespace-nowrap rounded-tl-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                    Reg No
                                </th>
                                <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                    Date
                                </th>
                                <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                    Name
                                </th>
                                <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                    Level
                                </th>
                                <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                    Dues
                                </th>
                                <th class="whitespace-nowrap rounded-tr-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($students as $student)
                            <tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                    <p class="font-medium text-primary dark:text-accent-light">
                                        {{ optional($student->user)->reg_no }}
                                    </p>
                                </td>
                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                    <p class="font-medium">{{ $student->created_at->format('d M Y') }}</p>
                                    <p class="mt-0.5 text-xs">{{ $student->created_at->format('h:i A') }}</p>
                                </td>
                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                    <div class="flex items-center space-x-4">
                                        <div class="avatar h-9 w-9">
                                            <img class="mask is-squircle" src="{{ $student->user->profile_photo_path }}" alt="avatar">
                                        </div>
                                        <a href="{{ optional($student->user)->path ?? '#' }}">
                                            <span class="font-medium text-slate-700 dark:text-navy-100">
                                                {{ optional($student->user)->full_name }}
                                            </span>
                                        </a>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                    <p class=" text-xs+">
                                        {{ $student->level }}Level
                                    </p>
                                </td>
                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                    <div class="badge bg-{{ $student->paid ? 'success':  'error'}}/10 text-{{ $student->paid ? 'success':  'error'}} dark:bg-{{ $student->paid ? 'success':  'error'}}/15">
                                        {{ $student->paid ? 'Paid':  'Not Paid'}} 
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-4 py-3 sm:px-5 text-error">
                                    <a href="javascript:;" wire:click.prevent="confirmDeleteRecord({{ $student->id }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="x" data-lucide="x" class="lucide lucide-x block mx-auto"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                    </a>
                                    
                                </td>
                            </tr>
                            @empty
                            <tr  class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
                                <td colspan="6" class="whitespace-nowrap px-4 py-3 sm:px-5"> 
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
        </div>
    </div>

    <x-delete_notification />
</div>
