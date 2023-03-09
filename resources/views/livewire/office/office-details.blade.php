@extends('layouts.app')
@section('content')
<div class="flex items-center justify-between py-5 lg:py-6">
    <div class="group flex items-center space-x-1">
      <h2 class="text-xl font-medium text-slate-700 line-clamp-1 dark:text-navy-50 lg:text-2xl">
        Students Executives Dashboard
      </h2>
    </div>
</div>

<div class="mt-4 grid grid-cols-12 gap-4 transition-all duration-[.25s] sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6">
 <div class="col-span-12 lg:col-span-4">
    @livewire('office.created-office-list')

    @livewire('office.winners-list')
  </div> 
    
  <div class="col-span-12 lg:col-span-8">
      @livewire('office.contestants')
  </div>
</div>

@livewire('office.add-office-contestant')

<x-delete_notification /> 
@endsection