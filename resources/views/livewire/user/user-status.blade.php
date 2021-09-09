<div class="w-full bg-base-200 shadow stats mb-6">
  <div class="stat bg-base-200 ">
    <div class="stat-figure text-primary">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-8 h-8 stroke-current">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
      </svg>
    </div>
    <div class="stat-title">Bentos ({{date('F')}})</div>
    <div class="stat-value text-primary">{{auth()->user()->bentos()->where('menu_date','>=',date('Y-m-01'))->count()}}</div>
    <div class="stat-desc">Thank you for your order.</div>
  </div>
  <div class="stat bg-base-200 ">
    <div class="stat-figure text-info">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-8 h-8 stroke-current">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
      </svg>
    </div>
    <div class="stat-title">Payment Card</div>
    <div class="stat-value text-info">{{(auth()->user()->payments()->where('brand','STRIPE')->count())}}</div>
    <!-- <div class="stat-desc">Click here to edit</div> -->
  </div>
  <div class="stat bg-base-200 ">
    <div class="stat-figure text-info">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-8 h-8 stroke-current">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
      </svg>
    </div>
    <div class="stat-title">Students</div>
    <div class="stat-value text-info">{{count(auth()->user()->merchant->students)}}</div>
    <!-- <div class="stat-desc" wire:click="viewStudentDetail()">Click here to edit</div> -->
  </div>
@livewire('student-manage')
</div>