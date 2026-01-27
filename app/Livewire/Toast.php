<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class Toast extends Component
{
    public $show = false;
    public $message = '';
    public $variant = 'success';

    #[On('toast')]
    public function notify($message, $variant = 'success')
    {
        $this->message = $message;
        $this->variant = $variant;
        $this->show = true;

        $this->dispatch('toast-shown');
    }

    public function render()
    {
        return view('livewire.toast');
    }
}
