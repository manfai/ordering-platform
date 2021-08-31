<?php

namespace App\View\Components\Input;

use Illuminate\View\Component;

class Student extends Component
{
    /**
     * The new student name.
     *
     * @var string
     */
    public $student;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($student)
    {
        $this->student = $student;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input.student');
    }
}
