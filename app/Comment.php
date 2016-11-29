<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $primaryKey = 'id_comment';
    public $timestamps = false;
    public $fillable = ['id_project','id_user','comment'];

    public function user()
    {
        return $this->belongsTo('App\User', 'id_user', 'id');
    }
}
