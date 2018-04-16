<?php

namespace App\Http\Controllers;

use App\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\SubscribeRequest;

class SignUpController extends Controller
{

  public function subscribers()
  {
    $subscribers = Subscriber::all();
    return view('subscribers',['subscribers' => $subscribers]);
  }


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

  public function export()
  {
    $csvData = [];
    $subscribers = Subscriber::all();
    foreach($subscribers as $subscriber){
      $csvData[] = [
        'firstname' => $subscriber->firstname,
        'lastname' => $subscriber->lastname,
        'email' => $subscriber->email,
        'purchased_on' => $subscriber->created_at
      ];
    }

    $fp = fopen("php://output", "w");

    $header = array("FirstName", "LastName","Email","Purchased_on");

    $filename = "subscribers.csv";

    fputcsv($fp, $header);
    foreach($csvData as $row){
      fputcsv($fp, $row);
    }
    
    header( 'Content-Type: text/csv' );
    header( 'Content-Disposition: attachment;filename=' . $filename);
    fclose($fp);
  }

  public function import()
  {
    if (($handle = fopen ( public_path () . '/mock_subscriber.csv', 'r' )) !== FALSE) {
      while ( ($data = fgetcsv ( $handle, 1000, ',' )) !== FALSE ) {
        $subscriber = new Subscriber ();
        $subscriber->firstname = $data [1];
        $subscriber->lastname = $data [2];
        $subscriber->email = $data [3];
        $subscriber->save ();
  
      }
      fclose ( $handle );
      
    }

    return Subscriber::all();


  }





}
