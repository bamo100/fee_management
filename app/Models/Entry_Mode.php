<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Entry_Mode extends Model
{
    //
    // Direct Entry

    // Transfer

    // Entrance Examination

    // Online Application
    use HasUuids;

    use HasFactory;

    protected $keyType = 'string';

    protected $table = 'entry_modes';

    public $incrementing = false;

    protected $fillable = ['mode_name'];

    /**
     * Get the fees associated with this academic session.
     */
    public function fees()
    {
        return $this->hasMany(Fee::class);
    }
}
