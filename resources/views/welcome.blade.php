@extends('layouts.app')
@section('content')

<div class="mt-6 flex flex-col items-center justify-between space-y-2 text-center sm:flex-row sm:space-y-0 sm:text-left">
  <div>
    <h3 class="text-xl font-semibold text-slate-700 dark:text-navy-100">
      Admin Dashboard
    </h3>
    <p class="mt-1 hidden sm:block">Recent meetings in your team</p>
  </div>
  <div>
    <p class="font-medium text-slate-700 dark:text-navy-100">
      Team Members
    </p>
    <div class="mt-2 flex space-x-2">
      <div class="avatar h-8 w-8">
        <img class="mask is-squircle" src="images/avatar/avatar-12.jpg" alt="avatar">
      </div>
      
    </div>
  </div>
</div>

<div class="mt-4 grid grid-cols-12 gap-4 transition-all duration-[.25s] sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6">
  
  <div class="col-span-12 lg:col-span-8">
    @livewire('semester.created-semesters-list')

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3 sm:gap-5 lg:gap-6 mt-4">
      <div class="card items-center justify-between lg:flex-row">
        <div class="flex flex-col items-center p-4 text-center sm:p-5 lg:flex-row lg:space-x-4 lg:text-left">
          <div class="avatar h-18 w-18 lg:h-12 lg:w-12">
            <img class="rounded-full" src="images/avatar/avatar-20.jpg" alt="avatar">
          </div>
          <div class="mt-2 lg:mt-0">
            <div class="flex items-center justify-center space-x-1">
              <h4 class="text-base font-medium text-slate-700 line-clamp-1 dark:text-navy-100">
                Konnor Guzman
              </h4>
              <button class="btn hidden h-6 rounded-full px-2 text-xs font-medium text-primary hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:text-accent-light dark:hover:bg-accent-light/20 dark:focus:bg-accent-light/20 dark:active:bg-accent-light/25 lg:inline-flex">
                Follow
              </button>
            </div>
            <p class="text-xs+">React Developer</p>
          </div>
          <button class="btn mt-4 rounded-full border border-slate-200 font-medium text-primary hover:bg-slate-150 focus:bg-slate-150 active:bg-slate-150/80 dark:border-navy-500 dark:text-accent-light dark:hover:bg-navy-500 dark:focus:bg-navy-500 dark:active:bg-navy-500/90 lg:hidden">
            Follow
          </button>
        </div>
        
      </div>
      <div class="card items-center justify-between lg:flex-row">
        <div class="flex flex-col items-center p-4 text-center sm:p-5 lg:flex-row lg:space-x-4 lg:text-left">
          <div class="avatar h-18 w-18 lg:h-12 lg:w-12">
            <img class="rounded-full" src="images/avatar/avatar-19.jpg" alt="avatar">
          </div>
          <div class="mt-2 lg:mt-0">
            <div class="flex items-center justify-center space-x-1">
              <h4 class="text-base font-medium text-slate-700 line-clamp-1 dark:text-navy-100">
                Travis Fuller
              </h4>
              <button class="btn hidden h-6 rounded-full px-2 text-xs font-medium text-primary hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:text-accent-light dark:hover:bg-accent-light/20 dark:focus:bg-accent-light/20 dark:active:bg-accent-light/25 lg:inline-flex">
                Follow
              </button>
            </div>
            <p class="text-xs+">Backend Developer</p>
          </div>
          <button class="btn mt-4 rounded-full border border-slate-200 font-medium text-primary hover:bg-slate-150 focus:bg-slate-150 active:bg-slate-150/80 dark:border-navy-500 dark:text-accent-light dark:hover:bg-navy-500 dark:focus:bg-navy-500 dark:active:bg-navy-500/90 lg:hidden">
            Follow
          </button>
        </div>
        
      </div>
    </div>

    <div class="card px-4 pb-4 sm:px-5 mt-3">
      <div class="my-3 flex h-8 items-center justify-between">
        <h2 class="font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100 lg:text-base">
          Ping &amp; Linespace
        </h2>
        <label class="inline-flex items-center space-x-2">
          <span class="text-xs text-slate-400 dark:text-navy-300">Code</span>
          <input @change="helpers.toggleCode" class="form-switch h-5 w-10 rounded-full bg-slate-300 before:rounded-full before:bg-slate-50 checked:bg-primary checked:before:bg-white dark:bg-navy-900 dark:before:bg-navy-300 dark:checked:bg-accent dark:checked:before:bg-white" type="checkbox">
        </label>
      </div>
      <div class="max-w-xl">
        <p>
          The timeline displays a list of events in chronological order.
          Check out code for detail of usage.
        </p>
        <div class="mt-5">
          <ol class="timeline line-space max-w-sm">
            <li class="timeline-item">
              <div class="timeline-item-point rounded-full bg-slate-300 dark:bg-navy-400"></div>
              <div class="timeline-item-content flex-1 pl-4 sm:pl-8">
                <div class="flex flex-col justify-between pb-2 sm:flex-row sm:pb-0">
                  <p class="pb-2 font-medium leading-none text-slate-600 dark:text-navy-100 sm:pb-0">
                    User Photo Changed
                  </p>
                  <span class="text-xs text-slate-400 dark:text-navy-300">12 minute ago</span>
                </div>
                <p class="py-1">John Doe changed his avatar photo</p>
              </div>
            </li>
            <li class="timeline-item">
              <div class="timeline-item-point rounded-full bg-accent dark:bg-accent"></div>
              <div class="timeline-item-content flex-1 pl-4 sm:pl-8">
                <div class="flex flex-col justify-between pb-2 sm:flex-row sm:pb-0">
                  <p class="pb-2 font-medium leading-none text-slate-600 dark:text-navy-100 sm:pb-0">
                    Video Added
                  </p>
                  <span class="text-xs text-slate-400 dark:text-navy-300">1 hour ago</span>
                </div>
                <p class="py-1">Mores Clarke added new video</p>
              </div>
            </li>
            <li class="timeline-item">
              <div class="timeline-item-point rounded-full bg-success">
                <span class="inline-flex h-full w-full animate-ping rounded-full bg-success opacity-80"></span>
              </div>
              <div class="timeline-item-content flex-1 pl-4 sm:pl-8">
                <div class="flex flex-col justify-between pb-2 sm:flex-row sm:pb-0">
                  <p class="pb-2 font-medium leading-none text-slate-600 dark:text-navy-100 sm:pb-0">
                    Design Completed
                  </p>
                  <span class="text-xs text-slate-400 dark:text-navy-300">3 hours ago</span>
                </div>
                <p class="py-1">
                  Robert Nolan completed the design of the CRM application
                </p>
              </div>
            </li>
            <li class="timeline-item">
              <div class="timeline-item-point rounded-full bg-warning"></div>
              <div class="timeline-item-content flex-1 pl-4 sm:pl-8">
                <div class="flex flex-col justify-between pb-2 sm:flex-row sm:pb-0">
                  <p class="pb-2 font-medium leading-none text-slate-600 dark:text-navy-100 sm:pb-0">
                    ER Diagram
                  </p>
                  <span class="text-xs text-slate-400 dark:text-navy-300">a day ago</span>
                </div>
                <p class="py-1">Team completed the ER diagram app</p>
              </div>
            </li>
            <li class="timeline-item">
              <div class="timeline-item-point rounded-full bg-error"></div>
              <div class="timeline-item-content flex-1 pl-4 sm:pl-8">
                <div class="flex flex-col justify-between pb-2 sm:flex-row sm:pb-0">
                  <p class="pb-2 font-medium leading-none text-slate-600 dark:text-navy-100 sm:pb-0">
                    Weekly Report
                  </p>
                  <span class="text-xs text-slate-400 dark:text-navy-300">a day ago</span>
                </div>
                <p class="py-1">The weekly report was uploaded</p>
              </div>
            </li>
          </ol>
        </div>
      </div>
    </div>

  </div>

  <div class="col-span-12 lg:col-span-4">
    <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 sm:gap-5 lg:grid-cols-2 mb-4">
      <div class="rounded-lg bg-slate-150 p-4 dark:bg-navy-700">
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
      <div class="rounded-lg bg-slate-150 p-4 dark:bg-navy-700">
        <div class="flex justify-between">
          <p
            class="text-xl font-semibold text-slate-700 dark:text-navy-100"
          >
            {{ number_format($stats->male_students) }}
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
          {{ number_format($stats->female_students) }}
          </p>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-8 w-8 text-secondary" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
          {{ number_format($stats->inactive_students) }}
          </p>
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-7 w-7 text-error"
            fill="none"
            viewbox="0 0 24 24"
            stroke="currentColor"
            stroke-width="2"
          >
          <path d="M16 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="18" y1="8" x2="23" y2="13"></line><line x1="23" y1="8" x2="18" y2="13"></line>
          </svg>
        </div>
        <p class="mt-1 text-xs+">Suspended Students</p>
      </div>
      <div class="rounded-lg bg-slate-150 p-4 dark:bg-navy-700">
        <div class="flex justify-between space-x-1">
          <p
            class="text-xl font-semibold text-slate-700 dark:text-navy-100"
          >
          {{ number_format($stats->unverified_students) }}
          </p>
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-7 w-7 text-warning"
            fill="none"
            viewbox="0 0 24 24"
            stroke="currentColor"
            stroke-width="2"
          >
          <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline>
          </svg>
          
        </div>
        <p class="mt-1 text-xs+">Unverified Accounts</p>
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
            class="h-7 w-7 text-success"
            fill="none"
            viewbox="0 0 24 24"
            stroke="currentColor"
            stroke-width="2"
          >
            <path d="M16 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><polyline points="17 11 19 13 23 9"></polyline>
          </svg>
        </div>
        <p class="mt-1 text-xs+">Graduated Students</p>
      </div>
    </div>

    <div class="is-scrollbar-hidden mt-4 min-w-full overflow-x-auto">
      <table class="w-full font-inter">
        <tbody>
          @foreach($levelsStats as $stat)
          <tr>
            <td class="whitespace-nowrap py-2">
              <div class="flex items-center space-x-2">
                <div class="h-3.5 w-3.5 rounded-full border-2 border-{{$colors[$loop->index]}} dark:border-accent"
                ></div>
                <p class="font-medium tracking-wide text-slate-700 dark:text-navy-100">
                  {{ $stat->level }}Level
                </p>
              </div>
            </td>
            <td class="whitespace-nowrap py-2 text-right">
              <p class="font-medium text-slate-700 dark:text-navy-100">
                {{ number_format($stat->count) }} 
              </p>
            </td>
            <td class="whitespace-nowrap py-2 text-right">{{ $stat->percent }}%</td>
          </tr>
          @endforeach

        </tbody>
      </table>
    </div>

    @livewire('semester.create-new-semester-form');
  </div>
</div>



    
        
   
    

    
@endsection
