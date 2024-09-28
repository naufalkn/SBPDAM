<?php

namespace App\Charts;

use App\Models\Pelanggan;
use Illuminate\Support\Facades\Auth;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;

class YearUsersChart
{
    protected $Yearchart;

    public function __construct(LarapexChart $Yearchart)
    {
        $this->Yearchart = $Yearchart;
    }

    public function build($kd_unit = null, $year = null): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $query = Pelanggan::orderBy('created_at');

        if ($kd_unit && $kd_unit !== 'all') {
            $query->where("kd_unit", $kd_unit);
        }

        if ($year) {
            $query->whereYear('created_at', $year);
        }

        $pelanggans = $query->get();

        $allMonths = collect([
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December'
        ]);

        $dataDaftar = $pelanggans->where('jenis', 'pendaftaran')->groupBy(function ($pelanggan) {
            return Carbon::parse($pelanggan->tgl_daftar)->format('F');
        })
            ->map(function ($group) {
                return $group->count();
            })
            ->toArray();

        $dataPengajuan = $pelanggans->where('jenis', 'pengajuan')->groupBy(function ($pelanggan) {
            return Carbon::parse($pelanggan->tgl_pengajuan)->format('F');
        })
            ->map(function ($group) {
                return $group->count();
            })
            ->toArray();

        $dataDaftar = $allMonths->map(function ($month) use ($dataDaftar) {
            return $dataDaftar[$month] ?? 0;
        });

        $dataPengajuan = $allMonths->map(function ($month) use ($dataPengajuan) {
            return $dataPengajuan[$month] ?? 0;
        });

        $label = $allMonths->toArray();

        return $this->Yearchart->barChart()
            ->setTitle('Data Statistik perBulan')
            ->setSubtitle((string) ($year ?? date('Y')))
            ->setWidth(Auth::user()->role->nama === 'unit' ? 700 : 500)
            ->setHeight(350)
            ->addData('Jumlah Pendaftar', $dataDaftar->values()->toArray())
            ->addData('Jumlah Pengajuan', $dataPengajuan->values()->toArray())
            ->setColors(['#229954', '#CB4335'])
            ->setXAxis($label);
    }

}

