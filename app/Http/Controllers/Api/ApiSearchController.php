<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class ApiSearchController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->input('search');
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');

        $employees = Employee::where('employeeName', 'like', '%' . $search . '%')
            ->orWhere('role', 'like', '%' . $search . '%')
            ->orWhere(function ($query) use ($fromDate, $toDate) {
                if ($fromDate && $toDate) {
                    $query->whereBetween('startDate', [$fromDate, $toDate])
                          ->orWhereBetween('endDate', [$fromDate, $toDate]);
                }
            })
            ->get();

        if ($employees->isEmpty()) {
            return response()->json(['message' => 'No records found'], 404);
        } else {
            return response()->json($employees);
        }
    }
}
