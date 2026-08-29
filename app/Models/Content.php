<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $table = 'contents';

    protected $fillable = ['subjects_id', 'title', 'description', 'status'];

    protected function casts(): array
    {
        return [
            'status' => 'boolean',
        ];
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subjects_id');
    }
}
