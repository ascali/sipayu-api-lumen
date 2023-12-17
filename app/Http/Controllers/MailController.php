<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function mail() {
        $data = array('name'=>'Ascaliko');
        Mail::send('mail.mail', $data, function($message) {
            $message->to('ascaliko@yopmail.com', 'Ascaliko')->subject('No Reply - SIPAYU');
            $message->from('noreply@sipayu.indramayukab.go.id','No Reply - SIPAYU');
        });
        echo 'Email Sent. Check your inbox.';
    }
}