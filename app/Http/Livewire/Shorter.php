<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Jobs\ShorterUrlJob;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Shorter extends Component
{
    use LivewireAlert;

    public $email;
    public $long_url;

    public function render()
    {
        return view('livewire.shorter');
    }

    public function shorter(){
        $datas = ['email' => $this->email, 'long_url' => $this->long_url];
        ShorterUrlJob::dispatchNow($datas);
        $this->alert('success', 'Kısa Link Hazırlanıyor. Hazır olunca eposta adresinize bildirim gelecektir.');
        // ->delay(now()->addMinutes(1));
    }
}
