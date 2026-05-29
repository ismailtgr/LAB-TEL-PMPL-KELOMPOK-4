<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ScheduleCategory;
use Illuminate\Http\Request;

class ScheduleCategoryController extends Controller
{
    public function index()
    {
        $categories = ScheduleCategory::latest()->get();

        return view('admin.schedule-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.schedule-categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:schedule_categories,name'],
            'description' => ['nullable', 'string'],
        ]);

        ScheduleCategory::create($validated);

        return redirect()
            ->route('admin.schedule-categories.index')
            ->with('success', 'Kategori jadwal berhasil ditambahkan.');
    }

    public function edit(ScheduleCategory $scheduleCategory)
    {
        return view('admin.schedule-categories.edit', compact('scheduleCategory'));
    }

    public function update(Request $request, ScheduleCategory $scheduleCategory)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:schedule_categories,name,' . $scheduleCategory->id],
            'description' => ['nullable', 'string'],
        ]);

        $scheduleCategory->update($validated);

        return redirect()
            ->route('admin.schedule-categories.index')
            ->with('success', 'Kategori jadwal berhasil diperbarui.');
    }

    public function destroy(ScheduleCategory $scheduleCategory)
    {
        $scheduleCategory->delete();

        return redirect()
            ->route('admin.schedule-categories.index')
            ->with('success', 'Kategori jadwal berhasil dihapus.');
    }
}