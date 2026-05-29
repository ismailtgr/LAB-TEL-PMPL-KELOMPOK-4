<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\ScheduleCategory;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $category = $request->query('category');

        $schedules = Schedule::with('category')
            ->when($search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', '%' . $search . '%')
                        ->orWhere('instructor', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%');
                });
            })
            ->when($category, function ($query, $category) {
                $query->where('schedule_category_id', $category);
            })
            ->latest()
            ->get();

        $categories = ScheduleCategory::orderBy('name')->get();

        return view('admin.schedules.index', compact('schedules', 'categories', 'search', 'category'));
    }

    public function create()
    {
        $categories = ScheduleCategory::orderBy('name')->get();

        return view('admin.schedules.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'schedule_category_id' => ['required', 'exists:schedule_categories,id'],
            'description' => ['nullable', 'string'],
            'instructor' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date'],
            'start_time' => ['required'],
            'end_time' => ['required'],
            'student_count' => ['required', 'integer', 'min:0'],
            'status' => ['required', 'string', 'max:100'],
        ]);

        Schedule::create($validated);

        return redirect()
            ->route('admin.schedules.index')
            ->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function show(Schedule $schedule)
    {
        return view('admin.schedules.show', compact('schedule'));
    }

    public function edit(Schedule $schedule)
    {
        $categories = ScheduleCategory::orderBy('name')->get();

        return view('admin.schedules.edit', compact('schedule', 'categories'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'schedule_category_id' => ['required', 'exists:schedule_categories,id'],
            'description' => ['nullable', 'string'],
            'instructor' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date'],
            'start_time' => ['required'],
            'end_time' => ['required'],
            'student_count' => ['required', 'integer', 'min:0'],
            'status' => ['required', 'string', 'max:100'],
        ]);

        $schedule->update($validated);

        return redirect()
            ->route('admin.schedules.index')
            ->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        return redirect()
            ->route('admin.schedules.index')
            ->with('success', 'Jadwal berhasil dihapus.');
    }
}