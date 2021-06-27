<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property Integer  id
 * @property String   name
 * @property DateTime event_date
 * @property DateTime created_at
 * @property DateTime updated_at
 */
class GameSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'event_date',
    ];

    protected $casts = [
        'event_date' => 'datetime:c',
    ];
}
