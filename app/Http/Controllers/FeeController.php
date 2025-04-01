<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fee;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Department;
use App\Models\Academic_Session;
use App\Models\Category;
use App\Models\Faculty;
use App\Models\Level;
use App\Models\Entry_Mode;

class FeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // dd('Hello');
        $fees = Fee::with(['academicSession', 'department', 'faculty', 'category', 'level', 'entryMode'])->paginate(10); 
        return view('fees.index', compact('fees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
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

        return view('fees.create', compact('departments', 'academic_sessions', 'entry_modes', 'categories', 'faculties', 'levels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'academic_session_id' => 'required|exists:academic_sessions,id',
            'department_id' => 'required|exists:departments,id',
            'faculty_id' => 'required|exists:faculties,id',
            'category_id' => 'required|exists:categories,id',
            'level_id' => 'required|exists:levels,id',
            'entry_mode_id' => 'required|exists:entry_modes,id',
            'amount' => 'required|numeric|min:0',
            'payment_start_date' => 'required|date',
            'payment_close_date' => 'required|date|after_or_equal:payment_start_date',
        ]);

        // If it's a Precognitive request, return a 204 response (no content)
        if ($request->isPrecognitive()) {
            return response()->noContent();
        }

        Fee::create($validated);

        if ($request->wantsJson()) {
            $fees = Fee::all(); 
            $view = view('fees.index', compact('fees'))->render();
    
            return response()->json([
                'message' => 'Fee created successfully.',
                'view' => $view,
            ], 201);
        }

        return redirect()->route('fees.index')->with('success', 'Fee created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Fee $fee)
    {
        return view('fees.show', compact('fee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fee $fee)
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

        return view('fees.edit', compact('fee', 'departments', 'academic_sessions', 'entry_modes', 'categories', 'faculties', 'levels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fee $fee): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'academic_session_id' => 'required|exists:academic_sessions,id',
            'department_id' => 'required|exists:departments,id',
            'faculty_id' => 'required|exists:faculties,id',
            'category_id' => 'required|exists:categories,id',
            'level_id' => 'required|exists:levels,id',
            'entry_mode_id' => 'required|exists:entry_modes,id',
            'amount' => 'required|numeric|min:0',
            'payment_start_date' => 'required|date',
            'payment_close_date' => 'required|date|after_or_equal:payment_start_date',
        ]);

        if ($request->isPrecognitive()) {
            return response()->noContent();
        }
  
        $fee->update($validated);
  
        return redirect()->route('fees.index')->with('success', 'Fee updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fee $fee): RedirectResponse
    {
        $fee->delete();

        return redirect()->route('fees.index')->with('success', 'Fee deleted successfully.');
    }

}
