<?php

namespace App\Charts;

use App\Models\Pelanggan;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\Auth;


class StatusUsersChart
{
    protected $Statuschart;

    public function __construct(LarapexChart $Statuschart)
    {
        $this->Statuschart = $Statuschart;
    }

    public function build($kd_unit = null, $year = null, $month = null): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $query = Pelanggan::orderBy('created_at');

        if ($kd_unit && $kd_unit !== 'all') {
            $query->where("kd_unit", $kd_unit);
        }

        if ($year) {
            $query->whereYear('created_at', $year);
        }

        if ($month) {
            $query->whereMonth('created_at', $month);
        }

        $pelanggans = $query->get();

        // Define the status mappings
        $statusMapping = [
            1 => ['label' => 'Pendaftar', 'color' => '#28a745'],  // Green
            6 => ['label' => 'Aktif', 'color' => '#007bff'],      // Blue
            12 => ['label' => 'Segel', 'color' => '#dc3545'],     // Red
            13 => ['label' => 'Ditolak', 'color' => '#ffc107'],   // Yellow
        ];

        // Group the data by status_id
        $statusCounts = $pelanggans->groupBy('status_id')->map(function ($group) {
            return $group->count();
        })->toArray();

        // Filter out only the statuses we're interested in
        $filteredStatusCounts = array_intersect_key($statusCounts, $statusMapping);

        // Prepare data for the chart
        $labels = array_map(function ($status) use ($statusMapping) {
            return $statusMapping[$status]['label'];
        }, array_keys($filteredStatusCounts));

        $colors = array_map(function ($status) use ($statusMapping) {
            return $statusMapping[$status]['color'];
        }, array_keys($filteredStatusCounts));

        return $this->Statuschart->pieChart()
            ->setTitle('Data Status Pelanggan')
            ->setHeight(350)
            ->setWidth(Auth::user()->role->nama === 'unit' ? 700 : 500)
            ->addData(array_values($filteredStatusCounts))
            ->setLabels($labels)
            ->setColors($colors);
    }
}


