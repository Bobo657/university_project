<div class="col-span-12">
  <div class=" grid grid-cols-1 gap-4  sm:grid-cols-3 ">
    <div class="relative flex flex-col overflow-hidden rounded-lg bg-gradient-to-br from-info to-info-focus p-3.5">
      <p class="text-xs uppercase text-sky-100">Total Expected Dues</p>
      <div class="flex items-end justify-between space-x-2">
        <p class="mt-4 text-2xl font-medium text-white">
          &#8358;{{ number_format($semesters->sum('students_sum_amount')) }}
        </p>
      </div>
      <div class="mask is-reuleaux-triangle absolute top-0 right-0 -m-3 h-16 w-16 bg-white/20"></div>
    </div>
    <div class="relative flex flex-col overflow-hidden rounded-lg bg-gradient-to-br from-amber-400 to-orange-600 p-3.5">
      <p class="text-xs uppercase text-amber-50">Total Revenue</p>
      <div class="flex items-end justify-between space-x-2">
        <p class="mt-4 text-2xl font-medium text-white">
          &#8358;{{ number_format($semesters->sum('income')) }}
        </p>
      </div>
      <div class="mask is-diamond absolute top-0 right-0 -m-3 h-16 w-16 bg-white/20"></div>
    </div>
    <div class="relative flex flex-col overflow-hidden rounded-lg bg-gradient-to-br from-pink-500 to-rose-500 p-3.5">
      <p class="text-xs uppercase text-pink-100">Total Debt</p>
      <div class="flex items-end justify-between space-x-2">
        <p class="mt-4 text-2xl font-medium text-white">
          &#8358;{{ number_format($semesters->sum('student_debtors_sum_amount')) }}
        </p>
      </div>
      <div class="mask is-hexagon-2 absolute top-0 right-0 -m-3 h-16 w-16 bg-white/20"></div>
    </div>
  </div>
    <div class="flex items-center justify-between">
    
    <div class="card mt-3">
      <div class="is-scrollbar-hidden min-w-full overflow-x-auto">
        <table class="is-hoverable w-full text-left">
          <thead>
            <tr>
              <th class="whitespace-nowrap rounded-tl-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                Semester
              </th>
              <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                Students
              </th>
              <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                Paid
              </th>
              <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
                >
                Status
              </th>
              <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                Contestants
              </th>
              <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                Voters
              </th>
              <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                Total
              </th>
              <th
                class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                 Income
              </th>
              <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                 Debts
              </th>
              <th
                class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
              >
                Date
              </th>
            </tr>
          </thead>
          <tbody>
            @forelse($semesters as $semester)
              <tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                    <a href="{{ route('semester.details', ['semester' => $semester->id]) }}" class="font-medium text-primary dark:text-accent-light">
                      {{ $semester->duration }}
                    </a>
                </td>
                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                    <p class="font-medium text-center"> {{ $semester->students_count }} </p>
                </td>
                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                  <p class="font-medium text-center"> {{ $semester->students_paid_count }} </p>
                </td>
                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                    <div class="badge bg-{{$semester->color}}/10 text-{{$semester->color}} dark:bg-success/15">
                       {{ $semester->status }} 
                    </div>
                </td>
                <td class="whitespace-nowrap px-4 py-3 sm:px-5 text-center">
                    <span class="font-medium text-slate-700 dark:text-navy-100">
                      {{ number_format($semester->office_contestants_count) }} 
                    </span>
                </td>
                <td class="whitespace-nowrap px-4 py-3 sm:px-5 text-center">
                    <p  class="font-medium dark:text-accent-light">
                      {{ number_format($semester->votes_count) }}
                    </p>
                </td>
                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                  <p  class="font-medium dark:text-accent-light text-center">
                    &#8358;{{ number_format($semester->students_sum_amount)   }}
                  </p>
                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                  <p  class="font-medium dark:text-accent-light text-center">
                    &#8358;{{ number_format($semester->income) }}
                  </p>
                </td>
                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                    <p class="text-sm font-medium dark:text-navy-100 text-center">
                      &#8358; {{ number_format($semester->student_debtors_sum_amount)  }}
                    </p>
                </td>
                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                    <p class="font-medium">
                        {{ $semester->created_at->format('d F Y')}}
                    </p>
                </td>
               
              </tr>
            @empty
           
              <tr  class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
                  <td colspan="10" class="whitespace-nowrap px-4 py-3 sm:px-5"> 
                      <div class="flex justify-center items-center"> 
                      <span class="text-cool-gray-600 text"> No record found </span>
                      </div>
                  </td>
              </tr>
            @endforelse
            
          </tbody>
        </table>
      </div>
     
    </div>
</div>
</div>