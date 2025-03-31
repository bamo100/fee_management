<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Academic_Session extends Model
{
    //
    use HasUuids;

    use HasFactory;

    protected $table = 'academic_sessions';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'session_name',
        // 'start_date',
        // 'end_date',
    ];

     /**
     * Get the fees associated with this academic session.
     */
    public function fees()
    {
        return $this->hasMany(Fee::class);
    }
}
