<div class="flex items-center justify-start"> yoyo  
    <span class="mr-3">{{__('Student Info')}}</span>
    <div class="relative" x-data="$('#new_student').inputmask('99-9999999');" x-on:change="value = $event.target.value">
        <input type="text" id="new_student" wire:model.defer="new_student">
        <span class=" right-0 top-0 h-full w-10 text-center text-gray-600 pointer-events-none flex items-center justify-center">
        </span>
    </div>
</div>

<script>
   @this.new_student = "Hello";
</script>