<?php

namespace App\Charts;

use App\Models\Pelanggan;
use Illuminate\Support\Facades\Auth;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;

class YearUsersChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        // Mendapatkan daftar bulan dalam satu tahun penuh
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

        // Inisialisasi data
        $dataDaftar = [];
        $dataPengajuan = [];

        // Periksa jika peran pengguna adalah 'superadmin'


// Mendapatkan data pelanggan berdasarkan role user
if (auth()->user()->role->nama === 'superadmin') {
    $pelanggans = Pelanggan::orderBy('created_at')->get();
} else {
    $pelanggans = Pelanggan::where("kd_unit", Auth::user()->adminUnit->kd_unit)
        ->orderBy('created_at')
        ->get();
}

// Membuat daftar semua bulan
$allMonths = collect(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']);

// Kelompokkan berdasarkan jenis dan bulan untuk tgl_daftar
$dataDaftar = $pelanggans->where('jenis', 'pendaftaran')->groupBy(function ($pelanggan) {
    return Carbon::parse($pelanggan->tgl_daftar)->format('F');
})
    ->map(function ($group) {
        return $group->count();
    })
    ->toArray();

// Kelompokkan berdasarkan jenis dan bulan untuk tgl_pengajuan
$dataPengajuan = $pelanggans->where('jenis', 'pengajuan')->groupBy(function ($pelanggan) {
    return Carbon::parse($pelanggan->tgl_pengajuan)->format('F');
})
    ->map(function ($group) {
        return $group->count();
    })
    ->toArray();

// Mengisi data untuk setiap bulan, jika tidak ada data, nilainya menjadi 0
$dataDaftar = $allMonths->map(function ($month) use ($dataDaftar) {
    return $dataDaftar[$month] ?? 0;
});

$dataPengajuan = $allMonths->map(function ($month) use ($dataPengajuan) {
    return $dataPengajuan[$month] ?? 0;
});

// Label bulan
$label = $allMonths->toArray();

// Menggunakan LarapexChart untuk membuat barchart
return (new LarapexChart)->barChart()
->setSubtitle(date('Y'))
    // ->setWidth( 500)
    ->setWidth ( Auth::user()->role->nama === 'unit' ? 700 : 500)
    ->setHeight( Auth::user()->role->nama === 'unit' ? 350 : 350)
    ->addData('Jumlah Pendaftar', $dataDaftar->values()->toArray())
    ->addData('Jumlah Pengajuan', $dataPengajuan->values()->toArray())
    ->setColors(['#229954', '#CB4335']) // Hijau untuk pendaftaran, merah untuk pengajuan
    ->setXAxis($label);

}
}