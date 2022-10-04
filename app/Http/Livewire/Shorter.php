<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;

class Shorter extends Component
{
    public $email;
    public $long_url;
    public $short_url = null;

    public function mount(){

    }

    public function render()
    {
        return view('livewire.shorter');
    }

    public function shorter(){
        $this->short_url =  Str::random(8);
        \Log::info($this->short_url); 
        Redis::HDEL($this->email, "short_url");
        // Redis::hset($this->email, "short_url", $this->short_url, "long_url", $this->long_url);
        \Log::info(Redis::hgetall($this->email));
    }
}
