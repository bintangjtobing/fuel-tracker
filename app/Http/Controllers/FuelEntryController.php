<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FuelEntry;

class FuelEntryController extends Controller
{
    public function index()
    {
        $fuelEntries = FuelEntry::orderBy('fuel_date','desc')->paginate(10);
    return view('fuel_entries.index', ['fuelEntries' => $fuelEntries]);
    // return response()->json($fuelEntries);
    }

    // Method untuk menampilkan form tambah entri bahan bakar
    public function create()
    {
        return view('fuel_entries.create');
    }

    // Method untuk menyimpan entri bahan bakar baru
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'fuel_type' => 'sometimes',
        'fuel_price' => 'sometimes',
        'fuel_amount' => 'sometimes',
        'fuel_date' => 'sometimes',
        'kilometers_traveled' => 'sometimes',
        'oil_type' => 'sometimes',
        'oil_name' => 'sometimes',
        'service_date' => 'sometimes',
    ]);

    // Menghapus tanda "." dari angka sebelum menyimpannya ke database
    $validatedData['fuel_price'] = str_replace('.', '', $validatedData['fuel_price']);
    $validatedData['fuel_amount'] = str_replace('.', '', $validatedData['fuel_amount']);
    $validatedData['kilometers_traveled'] = str_replace('.', '', $validatedData['kilometers_traveled']);

    FuelEntry::create($validatedData);

    return redirect()->route('fuel_entries.index')
                     ->with('success', 'Fuel entry created successfully.');
}


    // Method untuk menampilkan detail entri bahan bakar
    public function show($id)
    {
        $fuelEntry = FuelEntry::findOrFail($id);
        return view('fuel_entries.show', ['fuelEntry' => $fuelEntry]);
    }

    // Method untuk menampilkan form edit entri bahan bakar
    public function edit($id)
    {
        $fuelEntry = FuelEntry::findOrFail($id);
        return view('fuel_entries.edit', ['fuelEntry' => $fuelEntry]);
    }

    // Method untuk menyimpan entri bahan bakar yang telah diedit
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'fuel_type' => 'required',
            'fuel_price' => 'required',
            'fuel_amount' => 'required',
            'kilometers_traveled' => 'required',
            'oil_type' => 'required',
            'oil_name' => 'required',
            'service_date' => 'required',
        ]);

        FuelEntry::whereId($id)->update($validatedData);

        return redirect()->route('fuel_entries.index')
                         ->with('success', 'Fuel entry updated successfully.');
    }

    // Method untuk menghapus entri bahan bakar
    public function destroy($id)
    {
        $fuelEntry = FuelEntry::findOrFail($id);
        $fuelEntry->delete();

        return redirect()->route('fuel_entries.index')
                         ->with('success', 'Fuel entry deleted successfully.');
    }
}
