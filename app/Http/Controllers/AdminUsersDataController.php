<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
use App\Models\User;
use Carbon\Carbon;

class AdminUsersDataController extends Controller
{
    public function showAllUsers(Request $request)
    {
        $role = $request->query('role');
        $search = $request->query('search');
        

        $sortParam = $request->query('sort', 'created_at|desc');
        $sortParts = explode('|', $sortParam);
        $sortBy = $sortParts[0] ?? 'created_at';
        $sortDirection = $sortParts[1] ?? 'desc';

        $allowedSortBy = ['created_at', 'firstName', 'lastName'];
        $allowedSortDirection = ['asc', 'desc'];

        if (!in_array($sortBy, $allowedSortBy)) {
            $sortBy = 'created_at';
        }

        if (!in_array($sortDirection, $allowedSortDirection)) {
            $sortDirection = 'desc';
        }

        $allUsers = \App\Models\User::query()
        ->when($role, fn($q) => $q->where('role', "$role"))
        ->when($search, fn($q) => $q->where(function ($q) use ($search) {
            $q->where('firstName', 'like', "%{$search}%")
              ->orWhere('lastName', 'like', "%{$search}%");
        }))
        ->orderBy($sortBy, $sortDirection)
        ->paginate(10)
        ->withQueryString();

        $usersSum = $allUsers->count();

        return view('admin.users.index', compact('allUsers', 'usersSum'));
    }


}
