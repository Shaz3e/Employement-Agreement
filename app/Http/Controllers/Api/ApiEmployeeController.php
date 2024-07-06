<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Employee\StoreEmployeeRequest;
use App\Http\Resources\Api\EmployeeResource;
use App\Models\Employee;
use App\Models\OtherDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ApiEmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return EmployeeResource::collection(Employee::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        try {
            $employee = Employee::create($request->validated());

            // Create other details
            $employee->otherDetails()->create([
                'employee_id' => $employee->id,
                'department' => $request->input('otherDetails.department'),
                'manager' => $request->input('otherDetails.manager'),
            ]);

            return response()->json(['message' => 'Employee and details have been added successfully'], 200);
        } catch (\Exception $e) {
            Log::error('Error: ', ['message' => $e->getMessage()]);
            return response()->json(['message' => 'An error occurred while processing your request.'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        return new EmployeeResource($employee);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreEmployeeRequest $request, Employee $employee)
    {
        try {
            $employee->update($request->validated());

            // Create other details
            $employee->otherDetails()->create([
                'employee_id' => $employee->id,
                'department' => $request->input('otherDetails.department'),
                'manager' => $request->input('otherDetails.manager'),
            ]);

            return response()->json(['message' => 'Employee and details have been updated successfully'], 200);
        } catch (\Exception $e) {
            Log::error('Error: ', ['message' => $e->getMessage()]);
            return response()->json(['message' => 'An error occurred while processing your request.'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        try {
            $employee->delete();
            return response()->json('Record has been deleted successfully.');
        } catch (\Exception $e) {
            // Log::error('Failed to delete employee: '.$e->getMessage());
            return response()->json(['error' => 'Failed to delete record'], 500);
        }
    }
}
