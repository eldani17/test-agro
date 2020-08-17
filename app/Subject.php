<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'subjects';

    protected $fillable = ['desc'];

    public function messages(){
        return $this->hasMany('App\Message', 'foreign_key', 'subjectId');
    }
}
