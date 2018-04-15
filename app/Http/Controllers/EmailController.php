<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SendRequest;
use Illuminate\Support\Facades\Mail;
use App\Subscriber;
use App\Mail\CampaignReady;

class EmailController extends Controller
{
  public function compose()
  {
    return view('dashboard');
  }

  public function send(SendRequest $request)
  {
    $subscribers = Subscriber::all();
    foreach($subscribers as $subscriber){
      // Mail::send('emails.capmaign',[
      //   'name' => $subscriber->firstname,
      //   'title' => $request->title,
      //   'content' => $request->content
      // ], function ($message) use ($subscriber){
      //   $message->from('suppor@shafikul.me', 'Email Platform');
      //   $message->to($subscriber->email);
      //   $message->subject($title);
      // });

      Mail::queue(new CampaignReady($subscriber, $request->title, $request->content ));


    }

    return back()->with(['success' => 'Campaign Sent']);


  }


}
