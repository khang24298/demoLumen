<?php

namespace App\Http\Controllers;

use App\Jobs\ExampleJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Cache;

class APIController extends Controller
{
    
    private $secretKey = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9";
    private $clientToken = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9";
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->redis = Redis::connection();
       
    }

    public function store(Request $request){
        $token = $request->header('accesstoken');
        if($token == $this->secretKey){
            dispatch(new ExampleJob($request->all()));
        }
        return "Success";
    }
    public function testRedis($id){
        $this->redis->set(rand(1,1999),'Khang Dz'.$id);
    }
    public function index(){
        $results = Cache::remember('all_users',60,function(){
            print_r("get from db");
            $results = DB::table('a')->get();
            return $results;
        });
        return $results;
    }
    public function show($id){
        $this->id = $id;
        // dd($this->id);
        $result = Cache::remember('user:'.$this->id,300,function(){
            print_r("get from db");
            $result = DB::table('a')->find($this->id);
            return $result;
        }); 
        return response()->json($result);
    }
}
