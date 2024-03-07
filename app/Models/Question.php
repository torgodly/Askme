<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'body', 'is_answered', 'answered_by', 'answer'];


    //sender
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //AnsweringUser
    public function answeringuser(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'answered_by');
    }


}
