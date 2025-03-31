<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Academic_Session;

class AcademicSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $academic_sessions = Academic_Session::all()->map(function ($academic_session) {
            return [
                'value' => $academic_session->id,
                'label' => $academic_session->session_name,
            ];
        })->toArray();
        return view('fees.create', compact('academic_sessions'));
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
