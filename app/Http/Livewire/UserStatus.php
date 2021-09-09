<?php

namespace App\Http\Livewire;

use Livewire\Component;

class UserStatus extends Component
{
      
    public function viewStudentDetail()
    {
        $this->emitTo('student-manage','viewingDetail');
    }

    public function render()
    {
        return view('livewire.user.user-status');
    }
}
