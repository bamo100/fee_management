<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Academic_Session;
use App\Models\Category;
use App\Models\Faculty;
use App\Models\Level;
use App\Models\Entry_Mode;

class DepartmentController extends Controller
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
    public function createFee()
    {
        $departments = Department::all()->map(function ($department) {
            return [
                'value' => $department->id,
                'label' => $department->department_name,
            ];
        })->toArray();

        $academic_sessions = Academic_Session::all()->map(function ($academic_session) {
            return [
                'value' => $academic_session->id,
                'label' => $academic_session->session_name,
            ];
        })->toArray();

        $entry_modes = Entry_Mode::all()->map(function ($entry_mode) {
            return [
                'value' => $entry_mode->id,
                'label' => $entry_mode->mode_name,
            ];
        })->toArray();

        $categories = Category::all()->map(function ($category) {
            return [
                'value' => $category->id,
                'label' => $category->name,
            ];
        })->toArray();

        $faculties = Faculty::all()->map(function ($faculty) {
            return [
                'value' => $faculty->id,
                'label' => $faculty->faculty_name,
            ];
        })->toArray();

        $levels = Level::all()->map(function ($level) {
            return [
                'value' => $level->id,
                'label' => $level->level_name,
            ];
        })->toArray();

        return view('fees.create-fee.index', compact('departments', 'academic_sessions', 'entry_modes', 'categories', 'faculties', 'levels'));
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
