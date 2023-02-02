<div class="grid grid-cols-2 gap-3 sm:grid-cols-3 sm:gap-5 lg:grid-cols-2">
    <div class="rounded-lg bg-slate-150 p-4 dark:bg-navy-700">
      <div class="flex justify-between space-x-1">
        <p
          class="text-xl font-semibold text-slate-700 dark:text-navy-100"
        >
        {{ number_format($stats->total_students) }}
        </p>
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="h-5 w-5 text-primary dark:text-accent"
          fill="none"
          viewbox="0 0 24 24"
          stroke="currentColor"
          stroke-width="2"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
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
        {{ number_format($stats->verified_students) }}
        </p>
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="h-5 w-5 text-success"
          fill="none"
          viewbox="0 0 24 24"
          stroke="currentColor"
          stroke-width="2"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"
          />
        </svg>
      </div>
      
      <p class="mt-1 text-xs+">Verified Students</p>
    </div>
    <div class="rounded-lg bg-slate-150 p-4 dark:bg-navy-700">
      <div class="flex justify-between">
        <p
          class="text-xl font-semibold text-slate-700 dark:text-navy-100"
        >
        {{ number_format($stats->suspended_students) }}
        </p>
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="h-5 w-5 text-warning"
          fill="none"
          viewbox="0 0 24 24"
          stroke="currentColor"
          stroke-width="2"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
          />
        </svg>
      </div>
      <p class="mt-1 text-xs+">Suspened Students</p>
    </div>
    <div class="rounded-lg bg-slate-150 p-4 dark:bg-navy-700">
      <div class="flex justify-between">
        <p
          class="text-xl font-semibold text-slate-700 dark:text-navy-100"
        >
        {{ number_format($stats->graduated_students) }}
        </p>
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="h-5 w-5 text-info"
          fill="none"
          viewbox="0 0 24 24"
          stroke="currentColor"
          stroke-width="2"
        >
          <path
            d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"
          />
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"
          />
        </svg>
      </div>
      <p class="mt-1 text-xs+">Graduated Students</p>
    </div>
    <div class="rounded-lg bg-slate-150 p-4 dark:bg-navy-700">
      <div class="flex justify-between space-x-1">
        <p
          class="text-xl font-semibold text-slate-700 dark:text-navy-100"
        >
        {{ number_format($stats->total_students - $stats->female_students) }}
        </p>
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="h-5 w-5 text-secondary"
          fill="none"
          viewbox="0 0 24 24"
          stroke="currentColor"
          stroke-width="2"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"
          />
        </svg>
      </div>
      <p class="mt-1 text-xs+">Male Students</p>
    </div>
    <div class="rounded-lg bg-slate-150 p-4 dark:bg-navy-700">
      <div class="flex justify-between">
        <p
          class="text-xl font-semibold text-slate-700 dark:text-navy-100"
        >
        {{ number_format($stats->female_students) }}
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
      <p class="mt-1 text-xs+">Female Students</p>
    </div>
  </div>