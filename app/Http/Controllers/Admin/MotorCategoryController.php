<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMotorCategoryRequest;
use App\Http\Requests\UpdateMotorCategoryRequest;
use App\Models\MotorCategory;
use Illuminate\Support\Str;

class MotorCategoryController extends Controller
{
    public function index()
    {
        $categories = MotorCategory::withCount('motors')->latest()->paginate(10);

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(StoreMotorCategoryRequest $request)
    {
        $validated = $request->validated();
        $validated['slug'] = Str::slug($validated['name']);

        MotorCategory::create($validated);

        return redirect()->route('admin.categories.index')
            ->with('status', 'Kategori berhasil ditambahkan.');
    }

    public function edit(MotorCategory $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(UpdateMotorCategoryRequest $request, MotorCategory $category)
    {
        $validated = $request->validated();
        $validated['slug'] = Str::slug($validated['name']);

        $category->update($validated);

        return redirect()->route('admin.categories.index')
            ->with('status', 'Kategori berhasil diperbarui.');
    }

    public function destroy(MotorCategory $category)
    {
        if ($category->motors()->exists()) {
            return back()->with('error', 'Kategori tidak bisa dihapus karena masih dipakai motor.');
        }

        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('status', 'Kategori berhasil dihapus.');
    }
}
