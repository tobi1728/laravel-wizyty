<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
use App\Models\Medicine;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\QueryException;

class AdminDataMedicinesController extends Controller
{
    public function showAllMedicine(Request $request)
    {
        $search = $request->query('search');
        
        $sortParam = $request->query('sort', 'medicine_name|asc');
        $sortParts = explode('|', $sortParam);
        $sortBy = $sortParts[0] ?? 'medicine_name';
        $sortDirection = $sortParts[1] ?? 'asc';

        $allowedSortBy = ['medicine_name', 'medicine_form', 'medicine_producer'];
        $allowedSortDirection = ['asc', 'desc'];

        if (!in_array($sortBy, $allowedSortBy)) {
            $sortBy = 'medicine_name';
        }

        if (!in_array($sortDirection, $allowedSortDirection)) {
            $sortDirection = 'asc';
        }

        $allMedicinesCount = \App\Models\Medicine::all();

        $allMedicines = \App\Models\Medicine::query()
        ->when($search, fn($q) => $q->where(function ($q) use ($search) {
            $q->where('medicine_name', 'like', "%{$search}%")
              ->orWhere('medicine_form', 'like', "%{$search}%")
              ->orWhere('active_substance', 'like', "%{$search}%")
              ->orWhere('medicine_category', 'like', "%{$search}%")
              ->orWhere('medicine_producer', 'like', "%{$search}%")
              ->orWhere('medicine_description', 'like', "%{$search}%");
        }))
        ->orderBy($sortBy, $sortDirection)
        ->paginate(15)
        ->withQueryString();

        $medicinesSum = $allMedicinesCount->count();

        return view('admin.data.medicines', compact('allMedicines', 'medicinesSum'));
    }

    public function deleteMedicine($id)
    {
        $medicine = Medicine::findOrFail($id);

        try {
            $medicine->delete();
            return redirect()
                ->route('admin.data.medicines')
                ->with('success', 'Lek został usunięty.');
        } catch (QueryException $e) {
            if ($e->getCode() === '23000')
                return redirect()
                    ->route('admin.data.medicines')
                    ->with('error', 'Nie można usunąć leku, ponieważ został użyty w receptach.');
        }

        return redirect()
            ->route('admin.data.medicines')
            ->with('error', 'Wystąpił nieoczekiwany błąd podczas usuwania leku.');
    }

    public function editMedicine($id)
    {
        $medicine = Medicine::findOrFail($id);

        return view('admin.data.editMedicine', compact('medicine'));
    }

    public function updateMedicine(Request $request, $id)
    {
        $medicine = Medicine::findOrFail($id);

        $request->validate([
            // 'medicine_id' => 'required|exists:medicine,id',
            'medicine_name' => 'required|string',
            'medicine_form' => 'required|string',
            'active_substance' => 'required|string',
            'medicine_category' => 'required|string',
            'medicine_producer' => 'required|string',
            'medicine_description' => 'nullable|string',
        ]);

        $medicine->update([
            'medicine_name' => $request->medicine_name,
            'medicine_form' => $request->medicine_form,
            'active_substance' => $request->active_substance,
            'medicine_category' => $request->medicine_category,
            'medicine_producer' => $request->medicine_producer,
            'medicine_description' => $request->medicine_description,
        ]);

        return redirect()->route('admin.data.medicines')->with('success', 'Lek został zaktualizowany.');
    }

    public function addMedicine()
    {
        return view('admin.data.addMedicine');
    }

    public function createMedicine(Request $request)
    {
        $request->validate([
            'medicine_name' => 'required|string',
            'medicine_form' => 'required|string',
            'active_substance' => 'required|string',
            'medicine_category' => 'required|string',
            'medicine_producer' => 'required|string',
            'medicine_description' => 'nullable|string',
        ]);

        Medicine::create([
            'medicine_name' => $request->medicine_name,
            'medicine_form' => $request->medicine_form,
            'active_substance' => $request->active_substance,
            'medicine_category' => $request->medicine_category,
            'medicine_producer' => $request->medicine_producer,
            'medicine_description' => $request->medicine_description,
        ]);

        return redirect()->route('admin.data.medicines')->with('success', 'Lek został poprawnie dodany do bazy.');
    }
}