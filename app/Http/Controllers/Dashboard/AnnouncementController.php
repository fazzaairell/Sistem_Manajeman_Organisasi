<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class AnnouncementController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil semua data pengumuman dengan search dan filter
        $query = Announcement::query();

        // Search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%')
                  ->orWhere('category', 'like', '%' . $search . '%')
                  ->orWhere('author', 'like', '%' . $search . '%');
            });
        }

        // Filter by category
        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        // Filter by priority
        if ($request->has('priority') && $request->priority != '') {
            $query->where('priority', $request->priority);
        }

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $announcements = $query->latest('date')->paginate(10);

        return view('dashboard.announcements.index', compact('announcements'));
    }

    // Export to PDF
    public function exportPdf(Request $request)
    {
        $query = Announcement::query();

        // Apply same filters as index
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%')
                  ->orWhere('category', 'like', '%' . $search . '%')
                  ->orWhere('author', 'like', '%' . $search . '%');
            });
        }

        if ($request->has('priority') && $request->priority != '') {
            $query->where('priority', $request->priority);
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $announcements = $query->latest('date')->get();

        $pdf = Pdf::loadView('dashboard.announcements.pdf', compact('announcements'))
            ->setPaper('a4', 'landscape');
        
        return $pdf->download('laporan-pengumuman-' . date('Y-m-d') . '.pdf');
    }

    public function show($id)
    {
        $announcement = Announcement::findOrFail($id);
        return view('dashboard.announcements.show', compact('announcement'));
    }

    public function create()
    {
        return view('dashboard.announcements.create');
    }

    // Simpan Pengumuman Baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'priority' => 'required|in:normal,penting,urgent',
            'status' => 'required|in:draft,published',
            'date' => 'required|date',
            'expires_at' => 'nullable|date|after:date',
            'description' => 'required|string',
            'content' => 'required|string',
            'author' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();
        $data['views'] = 0;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('announcements', 'public');
        }

        Announcement::create($data);
        return redirect()
            ->route('announcements.index')
            ->with('success', 'Pengumuman berhasil ditambahkan!');

    }

    // Hapus Pengumuman
    public function destroy($id)
    {
        $announcement = Announcement::findOrFail($id);

        // Hapus gambar jika bukan URL external
        if ($announcement->image && !filter_var($announcement->image, FILTER_VALIDATE_URL)) {
            Storage::disk('public')->delete($announcement->image);
        }

        $announcement->delete();
        return back()->with('success', 'Pengumuman berhasil dihapus!');
    }

    // Fungsi Menampilkan Halaman Form Edit
    public function edit($id)
    {
        $announcement = Announcement::findOrFail($id);
        return view('dashboard.announcements.edit', compact('announcement'));
    }

    // Fungsi Pembaruan Data
    public function update(Request $request, $id)
    {
        $announcement = Announcement::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'priority' => 'required|in:normal,penting,urgent',
            'status' => 'required|in:draft,published',
            'date' => 'required|date',
            'expires_at' => 'nullable|date|after:date',
            'description' => 'required|string',
            'content' => 'required|string',
            'author' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada dan bukan URL
            if ($announcement->image && !filter_var($announcement->image, FILTER_VALIDATE_URL)) {
                Storage::disk('public')->delete($announcement->image);
            }
            $data['image'] = $request->file('image')->store('announcements', 'public');
        }

        $announcement->update($data);

        return redirect()->route('announcements.index')->with('success', 'Pengumuman berhasil diperbarui!');
    }

}