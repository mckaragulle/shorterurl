<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\ShorterUrl;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Redirect;

class ShowUrl extends Component
{
    public $short_url;
    public $long_url;
    public $data;

    public function mount($short_url){
        $this->short_url = $short_url;
        $data = Redis::HGET("short_urls", $this->short_url);
        $this->data = explode("|", $data);
        $this->long_url = $this->data[1]??"yok";
        Redirect::away($this->long_url);
    }

    public function render()
    {
        return view('livewire.show-url')->extends('layouts.app');
    }
}
