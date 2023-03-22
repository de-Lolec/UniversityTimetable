<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prepods extends Model
{
    use HasFactory;

    protected $table = 'prepods';

    protected $fillable
        = [
            'name',
            'email',
            'university_id',
            'info',
            'created_at',
            'updated_at',
        ];

    public function timetable()
    {
        //Препод принадлежит расписанию
        return $this->belongsTo(Timetable::class);
    }

    public function university()
    {
        return $this->belongsTo(University::class, 'university_id', 'id', 'id');
    }
}
