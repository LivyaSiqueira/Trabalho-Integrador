<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'subjects';

    protected $fillable = ['users_id', 'name', 'description'];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function contents()
    {
        return $this->hasMany(Content::class, 'subjects_id');
    }
}
