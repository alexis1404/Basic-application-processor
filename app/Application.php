<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'theme', 'message', 'attachment'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
