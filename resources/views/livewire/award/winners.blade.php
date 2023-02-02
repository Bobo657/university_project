<div class="mt-4 sm:mt-5 lg:mt-6 min-w-full col-span-12">
    <div class="flex items-center justify-between">
      <h2 class="text-base font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100">
        Award Winners
      </h2>
    </div>
    <div class="card mt-3">
      <div class="is-scrollbar-hidden min-w-full overflow-x-auto">
        <table class="is-hoverable w-full text-left">
          <thead>
            <tr>
              <th class="whitespace-nowrap rounded-tl-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                Award
              </th>
              <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                Winner
              </th>
            </tr>
          </thead>
          <tbody>
            @forelse($winners as $winner)
            <tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
              
              <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                <p>{{ $winner->contestantable->award }}</p>
              </td>
              <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                <p class="font-semibold"> {{ $winner->user->fullname }}</p>
              </td>
            </tr>
            @empty
            <tr  class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
                <td colspan="2" class="whitespace-nowrap px-4 py-3 sm:px-5"> 
                    <div class="flex justify-center items-center"> 
                    <span class="text-cool-gray-600  font-medium text-slate-700 dark:text-navy-100"> No record found </span>
                    </div>
                </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
</div>
