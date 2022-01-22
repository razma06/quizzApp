<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\quiz;

class question extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'a',
        'b',
        'c',
        'd',
        'quiz_id',
        'no'
    ];

    public function quiz(){
        return $this->belongsTo(quiz::class);
    }
}
