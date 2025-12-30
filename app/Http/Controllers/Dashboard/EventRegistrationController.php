<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\EventRegistration;
use App\Models\Event;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class EventRegistrationController extends Controller
{
    /**
     * Display all event registrations with filters
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');
        $eventId = $request->input('event_id');

        $registrations = EventRegistration::with(['event', 'user', 'reviewer'])
            ->when($search, function ($query, $search) {
                return $query->whereHas('user', function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
                })->orWhereHas('event', function($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%");
                });
            })
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->when($eventId, function ($query, $eventId) {
                return $query->where('event_id', $eventId);
            })
            ->latest('registered_at')
            ->paginate(15);

        $events = Event::orderBy('title')->get();
        $stats = [
            'pending' => EventRegistration::pending()->count(),
            'approved' => EventRegistration::approved()->count(),
            'rejected' => EventRegistration::rejected()->count(),
            'total' => EventRegistration::count(),
        ];

        return view('dashboard.event-registrations.index', compact('registrations', 'events', 'stats'));
    }

    /**
     * Show registration detail
     */
    public function show(EventRegistration $eventRegistration)
    {
        $eventRegistration->load(['event', 'user', 'reviewer']);
        return view('dashboard.event-registrations.show', compact('eventRegistration'));
    }

    /**
     * Approve registration
     */
    public function approve(Request $request, EventRegistration $eventRegistration)
    {
        $request->validate([
            'admin_notes' => 'nullable|string|max:500'
        ]);

        $eventRegistration->approve(auth()->id(), $request->admin_notes);

        return redirect()->back()->with('success', 'Pendaftaran berhasil disetujui!');
    }

    /**
     * Reject registration
     */
    public function reject(Request $request, EventRegistration $eventRegistration)
    {
        $request->validate([
            'admin_notes' => 'required|string|max:500'
        ], [
            'admin_notes.required' => 'Catatan/alasan penolakan wajib diisi.'
        ]);

        $eventRegistration->reject(auth()->id(), $request->admin_notes);

        return redirect()->back()->with('success', 'Pendaftaran berhasil ditolak!');
    }

    /**
     * Bulk approve registrations
     */
    public function bulkApprove(Request $request)
    {
        $request->validate([
            'registration_ids' => 'required|array',
            'registration_ids.*' => 'exists:event_registrations,id'
        ]);

        EventRegistration::whereIn('id', $request->registration_ids)
            ->pending()
            ->each(function($registration) {
                $registration->approve(auth()->id());
            });

        return redirect()->back()->with('success', count($request->registration_ids) . ' pendaftaran berhasil disetujui!');
    }

    /**
     * Export to PDF
     */
    public function exportPdf(Request $request)
    {
        $status = $request->input('status');
        $eventId = $request->input('event_id');

        $registrations = EventRegistration::with(['event', 'user', 'reviewer'])
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->when($eventId, function ($query, $eventId) {
                return $query->where('event_id', $eventId);
            })
            ->latest('registered_at')
            ->get();

        $pdf = Pdf::loadView('dashboard.event-registrations.pdf', compact('registrations'))
            ->setPaper('a4', 'landscape');
        
        return $pdf->download('laporan-pendaftaran-event-' . date('Y-m-d') . '.pdf');
    }
}
