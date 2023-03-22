<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Timetable extends Model
{
    use HasFactory;

    const UNKNOWN_USER = 1;

    protected $table = 'Timetable';

    protected $fillable
        = [
            'id',
            'predmets_id',
            'prepods_id',
            'groups_id',
            'day_num',
            'week_parity',
            'time',
            'audience',
            'created_at',
            'updated_at',
        ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function groups()
    {
        return $this->BelongsTo(Groups::class, 'groups_id');
    }

    public function prepods()
    {
        return $this->BelongsTo(Prepods::class, 'prepods_id');
    }

    public function predmets()
    {
        return $this->BelongsTo(Predmets::class, 'predmets_id');
    }
}
