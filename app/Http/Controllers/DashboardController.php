<?php

namespace App\Http\Controllers;

use App\Models\FuelEntry;
use Illuminate\Http\Request;
use Carbon\Carbon;


class DashboardController extends Controller
{
    public function index()
    {
        // Menghitung jarak isi bensin dari tiap fuel_date
        $fuelEntriesData = FuelEntry::orderBy('fuel_date', 'desc')->paginate(5);
        $fuelEntries = FuelEntry::all();
        $totalDistance = 0;
        $totalEntries = $fuelEntries->count();

        foreach ($fuelEntries as $fuelEntry) {
            $totalDistance += $fuelEntry->kilometers_traveled;
        }
        $averageDistance = $totalEntries > 0 ? $totalDistance / $totalEntries : 0;

        // Menghitung jumlah hari antara entri bahan bakar
        $totalDays = 0;
        $previousFuelDate = null;
        foreach ($fuelEntries as $fuelEntry) {
            $currentFuelDate = Carbon::parse($fuelEntry->fuel_date);
            if ($previousFuelDate) {
                $totalDays += $currentFuelDate->diffInDays($previousFuelDate);
            }
            $previousFuelDate = $currentFuelDate;
        }

        // Jumlah hari rata-rata antara entri bahan bakar
        $averageDaysBetweenRefueling = $totalEntries > 1 ? $totalDays / ($totalEntries - 1) : 0;

        // Konversi jumlah hari rata-rata menjadi jumlah minggu rata-rata
        $averageWeeksBetweenRefueling = $averageDaysBetweenRefueling / 7;

        // Menghitung rata-rata pemakaian bensin
        $totalLiters = 0;
        foreach ($fuelEntries as $fuelEntry) {
            if ($fuelEntry->fuel_price != 0) {
                $totalLiters += $fuelEntry->fuel_amount / $fuelEntry->fuel_price;
            }
        }
        $averageFuelUsage = $totalEntries > 0 ? $totalLiters / $totalEntries : 0;

        // Menghitung rata-rata pemakaian bensin per hari
        $averageFuelUsagePerDay = 0;
        if ($averageWeeksBetweenRefueling > 0) {
            $averageFuelUsagePerDay = $averageFuelUsage / ($averageWeeksBetweenRefueling * 7);
        }

        // Mengambil bensin terakhir dan bensin bulan lalu
        $lastFuelEntry = FuelEntry::latest('fuel_date')->first();
        $lastMonthFuelEntry = FuelEntry::whereMonth('fuel_date', now()->subMonth())->latest('fuel_date')->first();

        // Menghitung persentase perubahan jarak
        $percentageChangeDistance = 0; // Default value jika tidak ada data sebelumnya
        if ($lastMonthFuelEntry && $lastMonthFuelEntry->kilometers_traveled != 0) {
            $percentageChangeDistance = (($lastFuelEntry->kilometers_traveled - $lastMonthFuelEntry->kilometers_traveled) / $lastMonthFuelEntry->kilometers_traveled) * 100;
        }

        // Mendapatkan bensin termurah
        $cheapestFuel = FuelEntry::orderBy('fuel_price')->first();

        // Menghitung rata-rata total biaya yang dikeluarkan
        $totalCost = 0;
        foreach ($fuelEntries as $fuelEntry) {
            $totalCost += $fuelEntry->fuel_amount;
        }
        $averageTotalCost = $totalEntries > 0 ? $totalCost / $totalEntries : 0;

        // Menghitung persentase perubahan penggunaan bahan bakar
        $percentageChangeFuel = 0; // Default value jika tidak ada data sebelumnya
        if ($lastMonthFuelEntry && $lastMonthFuelEntry->fuel_amount != 0) {
            $percentageChangeFuel = (($lastFuelEntry->fuel_amount - $lastMonthFuelEntry->fuel_amount) / $lastMonthFuelEntry->fuel_amount) * 100;
        }

        // Menghitung persentase perubahan biaya total
        $percentageChangeCost = 0; // Default value jika tidak ada data sebelumnya
        if ($lastMonthFuelEntry && $lastMonthFuelEntry->fuel_price != 0) {
            $previousMonthTotalCost = $lastMonthFuelEntry->fuel_amount * $lastMonthFuelEntry->fuel_price;
            $currentTotalCost = $lastFuelEntry->fuel_amount * $lastFuelEntry->fuel_price;
            if ($previousMonthTotalCost != 0) {
                $percentageChangeCost = (($currentTotalCost - $previousMonthTotalCost) / $previousMonthTotalCost) * 100;
            }
        }

        return view('home.index', compact('fuelEntriesData', 'averageDistance', 'cheapestFuel', 'averageFuelUsage', 'averageFuelUsagePerDay', 'averageTotalCost', 'percentageChangeDistance', 'percentageChangeFuel', 'percentageChangeCost', 'averageWeeksBetweenRefueling'));
    }
}
