<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMotorRequest;
use App\Http\Requests\UpdateMotorRequest;
use App\Models\Motor;
use App\Models\MotorCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MotorController extends Controller
{
    public function index()
    {
        $motors = Motor::with('category')->latest()->paginate(10);

        return view('admin.motors.index', compact('motors'));
    }

    public function create()
    {
        $categories = MotorCategory::orderBy('name')->get();

        return view('admin.motors.create', compact('categories'));
    }

    public function store(StoreMotorRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('motors', 'public');
        }

        Motor::create($validated);

        return redirect()->route('admin.motors.index')
            ->with('status', 'Motor berhasil ditambahkan.');
    }

    public function edit(Motor $motor)
    {
        $categories = MotorCategory::orderBy('name')->get();

        return view('admin.motors.edit', compact('motor', 'categories'));
    }

    public function update(UpdateMotorRequest $request, Motor $motor)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($motor->image) {
                Storage::disk('public')->delete($motor->image);
            }
            $validated['image'] = $request->file('image')->store('motors', 'public');
        }

        $motor->update($validated);

        return redirect()->route('admin.motors.index')
            ->with('status', 'Motor berhasil diperbarui.');
    }

    public function destroy(Motor $motor)
    {
        // booking_items.motor_id pakai restrictOnDelete di level DB,
        // jadi motor yang sudah punya riwayat booking dicegah dihapus
        // lebih awal di sini supaya errornya rapi, bukan SQL exception.
        $hasBookingHistory = DB::table('booking_items')->where('motor_id', $motor->id)->exists();

        if ($hasBookingHistory) {
            return back()->with('error', 'Motor tidak bisa dihapus karena punya riwayat booking. Nonaktifkan saja statusnya menjadi "inactive".');
        }

        if ($motor->image) {
            Storage::disk('public')->delete($motor->image);
        }

        $motor->delete();

        return redirect()->route('admin.motors.index')
            ->with('status', 'Motor berhasil dihapus.');
    }
}
