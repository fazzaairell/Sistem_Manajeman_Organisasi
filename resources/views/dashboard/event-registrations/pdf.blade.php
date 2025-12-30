<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pendaftaran Event</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; font-size: 10px; color: #333; }
        .header { text-align: center; padding: 15px 0; border-bottom: 3px solid #4f46e5; margin-bottom: 20px; }
        .header h1 { font-size: 18px; color: #4f46e5; margin-bottom: 5px; }
        .header p { font-size: 10px; color: #666; }
        .meta-info { margin-bottom: 15px; font-size: 9px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%); color: white; padding: 8px 6px; text-align: left; font-size: 9px; font-weight: 600; text-transform: uppercase; }
        td { padding: 8px 6px; border-bottom: 1px solid #e5e7eb; font-size: 9px; }
        tr:nth-child(even) { background-color: #f9fafb; }
        .badge { padding: 3px 8px; border-radius: 12px; font-size: 7px; font-weight: 600; display: inline-block; }
        .status-pending { background: #fef3c7; color: #92400e; }
        .status-approved { background: #d1fae5; color: #065f46; }
        .status-rejected { background: #fee2e2; color: #991b1b; }
        .footer { margin-top: 20px; text-align: center; font-size: 8px; color: #9ca3af; padding-top: 10px; border-top: 1px solid #e5e7eb; }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN PENDAFTARAN EVENT</h1>
        <p>Sistem Manajemen Organisasi</p>
    </div>

    <div class="meta-info">
        <p><strong>Tanggal Cetak:</strong> {{ date('d F Y, H:i') }} WIB</p>
        <p><strong>Total Pendaftaran:</strong> {{ $registrations->count() }}</p>
    </div>

    @if($registrations->count() > 0)
        <table>
            <thead>
                <tr>
                    <th style="width: 4%;">No</th>
                    <th style="width: 22%;">Nama Peserta</th>
                    <th style="width: 18%;">Email</th>
                    <th style="width: 25%;">Event</th>
                    <th style="width: 13%;">Tanggal Daftar</th>
                    <th style="width: 10%;">Status</th>
                    <th style="width: 8%;">NRP</th>
                </tr>
            </thead>
            <tbody>
                @foreach($registrations as $index => $reg)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td><strong>{{ $reg->user->name }}</strong></td>
                        <td>{{ $reg->user->email }}</td>
                        <td>{{ $reg->event->title }}</td>
                        <td>{{ $reg->registered_at->format('d M Y H:i') }}</td>
                        <td>
                            <span class="badge status-{{ $reg->status }}">
                                {{ ucfirst($reg->status) }}
                            </span>
                        </td>
                        <td>{{ $reg->user->nrp ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p style="text-align: center; padding: 30px; color: #9ca3af;">Tidak ada data pendaftaran</p>
    @endif

    <div class="footer">
        <p>Dokumen ini digenerate otomatis oleh sistem | © {{ date('Y') }} Sistem Manajemen Organisasi</p>
    </div>
</body>
</html>
