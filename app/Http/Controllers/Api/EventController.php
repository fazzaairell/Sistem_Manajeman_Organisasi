<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    public function updateDate(Request $request, Event $event)
    {
        $validator = Validator::make($request->all(), [
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after_or_equal:start_date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validasi gagal',
                'errors'  => $validator->errors()
            ], 422);
        }

        $event->update([
            'start_date' => $request->start_date,
            'end_date'   => $request->end_date,
        ]);

        return response()->json([
            'message' => 'Tanggal event berhasil diperbarui',
            'data' => $event
        ]);
    }
}
