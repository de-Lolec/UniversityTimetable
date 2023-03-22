<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groups extends Model
{
    use HasFactory;

    const UNKNOWN_USER = 1;

    protected $fillable
        = [
            'id',
            'title',
            'created_at',
            'updated_at',
        ];

//    public function predmets()
//    {
//        //Предмет принадлежит группе
//        return $this->hasMany(Predmets::class);
//    }
}
