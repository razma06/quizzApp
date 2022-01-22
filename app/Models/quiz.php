<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\question;

class quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
        'user',
        'accept'
    ];

    public function questions(){
        return $this->hasMany(question::class);
    }
}
