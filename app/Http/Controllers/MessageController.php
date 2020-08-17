<?php

namespace App\Http\Controllers;

use App\Mail\SendEmail;
use App\Message;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
  public function index(Request $request){
    //traigo todos mis mensajes de la db
    $messages = Message::all();

    $data=[
      'status' => 'success',
      'code' => '200',
      'messages' => $messages,
    ];
    //respondo con el resultado
    return response()->json($data, 200);
  }

  public function store(Request $request){
    $json = $request->input('json', null);
    $params = json_decode($json);

    if (is_null($json)){
      $data=[
        'status' => 'error',
        'code' => '400',
        'message' => 'Faltan completar datos',
      ];
      return response()->json($data, 200);
    }

    $message = new Message();
    $message->subjectId = $params->subjectId;
    $message->body = $params->body;
    $message->fromName = $params->fromName;
    $message->fromEmail = $params->fromEmail;

    $message->toEmail = 'eldani17@gmail.com';

    $date = new DateTime('now');
    $message->date = $date->format('Y-m-d');
    $message->spamScore = '10';

    $message->save();

    Mail::to($message->toEmail)->send(new SendEmail($message));

    $data=[
      'status' => 'success',
      'code' => '200',
      'message' => 'Mensaje guardado',
    ];

    return response()->json($data, 200);
  }
}
