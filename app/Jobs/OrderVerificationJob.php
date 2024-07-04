<?php

namespace App\Jobs;

use App\Mail\OrderVerificationEmail;
use App\Mail\PDFMail;
use App\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Mail;

class OrderVerificationJob implements ShouldQueue
{
    protected $id,$email,$type,$file;
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id,$email,$type,$file)
    {
        $this->id = $id;
        $this->email = $email;
        $this->type = $type;
        $this->file = $file;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new OrderVerificationEmail($this->id, $this->type , $this->file);
        Mail::to($this->email)->send($email);  
    }
}
