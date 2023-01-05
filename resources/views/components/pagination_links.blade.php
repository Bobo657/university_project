@if ($paginator->hasPages())
<ol class="pagination">
    <li class="rounded-l-lg bg-slate-150 dark:bg-navy-500"  >
      <a   href="#" wire:click.prevent="{{ !$paginator->onFirstPage() ? 'previousPage()' : '' }}"
        class="flex h-8 w-8 items-center justify-center rounded-lg text-slate-500 transition-colors hover:bg-slate-300 focus:bg-slate-300 active:bg-slate-300/80 dark:text-navy-200 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90"
        >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="h-4 w-4"
          fill="none"
          viewbox="0 0 24 24"
          stroke="currentColor"
          stroke-width="2"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M15 19l-7-7 7-7"
          />
        </svg>
      </a>
    </li>
    @foreach($elements as $element)
        @if(is_array($element))
            @foreach($element as $page => $url)
                @if($page == $paginator->currentPage())
                    <li class="bg-slate-150 dark:bg-navy-500">
                        <a wire:click.prevent
                            href="#"
                            class="flex h-8 min-w-[2rem] items-center justify-center rounded-lg bg-primary px-3 leading-tight text-white transition-colors hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90"
                        >{{ $page }}</a>
                    </li>
                @else
                    <li class="bg-slate-150 dark:bg-navy-500">
                        <a  wire:click.prevent="gotoPage({{$page}})" href="#"
                        class="flex h-8 min-w-[2rem] items-center justify-center rounded-lg px-3 leading-tight transition-colors hover:bg-slate-300 focus:bg-slate-300 active:bg-slate-300/80 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90">{{ $page }}</a>
                    </li>
                       
                @endif
            @endforeach
        @endif
    @endforeach
    <li class="rounded-r-lg bg-slate-150 dark:bg-navy-500" >
      <a wire:click.prevent="{{ $paginator->hasMorePages() ? 'nextPage()' : '' }}" href="#" 
        class="flex h-8 w-8 items-center justify-center rounded-lg text-slate-500 transition-colors hover:bg-slate-300 focus:bg-slate-300 active:bg-slate-300/80 dark:text-navy-200 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="h-4 w-4"
          fill="none"
          viewbox="0 0 24 24"
          stroke="currentColor"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M9 5l7 7-7 7"
          />
        </svg>
      </a>
    </li>
  </ol>
  @endif