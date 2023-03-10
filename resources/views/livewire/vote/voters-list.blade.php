
<div>
    <div class="card px-4 pb-4 sm:px-5">
        <div class="my-3 flex h-8 items-center justify-between">
          <h2 class="font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100 lg:text-base">
            {{ ucFirst($ballot) ?? 'Office'}} Voters Table
          </h2>
         
        </div>
        <div>
            <div class="grid grid-cols-1 sm:grid-cols-4 gap-4"> 
                <input wire:model="contestant"
                class="form-input h-9 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                placeholder="Search contestant"
                type="text"
                />
                <input wire:model="voter"
                class="form-input h-9 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                placeholder="Search Voter"
                type="text"
                />
                <div class="col-span-2">
                    <div class="grid sm:grid-cols-3 px-0.5">
                        <select wire:model="semesterId" class="form-select h-9 w-full mr-2 rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent">
                            <option disabled value="">--- Select semester ----</option>
                            @foreach($semesters as $semester)
                            <option  value="{{ $semester->id}}">{{ $semester->duration}} </option>
                            @endforeach
                        </select>

                        <select wire:model="ballot" class="form-select mt-3 sm:mt-0 h-9 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent ml-3">
                            <option disabled value="">--- Select Ballot ----</option>
                            @foreach($ballots as $ballot)
                            <option value="{{ $ballot }}">{{ ucFirst($ballot) }}</option>
                            @endforeach
                        </select>
                        <button wire:click="resetParameters()" class="btn font-medium text-error hover:bg-error/20 focus:bg-error/20 active:bg-error/25 ">
                            Reset
                        </button>
                    </div>
                </div>
            </div>

            <div class="mt-3">
                <div class="is-scrollbar-hidden min-w-full overflow-x-auto">
                    <table class="is-zebra w-full text-left">
                        <thead>
                        <tr>
                            <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                            Voter
                            </th>
                            <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                Position
                            </th>
                            <th class="whitespace-nowrap rounded-r-lg bg-slate-200 px-3 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                            Contestant
                            </th>
                            <th class="whitespace-nowrap rounded-r-lg bg-slate-200 px-3 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                            Semester
                            </th>
                            <th class="whitespace-nowrap rounded-r-lg bg-slate-200 px-3 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                            Date
                            </th>
                            <th class="whitespace-nowrap rounded-r-lg bg-slate-200 px-3 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse($votes as $vote)
                            <tr>
                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                    <div class="flex items-center space-x-4">
                                        <div class="avatar h-9 w-9">
                                            <img class="mask is-squircle" src="{{ $vote->voter->profile_photo_path ?? 'n/a' }}" alt="avatar">
                                        </div>
                                        <span class="font-medium text-slate-700 dark:text-navy-100">
                                            <a href="{{ $vote->voter->path ?? '#' }}"> 
                                                {{ $vote->voter->full_name ?? 'n/a' }}
                                            </a>
                                        </span>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                    {{ $vote->ballot->ballotable->name ?? 'n/a' }} 
                                </td>
                                <td class="whitespace-nowrap rounded-r-lg px-4 py-3 sm:px-5">
                                    <div class="flex items-center space-x-4">
                                        <div class="avatar h-9 w-9">
                                            <img class="mask is-squircle" src="{{ $vote->voteOwner->profile_photo_path ?? '#' }}" alt="avatar">
                                        </div>
                                        <span class="font-medium text-slate-700 dark:text-navy-100">
                                            <a href="{{ $vote->voteOwner->path ?? '#' }}"> 
                                                {{ $vote->voteOwner->full_name ?? 'n/a' }}
                                            </a>
                                        </span>
                                    </div>
                                   
                                </td>
                                <td class="whitespace-nowrap rounded-r-lg px-4 py-3 sm:px-5">
                                    {{ $vote->semester->duration }}
                                </td>
                                <td class="whitespace-nowrap rounded-r-lg px-4 py-3 sm:px-5">
                                    {{ $vote->created_at->format('m-d-Y') }}
                                </td>
                                <td class="whitespace-nowrap rounded-r-lg px-4 py-3 sm:px-5">
                                    <a href="#" wire:click.prevent="confirmDelete({{ $vote->id }})" class="text-error">
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
                @if($votes->total()  > $noOfRecords)
                <div class="flex flex-col justify-between space-y-4 px-4 py-4 sm:flex-row sm:items-center sm:space-y-0 sm:px-5">
                    <div class="flex items-center space-x-2 text-xs+">
                        <span>Show</span>
                        <label class="block">
                        <select wire:model="noOfRecords" class="form-select rounded-full border border-slate-300 bg-white px-2 py-1 pr-6 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent">
                            <option>10</option>
                            <option>30</option>
                            <option>50</option>
                        </select>
                        </label>
                        <span>entries</span>
                    </div>
    
                    {{ $votes->links('components.pagination_links') }}
    
                    <div class="text-xs+">
                        {{ $votes->currentpage() }} - {{ $votes->currentpage() * $votes->perpage() }} 
                        of {{ $votes->total() }} entries
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <x-delete_notification />
</div>
