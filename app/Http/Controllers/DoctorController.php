<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Specialization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DoctorController extends Controller
{
    public function index(Request $request)
    {
        $specializationId = $request->input('specialization_id');

        $doctors = Doctor::when($specializationId, function ($query) use ($specializationId) {
                return $query->where('specialization_id', $specializationId);
            })
            ->with('specialization') // Eager load already defined in model
            ->simplePaginate(12);

        $specializations = Cache::remember('all_specializations', 3600, function () {
            return Specialization::all();
        });

        return view('doctors.index', compact('doctors', 'specializations'));
    }

    public function show(Doctor $doctor)
    {
        $doctor->load('schedules');
        return view('doctors.show', compact('doctor'));
    }
}