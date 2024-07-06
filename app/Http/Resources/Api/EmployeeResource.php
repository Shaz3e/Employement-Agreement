<?php

namespace App\Http\Resources\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'id' => $this->employee_agreen_number,
            'employeeName' => $this->employeeName,
            'role' => $this->role,
            'startDate' => $this->startDate->format('Y-m-d'), // start should be YYYY-MM-DD format
            'endDate' => $this->endDate->format('Y-m-d'), // end should be YYYY-MM-DD format
            'endDate' => $this->endDate,
            'salary' => $this->salary,
            'terms' => $this->terms,
            // 'otherDetails' => $this->otherDetails()->get()->toArray(),
            'otherDetails' => $this->otherDetails->map(function ($detail) {
                return [
                    'department' => $detail->department,
                    'manager' => $detail->manager,
                ];
            }),

        ];
    }
}
