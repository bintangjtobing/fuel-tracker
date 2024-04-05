<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::latest()->paginate(10);
        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        return view('transactions.create');
    }

    public function store(Request $request)
    {
        try {
        $validatedData = $request->validate([
            'transaction_date' => 'required|date',
            'product_name' => 'required|string',
            'type_of_product' => 'required|in:oli,servis,lain-lain',
            'quantity' => 'required|string',
            'unit_price' => 'required|string',
            'discount_price' => 'nullable|string',
        ]);
        // Menghapus tanda "." dari angka sebelum menyimpannya ke database
        $validatedData['unit_price'] = str_replace('.', '', $validatedData['unit_price']);
        $validatedData['discount_price'] = str_replace('.', '', $validatedData['discount_price']);
        Transaction::create($validatedData);

        return redirect()->route('transactions.index')
            ->with('success', 'Transaction created successfully.');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show(Transaction $transaction)
    {
        return view('transactions.show', compact('transaction'));
    }

    public function edit(Transaction $transaction)
    {
        return view('transactions.edit', compact('transaction'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        try {
        $validatedData = $request->validate([
            'transaction_date' => 'required|date',
            'product_name' => 'required|string',
            'type_of_product' => 'required|in:oli,servis,lain-lain',
            'quantity' => 'required|string',
            'unit_price' => 'required|string',
            'discount_price' => 'nullable|string',
        ]);
        // Menghapus tanda "." dari angka sebelum menyimpannya ke database
        $validatedData['unit_price'] = str_replace('.', '', $validatedData['unit_price']);
        $validatedData['discount_price'] = str_replace('.', '', $validatedData['discount_price']);
        $transaction->update($validatedData);

        return redirect()->route('transactions.index')
            ->with('success', 'Transaction updated successfully.');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect()->route('transactions.index')
            ->with('success', 'Transaction deleted successfully.');
    }
}
