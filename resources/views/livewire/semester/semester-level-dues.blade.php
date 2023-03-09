<div class="col-span-12">
                
    <div class="mt-4 flex h-2 space-x-1">
        @foreach($dues as $due)
      <div
        class="w-{{$due->ratio}}/12 rounded-full bg-{{$colors[$loop->index]}} dark:bg-accent"
        x-tooltip.{{$colors[$loop->index]}}="'{{$due->level}}Level'"
      ></div>
      @endforeach
    </div>

    <div class="is-scrollbar-hidden mt-4 min-w-full overflow-x-auto">
      <table class="w-full font-inter">
        <tbody>
          @foreach($dues as $due)
          <tr>
            <td class="whitespace-nowrap py-2">
              <div class="flex items-center space-x-2">
                <div class="h-3.5 w-3.5 rounded-full border-2 border-{{$colors[$loop->index]}} dark:border-accent"
                ></div>
                <p class="font-medium tracking-wide text-slate-700 dark:text-navy-100">
                  {{ $due->level }}Level
                </p>
              </div>
            </td>
            <td class="whitespace-nowrap py-2 text-right">
              <p class="font-medium text-slate-700 dark:text-navy-100">
                {{ number_format($due->students_count) }} 
              </p>
            </td>
            <td class="whitespace-nowrap py-2 text-right">{{ $due->percent }}%</td>
          </tr>
          @endforeach
          
        </tbody>
      </table>
    </div>

    <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 sm:gap-5 lg:grid-cols-2 mt-4">
        <div class="rounded-lg bg-slate-150 p-4 dark:bg-navy-700">
            <div class="flex justify-between space-x-1">
                <p class="text-xl font-semibold text-slate-700 dark:text-navy-100">
                  &#8358;{{ number_format($dues->sum('revenue')) }}
                </p>
                <svg width="26" height="26" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M16.5 4.5H7.5C6.67157 4.5 6 5.17157 6 6V18C6 18.8284 6.67157 19.5 7.5 19.5H16.5C17.3284 19.5 18 18.8284 18 18V6C18 5.17157 17.3284 4.5 16.5 4.5ZM9 9H15V10.5H9V9ZM9 12H15V13.5H9V12ZM9 15H12V16.5H9V15Z" fill="#008000"/>
                </svg>
            </div>
            <p class="mt-1 text-xs+">Total Revenue</p>
        </div>
        <div class="rounded-lg bg-slate-150 p-4 dark:bg-navy-700">
            <div class="flex justify-between">
                <p
                class="text-xl font-semibold text-slate-700 dark:text-navy-100"
                >
                &#8358;{{ number_format($dues->sum('debts')) }}
                </p>
                <svg viewBox="0 0 64 64" stroke="currentColor" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-success">
                    <path d="M32 0a32 32 0 1 0 0 64 32 32 0 0 0 0-64zm0 48a16 16 0 1 1 0-32 16 16 0 0 1 0 32z"/>
                    <path d="M32 24a1 1 0 0 0-1 1v12a1 1 0 0 0 2 0V25a1 1 0 0 0-1-1zM32 36a1 1 0 0 0-1 1v8a1 1 0 0 0 2 0v-8a1 1 0 0 0-1-1zM26 30a1 1 0 0 0-1 1v4a1 1 0 0 0 2 0v-4a1 1 0 0 0-1-1zM38 30a1 1 0 0 0-1 1v4a1 1 0 0 0 2 0v-4a1 1 0 0 0-1-1z"/>
                </svg>
            </div>
            <p class="mt-1 text-xs+">Total Outstanding</p>
        </div>
    </div>

    <div class="mt-4 sm:mt-5 lg:mt-6">
        <div class="flex items-center justify-between">
        <h2 class="text-base font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100">
            Semester Dues
        </h2>
        
        </div>
        <div class="card mt-3">
            <div class="is-scrollbar-hidden min-w-full overflow-x-auto">
            <table class="w-full text-left is-zebra">
                <thead>
                <tr>
                    <th class="whitespace-nowrap rounded-tl-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                    Level
                    </th>
                    <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                    Dues
                    </th>
                    <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                    Paid
                    </th>
                    <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                    Debts
                    </th>
                    <th class="whitespace-nowrap rounded-tr-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($dues as $due)
                <tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
                    <td class="whitespace-nowrap px-4 py-3 font-medium text-slate-600 dark:text-navy-100 sm:px-5">
                        {{ $due->level}}Level
                    </td>
                    <td class="whitespace-nowrap px-4 py-3 font-medium text-slate-600 dark:text-navy-100 sm:px-5">
                        &#8358;{{ number_format($due->amount) }}    
                    </td>
                    <td class="text-center whitespace-nowrap px-4 py-3 font-medium text-slate-600 dark:text-navy-100 sm:px-5">
                        &#8358;{{ number_format($due->revenue) }}    
                    </td>
                    <td class="text-center whitespace-nowrap px-4 py-3 font-medium text-slate-600 dark:text-navy-100 sm:px-5">
                        &#8358;{{  number_format($due->debts) }}    
                    </td>
                    <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                    
                    </td>
                </tr>
                @endforeach
                
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>