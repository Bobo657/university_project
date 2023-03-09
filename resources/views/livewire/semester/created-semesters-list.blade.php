<div class="col-span-12">
    <div class="flex items-center justify-between">
      <h2 class="text-base font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100">
        Semseter Table
      </h2>
     
    </div>
    
    <div class="card mt-3">
      <div class="is-scrollbar-hidden min-w-full overflow-x-auto">
        <table class="is-hoverable w-full text-left">
          <thead>
            <tr>
              <th
                class="whitespace-nowrap rounded-tl-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
              >
                Semester
              </th>
              <th
                class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
              >
                Students
              </th>
              <th
                class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
              >
                Paid
              </th>
              <th
              class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
                >
                Status
              </th>
              <th
                class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
              >
                Contestants
              </th>
              <th
                class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
              >
                Voters
              </th>
              <th
                class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
              >
                Total
              </th>
              <th
                class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
              >
                 Income
              </th>
              <th
                class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
              >
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
                    {{ number_format($semester->students_sum_amount)   }}
                    </p>
                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                  <p  class="font-medium dark:text-accent-light text-center">
                    {{ number_format($semester->students_sum_amount - $semester->student_debtors_sum_amount) }}
                  </p>
                </td>

                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                    <p class="text-sm font-medium dark:text-navy-100 text-center">
                      {{ number_format($semester->student_debtors_sum_amount)  }}
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