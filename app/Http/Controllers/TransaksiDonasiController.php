<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use App\Models\transaksi_donasi;
use App\Models\TransaksiDonasi;
use Illuminate\Http\Request;

class TransaksiDonasiController extends Controller
{
    /**
     * Display a listing of the transactions.
     */
    public function index()
    {
        $transaksiDonasi = transaksi_donasi::with('donasi', 'donatur')->get();
        return view('transaksi_donasi.index', compact('transaksiDonasi'));
    }

    /**
     * Show the form for creating a new transaction.
     */
    public function create($donasiId)
    {
        $donasi = Donasi::findOrFail($donasiId);
        return view('transaksi_donasi.create', compact('donasi'));
    }

    /**
     * Store a newly created transaction in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'donasi_id' => 'required|exists:donasi,id',
            'nama' => 'required|string|max:255',
            'jumlah_donasi' => 'required|numeric|min:1',
            'pesan' => 'nullable|string',
        ]);

        $request['user_id'] = auth()->user()->id;

        transaksi_donasi::create($request->all());

        // Update the collected amount in the related donation
        $donasi = Donasi::findOrFail($request->donasi_id);
        if (in_array($request->status, ['sukses', 'pending'])) {
            $donasi->jumlah_donasi += $request->jumlah_donasi;
            $donasi->save();
        }

        return redirect()->route('donasi.show', $request->donasi_id)->with('success', 'Donasi berhasil ditambahkan.');
    }

    /**
     * Display the specified transaction.
     */
    public function show(transaksi_donasi $transaksiDonasi)
    {
        return view('transaksi_donasi.show', compact('transaksiDonasi'));
    }

    /**
     * Show the form for editing the specified transaction.
     */
    public function edit(transaksi_donasi $transaksiDonasi)
    {
        return view('transaksi_donasi.edit', compact('transaksiDonasi'));
    }

    /**
     * Update the specified transaction in storage.
     */
    public function update(Request $request, transaksi_donasi $transaksiDonasi)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jumlah_donasi' => 'required|numeric|min:1',
            'pesan' => 'nullable|string',
        ]);

        // Adjust the collected amount if status changes
        $donasi = $transaksiDonasi->donasi;
        if ($transaksiDonasi->status === 'sukses' && $request->status !== 'sukses') {
            $donasi->jumlah_donasi -= $transaksiDonasi->jumlah_donasi;
        } elseif ($transaksiDonasi->status !== 'sukses' && $request->status === 'sukses') {
            $donasi->jumlah_donasi += $request->jumlah_donasi;
        }

        $donasi->save();
        $transaksiDonasi->update($request->all());

        return redirect()->route('transaksi_donasi.index')->with('success', 'Transaksi berhasil diperbarui.');
    }

    /**
     * Remove the specified transaction from storage.
     */
    public function destroy(transaksi_donasi $transaksiDonasi)
    {
        $donasi = $transaksiDonasi->donasi;
        if ($transaksiDonasi->status === 'sukses') {
            $donasi->jumlah_donasi -= $transaksiDonasi->jumlah_donasi;
            $donasi->save();
        }

        $transaksiDonasi->delete();
        return redirect()->route('transaksi_donasi.index')->with('success', 'Transaksi berhasil dihapus.');
    }

    /**
     * Show the donation input form.
     */
    public function transfer($id)
    {
        $donasi = Donasi::findOrFail($id);
        return view('donasi.transaksi', compact('donasi'));
    }
}
