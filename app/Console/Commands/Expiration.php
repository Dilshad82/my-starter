<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class Expiration extends Command
{
    /** The name and signature of the console command.
     * name command  ==> الاسم */
    protected $signature = 'user:expire';

    /** The console command description. ==. الوصف */
    protected $description = 'expire users every 5 minute automatically';

    /** Create a new command instance.نموذج  */
    public function __construct()
    {
        parent::__construct();
    }

    /** Execute the console command.*/
    public function handle()
    {   // اجلب لي جميع المستخدمين الذين لم ينتهي الاشتراك لهم 
       // collection of users ==> مجموعة من المستخدمين 
        $users = User::where('expire' , 0)->get();

        foreach($users as $user){
          $user -> update(['expire' => 1]) ;
        }
    }
}
