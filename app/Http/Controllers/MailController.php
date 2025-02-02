<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function mail() {
        print_r('init mail'.PHP_EOL);
        $data = array('name'=>'Ascaliko');
        Mail::send('mail.test', $data, function($message) {
            $message->to('ascaliko@yopmail.com', 'Ascaliko')->subject('No Reply - SIPAYU');
            $message->from('noreply@sipayu.indramayukab.go.id','No Reply - SIPAYU');
            print_r('mail data'.PHP_EOL);
        });
        print_r('Email Sent. Check your inbox.');
    }
}