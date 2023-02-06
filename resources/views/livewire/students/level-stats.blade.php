<div class="flex items-center justify-between mt-3">
  {{-- <div class="mt-4 flex h-2 space-x-1">
    <div
      class="w-5/12 rounded-full bg-primary dark:bg-accent"
      x-tooltip.primary="'Exellent'"
    ></div>
    <div
      class="w-2/12 rounded-full bg-success"
      x-tooltip.success="'Very Good'"
    ></div>
    <div
      class="w-2/12 rounded-full bg-info"
      x-tooltip.info="'Good'"
    ></div>

    <div
      class="w-2/12 rounded-full bg-warning"
      x-tooltip.warning="'Poor'"
    ></div>
    <div
      class="w-1/12 rounded-full bg-error"
      x-tooltip.error="'Very Poor'"
    ></div>
  </div>

  <div class="is-scrollbar-hidden mt-4 min-w-full overflow-x-auto">
    <table class="w-full font-inter">
       <thead>
         <tr>
            <td>Level</td>
            <td>Total Students</td>
            <td>Male</td>
            <td>Female</td>
         </tr>
      </thead>
      <tbody>
        @foreach ($levels as $record)
            <tr>
                <td class="whitespace-nowrap py-2">
                    <div class="flex items-center space-x-2">
                        <div
                        class="h-3.5 w-3.5 rounded-full border-2 border-{{ config('app.colors')[$record->level] }} dark:border-accent"
                        ></div>
                        <p
                        class="font-medium tracking-wide text-slate-700 dark:text-navy-100"
                        >
                        {{ $record->level }}Level
                        </p>
                    </div>
                </td>
                <td class="whitespace-nowrap py-2 text-center">
                        {{ number_format($record->total_students) }}
                </td>
                <td class="whitespace-nowrap py-2 text-center">
                        {{ number_format($record->male_students) }}
                </td>
                <td class="whitespace-nowrap py-2 text-center">
                        {{ number_format($record->female_students) }}
                </td>
                <td class="whitespace-nowrap py-2 text-center">42%</td>
            </tr>
        @endforeach
       
      </tbody>
    </table>
  </div> --}}
</div>