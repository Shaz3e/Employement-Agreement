<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\EmployeeResource;
use App\Models\Employee;
use Illuminate\Http\Request;

class ApiSearchController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->input('search');
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');

        $employees = Employee::where(function ($query) use ($search) {
            $query->where('employeeName', 'like', '%' . $search . '%')
                ->orWhere('role', 'like', '%' . $search . '%');
        })
            ->when($fromDate && $toDate, function ($query) use ($fromDate, $toDate) {
                $query->whereBetween('startDate', [$fromDate, $toDate])
                    ->orWhereBetween('endDate', [$fromDate, $toDate]);
            })
            ->get();

        if ($employees->isEmpty()) {
            return response()->json(['message' => 'No records found'], 404);
        } else {
            return EmployeeResource::collection($employees);
        }
    }
}
