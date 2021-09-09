<x-jet-dialog-modal wire:model="viewingDetail" maxWidth="5xl">

  <x-slot name="title">
  </x-slot>

  <x-slot name="content">

   
      @foreach($students as $student)
      @php
      $student = explode('--',$student);
      @endphp
      <p>Class: {{$student[0]}}</p>
      <p>Name: {{$student[1]}}</p>
      @endforeach

  </x-slot>

  <x-slot name="footer">
  <button wire:click="$set('viewingDetail',false)" class="px-3 py-2 btn btn-outline btn-secondary font-bold uppercase rounded-lg">{{__('Close')}}</button>
  </x-slot>
</x-jet-dialog-modal>