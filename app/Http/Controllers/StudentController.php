<?php

namespace App\Http\Controllers;
use App\Models\Student_fee;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $studentFees = Student_fee::select('id', 'student_id', 'fee_id', 'amount_due', 'amount_paid', 'balance', 'status', 'payment_due_date') // Ensure 'id' is included
        ->with(['student', 'fee'])
        ->orderBy('id')
        ->cursorPaginate(20);

        $startingSerialNumber = request()->has('cursor') 
        ? (int) request()->query('serial', 0) 
        : 0;

        return view('students.index', compact('studentFees', 'startingSerialNumber'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
