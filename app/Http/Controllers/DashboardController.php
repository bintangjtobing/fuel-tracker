<?php

namespace App\Http\Controllers;

use App\Models\FuelEntry;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil data entri bahan bakar yang memiliki fuel_amount tidak sama dengan 0
        $fuelEntries = FuelEntry::where('fuel_amount', '!=', 0)
            ->orderByDesc('fuel_date')
            ->get();
        $fuelEntriesData = FuelEntry::where('fuel_amount', '!=', 0)
            ->orderByDesc('fuel_date')
            ->paginate(5);

        // Menghitung total jarak dan jumlah entri yang memiliki kilometers_traveled tidak sama dengan 0
        $totalDistance = $fuelEntries->filter(fn($entry) => $entry->kilometers_traveled != 0)->sum('kilometers_traveled');
        $totalEntries = $fuelEntries->filter(fn($entry) => $entry->kilometers_traveled != 0)->count();

// Menghitung rata-rata jarak per pengisian bahan bakar
        $averageDistancePerRefuel = 0;
        if ($totalEntries > 1) { // Mengubah $totalEntriesWithDistance menjadi $totalEntries
            // Mengurutkan entri bahan bakar berdasarkan tanggal
            $sortedFuelEntries = $fuelEntries->sortBy('fuel_date');

            // Menghitung rata-rata jarak per pengisian bahan bakar
            $totalDistancePerRefuel = 0;
            for ($i = 1; $i < $sortedFuelEntries->count(); $i++) {
                $distanceBetweenRefuels = $sortedFuelEntries[$i]->kilometers_traveled - $sortedFuelEntries[$i - 1]->kilometers_traveled;
                $totalDistancePerRefuel += $distanceBetweenRefuels;
            }

            $averageDistancePerRefuel = $totalDistancePerRefuel / ($sortedFuelEntries->count() - 1);
        }


        // Menghitung rata-rata penggunaan bensin
        $averageFuelUsage = $fuelEntries->sum(fn($entry) => $entry->fuel_amount / $entry->fuel_price) / $fuelEntries->count();

        // Menghitung jumlah hari rata-rata antara entri bahan bakar
        $averageDaysBetweenRefueling = $fuelEntries->count() > 1 ? Carbon::parse($fuelEntries->first()->fuel_date)->diffInDays(Carbon::parse($fuelEntries->last()->fuel_date)) / ($fuelEntries->count() - 1) : 0;

        // Konversi jumlah hari rata-rata menjadi jumlah minggu rata-rata
        $averageWeeksBetweenRefueling = $averageDaysBetweenRefueling / 7;

        // Menghitung rata-rata pemakaian bensin per hari
        $averageFuelUsagePerDay = $averageFuelUsage / ($averageWeeksBetweenRefueling * 7);

        // Mengambil bensin terakhir dan bensin bulan lalu
        $lastFuelEntry = $fuelEntries->first();
        $lastMonthFuelEntry = FuelEntry::whereMonth('fuel_date', now()->subMonth())->latest('fuel_date')->first();

        // Mengambil entri bahan bakar terakhir dan sebelumnya berdasarkan tanggal entri
        $lastFuelEntry = $fuelEntries->first();
        $previousFuelEntry = $fuelEntries->skip(1)->first();

        // Menghitung persentase perubahan jarak berdasarkan entri terakhir dan sebelumnya
        $percentageChangeDistance = $previousFuelEntry ? (($lastFuelEntry->kilometers_traveled - $previousFuelEntry->kilometers_traveled) / $previousFuelEntry->kilometers_traveled) * 100 : 0;

        // Mendapatkan bensin termurah
        $cheapestFuel = FuelEntry::where('fuel_price', '!=', 0)->orderBy('fuel_price')->first();

        // Menghitung rata-rata total biaya yang dikeluarkan
        $averageTotalCost = $fuelEntries->sum('fuel_amount') / $fuelEntries->count();

        // Menghitung persentase perubahan penggunaan bahan bakar
        $percentageChangeFuel = $lastMonthFuelEntry && $lastMonthFuelEntry->fuel_amount != 0 ? (($lastFuelEntry->fuel_amount - $lastMonthFuelEntry->fuel_amount) / $lastMonthFuelEntry->fuel_amount) * 100 : 0;

        // Menghitung persentase perubahan biaya total
        $percentageChangeCost = $lastMonthFuelEntry && $lastMonthFuelEntry->fuel_price != 0 ? (($lastFuelEntry->fuel_amount * $lastFuelEntry->fuel_price - $lastMonthFuelEntry->fuel_amount * $lastMonthFuelEntry->fuel_price) / ($lastMonthFuelEntry->fuel_amount * $lastMonthFuelEntry->fuel_price)) * 100 : 0;

        // Mengambil data entri layanan
        $servicesEntriesData = FuelEntry::whereNotNull('service_date')->orderByDesc('service_date')->paginate(5);

        $totalExpenses = Transaction::sum('total_price');

        // Mengambil data entri oli yang memiliki oil_type, oil_name, dan service_date tidak NULL
        $oilChangeEntries = FuelEntry::whereNotNull('oil_type')
        ->whereNotNull('oil_name')
        ->whereNotNull('service_date')
        ->orderByDesc('service_date')
        ->get();

        // Menghitung jumlah entri oli yang memenuhi kondisi tersebut
        $totalOilChangeEntries = $oilChangeEntries->count();

        $averageDaysBetweenOilChanges = $totalOilChangeEntries > 1 ? $oilChangeEntries->avg(function ($entry) {
            // Menghitung tanggal tiga bulan setelah tanggal layanan
            $nextServiceDate = Carbon::parse($entry->service_date)->addMonths(3);

            // Mengembalikan selisih dalam jumlah hari antara tanggal layanan dan tanggal layanan berikutnya
            return Carbon::parse($entry->service_date)->diffInDays($nextServiceDate);
        }) : 0;


        // Konversi jumlah hari rata-rata menjadi jumlah minggu rata-rata
        $averageWeeksBetweenOilChanges = $averageDaysBetweenOilChanges / 7;

        // Menghitung rata-rata jarak tempuh per pengisian bahan bakar
        $averageDistancePerRefuel = DB::table('fuel_entries')
        ->select(DB::raw('AVG(kilometers_traveled) as average_distance'))
        ->where('fuel_amount', '!=', 0)
        ->first()->average_distance ?? 0;

        // Pengaturan untuk grafik tren penggunaan bahan bakar
        $fuelUsageTrend = FuelEntry::select(DB::raw("DATE_FORMAT(fuel_date, '%Y-%m') as month"), DB::raw("SUM(fuel_amount) as total_fuel"))
            ->groupBy(DB::raw("DATE_FORMAT(fuel_date, '%Y-%m')"))
            ->orderBy('month')
            ->get();

        // Pengaturan untuk grafik tren frekuensi layanan
        $serviceFrequencyTrend = FuelEntry::whereNotNull('service_date')
            ->select(DB::raw("DATE_FORMAT(service_date, '%Y-%m') as month"), DB::raw("COUNT(*) as service_count"))
            ->groupBy(DB::raw("DATE_FORMAT(service_date, '%Y-%m')"))
            ->orderBy('month')
            ->get();

        return view('home.index', compact('fuelEntries','fuelEntriesData', 'averageDistance', 'cheapestFuel', 'averageFuelUsage', 'averageDistancePerRefuel', 'averageFuelUsagePerDay', 'averageTotalCost', 'percentageChangeDistance', 'percentageChangeFuel', 'percentageChangeCost', 'averageWeeksBetweenRefueling', 'servicesEntriesData','totalExpenses','averageDaysBetweenOilChanges','averageWeeksBetweenOilChanges', 'averageDistancePerRefuel','fuelUsageTrend', 'serviceFrequencyTrend'));
    }
}
