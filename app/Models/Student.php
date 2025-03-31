<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    use HasUuids;

    use HasFactory;
    /**
     * The data type of the primary key ID.
     *
     * @var string
     */

    protected $keyType = 'string';
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */

    public $incrementing = false;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

     protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'faculty_id',
        'department_id',
        'academic_session_id',
        'level_id',
        'category_id',
        'entry_mode_id',
        'matric_number',
        'password',
        'profile_picture',
    ];

    /**
     * Get the faculty associated with the student.
     */
    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    /**
     * Get the department associated with the student.
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Get the academic session associated with the student.
     */
    public function academicSession()
    {
        return $this->belongsTo(Academic_Session::class);
    }

    /**
     * Get the level associated with the student.
     */
    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    /**
     * Get the category associated with the student.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the entry mode associated with the student.
     */
    public function entryMode()
    {
        return $this->belongsTo(Entry_Mode::class);
    }

    public function fees()
    {
        return $this->belongsToMany(Fee::class, 'student_fees')
                    ->withPivot('amount_due', 'amount_paid', 'balance', 'status', 'payment_due_date')
                    ->withTimestamps();
    }    
}
