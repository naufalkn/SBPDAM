<?php

namespace App\Charts;

use App\Models\Pelanggan;
use Illuminate\Support\Facades\Auth;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class YearUsersChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\barChart
{
    // Mendapatkan daftar bulan dalam satu tahun penuh
    $allMonths = collect([
        'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'
    ]);

    // Mengumpulkan data jumlah pelanggan tiap bulan berdasarkan unit
    $data = Pelanggan::where("kd_unit", Auth::user()->kd_unit)
        ->orderBy('created_at')
        ->get()
        ->groupBy(function ($pelanggan) {
            return $pelanggan->created_at->format('F');
        })
        ->map(function ($group) {
            return $group->count();
        })
        ->toArray();

    // Mengisi data untuk setiap bulan, jika tidak ada data, nilainya menjadi 0
    $data = $allMonths->map(function ($month) use ($data) {
        return $data[$month] ?? 0;
    });

    // Label bulan
    $label = $allMonths->toArray();
    
    return $this->chart->barChart()
        ->setTitle('Statistik Jumlah Pelanggan per Bulan')
        ->setSubtitle(date('Y'))
        ->setWidth(700)
        ->setHeight(400)
        ->addData('Jumlah Pelanggan', $data->values()->toArray())
        ->setXAxis($label);
}


}
