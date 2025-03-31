<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Fee extends Model
{
    use HasUuids;

    use HasFactory;

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'name',
        'description',
        'academic_session_id',
        'department_id',
        'faculty_id',
        'category_id',
        'level_id',
        'entry_mode_id',
        'amount',
        'payment_start_date',
        'payment_close_date',
    ];

    /**
     * Get the academic session associated with this fee.
     */
    public function academicSession()
    {
        return $this->belongsTo(Academic_Session::class);
    }

    /**
     * Get the department associated with this fee.
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Get the faculty associated with this fee.
     */
    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    /**
     * Get the category associated with this fee.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the level associated with this fee.
     */
    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    /**
     * Get the entry mode associated with this fee.
     */
    public function entryMode()
    {
        return $this->belongsTo(Entry_Mode::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_fees')
                    ->withPivot('amount_due', 'amount_paid', 'balance', 'status', 'payment_due_date')
                    ->withTimestamps();
    }

    protected $casts = [
        'payment_start_date' => 'datetime',
        'payment_close_date' => 'datetime',
    ];
}
