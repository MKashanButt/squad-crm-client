<?php

namespace App\Models;

use App\Enum\InputStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Campaign extends Model
{
    use HasFactory;

    protected $table = 'campaign';

    protected $fillable = [];

    protected $casts = [
        'id' => 'integer',
    ];
}
