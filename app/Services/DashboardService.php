<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class DashboardService
{
    public function  getTotalSchedules($specialist_id = null)
    {
        $totalSchedules = DB::table('schedules')->where('status', 1);
        if ($specialist_id !== null) {
            $totalSchedules = $totalSchedules->where('specialist_id', $specialist_id);
        }
        return $totalSchedules->count();
    }
    public function getTotalCostSchedules($specialist_id = null)
    {
        $totalCostSchedules = DB::table('schedules')->where('status', '>', 0);
        if ($specialist_id !== null) {
            $totalCostSchedules = $totalCostSchedules->where('specialist_id', $specialist_id);
        }
        return $totalCostSchedules->sum('price');
    }

    public function getLastSchedules($specialist_id = null, $total = 10)
    {
        $lastSchedules = DB::table('schedules')
            ->join('customers', 'schedules.customer_id', '=', 'customers.id')
            ->join('specialists', 'schedules.specialist_id', '=', 'specialists.id');

        if ($specialist_id !== null) {
            $lastSchedules = $lastSchedules->where('specialist_id', $specialist_id);
        }
        $lastSchedules = $lastSchedules->whereIn('status', [1, 2]);
        return $lastSchedules->orderBy('id', 'desc')
            ->limit($total)
            ->select('schedules.*', 'customers.first_name as customer_first_name', 'customers.last_name as customer_last_name', 'specialists.name as specialist_name')
            ->get();
    }
}
