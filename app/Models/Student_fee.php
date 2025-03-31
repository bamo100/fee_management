<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student_fee extends Model
{
    use HasUuids;

    use HasFactory;

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'student_id',
        'fee_id',
        'amount_due',
        'amount_paid',
        'balance',
        'status',
        'payment_due_date',
    ];

    /**
     * Get the student associated with this fee record.
     */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

     /**
     * Get the fee associated with this student fee record.
     */
    public function fee()
    {
        return $this->belongsTo(Fee::class);
    }
}
