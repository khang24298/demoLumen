<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\Queue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\A;

class ExampleJob extends Job
{
    protected $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->data = $request;
        // dd($this->data);
    }
    
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // A::create([$this->data);
        DB::table('a')->insert([
            'name' => $this->data['name'],
            'email' => $this->data['email'],
            'password' => $this->data['password']
        ]);
    }
}
