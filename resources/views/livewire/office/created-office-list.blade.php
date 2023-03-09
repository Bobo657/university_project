<div>
    <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 sm:gap-5 lg:grid-cols-2">
        <div class="rounded-lg bg-slate-150 p-4 dark:bg-navy-700">
            <div class="flex justify-between space-x-1">
                <p class="text-xl font-semibold text-slate-700 dark:text-navy-100">
                    {{ number_format($offices->sum('ballots_count')) }}
                </p>
                <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-5 w-5 text-primary dark:text-accent"
                fill="none"
                viewbox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
                >
                <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 00-3-3.87"></path><path d="M16 3.13a4 4 0 010 7.75"></path>
                </svg>
            </div>
            <p class="mt-1 text-xs+">Total Contestants</p>
        </div>
        <div class="rounded-lg bg-slate-150 p-4 dark:bg-navy-700">
            <div class="flex justify-between">
                <p
                class="text-xl font-semibold text-slate-700 dark:text-navy-100"
                >
                {{ number_format($offices->sum('votes_count')) }}
                </p>
                <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-5 w-5 text-success"
                fill="none"
                viewbox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
                >
                <path d="M14 9V5a3 3 0 00-3-3l-4 9v11h11.28a2 2 0 002-1.7l1.38-9a2 2 0 00-2-2.3zM7 22H4a2 2 0 01-2-2v-7a2 2 0 012-2h3"></path>
                </svg>
            </div>
            <p class="mt-1 text-xs+">Total Votes</p>
        </div>
    </div>

    @livewire('office.create-new-office-form')

    <div class="mt-3 sm:mt-2 lg:mt-2">
        <div class="card mt-3">
            <div class="is-scrollbar-hidden min-w-full overflow-x-auto">
                <table class="is-hoverable w-full text-left">
                <thead>
                    <tr>
                    <th class="whitespace-nowrap rounded-tl-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                        Office
                    </th>
                    <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                        Contestant
                    </th>
                    <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                        Votes
                    </th>
                    <th class="whitespace-nowrap rounded-tr-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($offices as $office)
                    <tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
                        <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                            {{ $office->name }}
                        </td>
                        <td class="whitespace-nowrap px-4 py-3 sm:px-5 text-center">
                        {{ number_format($office->ballots_count) }}
                        </td>
                        <td class="whitespace-nowrap px-4 py-3 sm:px-5 text-center">
                            {{ number_format($office->votes_count) }}
                        </td>
                        <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                            <button wire:click="$emit('addContestant', {{$office->id}})" class="btn h-8 w-8 text-info rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                    <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z" fill="currentColor"/>
                                  </svg>
                            </button>
                            @if($office->ballots_count == 0)
                            <button wire:click="confirmDelete({{$office->id}})" class="btn h-8 w-8 text-error rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="x" data-lucide="x" class="lucide lucide-x block mx-auto"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                            </button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
