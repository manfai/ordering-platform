<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class StudentManage extends Component
{

    public $viewingDetail = false;
    public $students = [];

    protected $listeners = [
        'viewingDetail' => 'viewDetail',
    ];

    public function viewDetail()
    {
        $this->viewingDetail = true;
        $user = User::find(auth()->user()->id);
        try {
            $this->students = $user->merchant->students;
        } catch (\Throwable $th) {
            $this->students = [];
        }
    }

    public function render()
    {
        return view('livewire.student-manage');
    }
}
