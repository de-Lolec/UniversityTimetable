<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    use HasFactory;

    protected $fillable
        = [
            'id',
            'title',
            'info',
            'created_at',
            'updated_at',
        ];

//    public function university()
//    {
//        //Предмет принадлежит группе
//        return $this->hasMany(User::class);
//
//    }
}
