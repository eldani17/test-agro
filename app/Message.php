<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';

    protected $fillable = ['body', 'fromName', 'fromEmail', 'toEmail', 'date', 'spamScore'];

    public function subject(){
        return $this->belongsTo('App\Subject');
    }
}
