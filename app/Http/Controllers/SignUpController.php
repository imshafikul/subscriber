<?php

namespace App\Http\Controllers;

use App\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\SubscribeRequest;

class SignUpController extends Controller
{
  public function signup()
  {
    return view('signup');
  }


  public function subscribe(SubscribeRequest $request)
  {
    // subscribe
    $subscriber = new Subscriber([
      'firstname' => $request->firstname,
      'lastname' => $request->lastname,
      'email' => $request->email,
    ]); 

    $subscriber->save();

    Mail::send('emails.subscribed',
    ['name' => $subscriber->firstname]
    , function($message) use($subscriber){
      $message->from('suppor@shafikul.me', 'Email Platform');
      $message->to($subscriber->email);
      $message->subject('New Subscriber');
    });

    return back()->with(['success' => 'You have successfully subscribed to our email platform']);
  }
}
