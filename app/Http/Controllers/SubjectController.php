<?php

namespace App\Http\Controllers;

use App\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
  public function index(Request $request){
    //traigo todos mis asuntos de la db
    $subjects = Subject::all();

    $data=[
      'status' => 'success',
      'code' => '200',
      'subjects' => $subjects,
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

    $subject = new Subject();
    $subject->desc = $params->desc;

    $subject->save();

    $data=[
      'status' => 'success',
      'code' => '200',
      'message' => 'Asunto guardado',
    ];

    return response()->json($data, 200);
  }
}
