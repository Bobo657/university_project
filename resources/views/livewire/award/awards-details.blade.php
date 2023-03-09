@extends('layouts.app')
@section('content')

<div class="flex items-center justify-between py-5 lg:py-6">
    <div class="group flex items-center space-x-1">
      <h2 class="text-xl font-medium text-slate-700 line-clamp-1 dark:text-navy-50 lg:text-2xl">
        Award Dashboard
      </h2>
    </div>
</div>

<div class="mt-4 grid grid-cols-12 gap-4 transition-all duration-[.25s] sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6">
  <div class="col-span-12 lg:col-span-4">
    @livewire('award.created-award-list')

    @livewire('award.winners-list')
  </div>
    
  <div class="col-span-12 lg:col-span-8">
      @livewire('award.nominees-award-list')
  </div>
</div>

@livewire('award.add-award-nominee')

<x-delete_notification />
@endsection