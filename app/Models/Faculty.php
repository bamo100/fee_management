<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    //
    use HasUuids;

    use HasFactory;

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = ['faculty_name'];

    /**
     * Get the fees associated with this academic session.
     */
    public function fees()
    {
        return $this->hasMany(Fee::class);
    }
}
