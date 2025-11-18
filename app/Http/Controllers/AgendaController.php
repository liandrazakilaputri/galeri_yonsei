<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AgendaController extends Controller
{
    /**
     * Tampilkan daftar agenda untuk admin.
     */
    public function indexAdmin()
    {
        // Hapus otomatis agenda yang tanggalnya sudah lewat
        Agenda::where('tanggal', '<', Carbon::today())->delete();

        // Ambil semua agenda terbaru
        $agendas = Agenda::latest()->get();

        return view('admin.agenda.index', compact('agendas'));
    }

    /**
     * Tampilkan daftar agenda untuk user.
     */
    public function indexUser()
    {
        // Hapus otomatis agenda kadaluarsa
        Agenda::where('tanggal', '<', Carbon::today())->delete();

        // Ambil semua agenda terbaru
        $agendas = Agenda::latest()->get();

        return view('user.agenda', compact('agendas'));
    }

    /**
     * Form tambah agenda.
     */
    public function create()
    {
        return view('admin.agenda.create');
    }

    /**
     * Simpan agenda baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'deskripsi' => 'required|string',
        ]);

        Agenda::create([
            'judul' => $request->judul,
            'tanggal' => $request->tanggal,
            'deskripsi' => $request->deskripsi,
        ]);

        // FIX: Jangan redirect ke halaman user (agenda.index)
        return redirect()->route('admin.agenda.index')
                         ->with('success', 'Agenda berhasil ditambahkan!');
    }

    /**
     * Form edit agenda.
     */
    public function edit($id)
    {
        $agenda = Agenda::findOrFail($id);
        return view('admin.agenda.edit', compact('agenda'));
    }

    /**
     * Update agenda.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul'      => 'required|string|max:255',
            'tanggal'    => 'required|date',
            'deskripsi'  => 'required|string',
        ]);

        $agenda = Agenda::findOrFail($id);
        $agenda->update([
            'judul'     => $request->judul,
            'tanggal'   => $request->tanggal,
            'deskripsi' => $request->deskripsi,
        ]);

        // FIX: Redirect ke halaman admin, bukan user
        return redirect()->route('admin.agenda.index')
                         ->with('success', 'Agenda berhasil diperbarui!');
    }

    /**
     * Hapus agenda.
     */
    public function destroy($id)
    {
        $agenda = Agenda::findOrFail($id);
        $agenda->delete();

        // FIX: Redirect ke halaman admin, bukan user
        return redirect()->route('admin.agenda.index')
                         ->with('success', 'Agenda berhasil dihapus!');
    }
}
