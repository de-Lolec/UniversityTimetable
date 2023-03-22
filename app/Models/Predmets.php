<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Predmets extends Model
{
    use HasFactory;

    protected $fillable
        = [
            'id',
            'title',
            'info',
            'groups_id',
            'created_at',
            'updated_at',
        ];

    public function groups()
    {
        return $this->BelongsTo(Groups::class, 'groups_id');

    }
}
