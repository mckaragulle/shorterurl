<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\ShorterUrl;
use App\Mail\SendShorterUrl;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class ShorterUrlJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $email;

    public $long_url;

    public $short_url;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->email = $data["email"];
        $this->long_url = $data["long_url"];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if(!is_null($this->email) && !is_null($this->long_url)){
            $this->short_url = Str::random(8);
            Redis::HSet("short_urls", $this->short_url, $this->email."|".$this->long_url);
            Redis::HSet("emails", $this->email, $this->short_url."|".$this->long_url);
            $user = User::firstOrCreate(['email' => $this->email]);
            $urls = ShorterUrl::firstOrCreate(
                ['user_id' => $user->id, 'long_url' => $this->long_url],
                ['short_url' => $this->short_url]
            );
            $message = (new SendShorterUrl($urls))
                ->onQueue('emails');
 
            Mail::to($user)
                ->queue($message);
        }
    }
}
