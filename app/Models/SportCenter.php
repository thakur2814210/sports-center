<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SportCenter extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'name', 'description','address'
    ];

    public function Images(){
        return $this->hasMany(Images::class);
    }
}
