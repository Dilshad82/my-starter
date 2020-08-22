<?php

namespace App\Console\Commands;

use App\User;
use App\Mail\NotifyEmail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class NotifyScheduler extends Command
{
    /** The name and signature of the console command.
     * name command  ==> الاسم */
    protected $signature = 'notify:email';

    /** The console command description. ==. الوصف */
    protected $description = 'send email notify for all user every day';

    /*** Create a new command instance.
     * @return void*/
    public function __construct()
    {
        parent::__construct();
    }

    /**Execute the console command.
     * @return mixed*/
    public function handle()
    {
        // $emails = User::select('email')->get();
       
       //  pluck ==>  array ثم تقوم ب تحويله الي مصفوف emails تجلب جميع ال 
           $emails = User::pluck('email')->toArray();
           
           $data=['title' => 'Programming' , 'body' => 'PHP'];
           foreach($emails as $email)
           {// how to send emails in laravel 
              Mail::To($email)->send(new NotifyEmail($data));
           }
    }
}
