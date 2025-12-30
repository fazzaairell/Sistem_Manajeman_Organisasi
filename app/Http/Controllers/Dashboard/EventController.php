<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class EventController extends Controller
{
    // Menampilkan Semua Data dengan Fitur Search
    public function index(Request $request)
    {

        $search = $request->input('search');

        $events = Event::when($search, function ($query, $search) {
            return $query->where('title', 'like', "%{$search}%")
                ->orWhere('penanggung_jawab', 'like', "%{$search}%")
                ->orWhere('status', 'like', "%{$search}%");
        })->latest()->paginate(10);
        return view('dashboard.events.index', compact('events'));
    }

    // Export to PDF
    public function exportPdf(Request $request)
    {
        $search = $request->input('search');

        $events = Event::when($search, function ($query, $search) {
            return $query->where('title', 'like', "%{$search}%")
                ->orWhere('penanggung_jawab', 'like', "%{$search}%")
                ->orWhere('status', 'like', "%{$search}%");
        })->latest()->get();

        $pdf = Pdf::loadView('dashboard.events.pdf', compact('events'))
            ->setPaper('a4', 'landscape');
        
        return $pdf->download('laporan-event-' . date('Y-m-d') . '.pdf');
    }

    public function create()
    {
        $event = Event::all();
        return view('dashboard.events.create', compact('event'));
    }


    // Simpan ke Database
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'status' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'description' => 'required',
            'penanggung_jawab' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('events', 'public');
        }

        Event::create($data);
        return redirect()->route('events.index')->with('success', 'Event berhasil ditambahkan!');
    }

    // Form Edit 
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('dashboard.events.edit', compact('event'));
    }

    // Update Data
    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'status' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'description' => 'required',
            'penanggung_jawab' => 'required',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
            $data['image'] = $request->file('image')->store('events', 'public');
        }

        $event->update($data);
        return redirect()->route('events.index')->with('success', 'Event berhasil diupdate!');
    }

    // Hapus Data
    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        if ($event->image) {
            Storage::disk('public')->delete($event->image);
        }

        $event->delete();
        return redirect()->route('events.index')->with('success', 'Event berhasil dihapus!');
    }

}