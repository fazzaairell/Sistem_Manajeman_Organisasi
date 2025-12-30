<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Event</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Arial', sans-serif;
            font-size: 10px;
            line-height: 1.4;
            color: #333;
        }
        .header {
            text-align: center;
            padding: 15px 0;
            border-bottom: 3px solid #1e40af;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 18px;
            color: #1e40af;
            margin-bottom: 5px;
        }
        .header p {
            font-size: 10px;
            color: #666;
        }
        .meta-info {
            margin-bottom: 15px;
            font-size: 9px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
            color: white;
            padding: 8px 6px;
            text-align: left;
            font-size: 9px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }
        td {
            padding: 8px 6px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 9px;
        }
        tr:nth-child(even) {
            background-color: #f9fafb;
        }
        .status {
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 8px;
            font-weight: 600;
            display: inline-block;
        }
        .status-upcoming { background: #dbeafe; color: #1e40af; }
        .status-ongoing { background: #d1fae5; color: #065f46; }
        .status-completed { background: #f3f4f6; color: #6b7280; }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 8px;
            color: #9ca3af;
            padding-top: 10px;
            border-top: 1px solid #e5e7eb;
        }
        .no-data {
            text-align: center;
            padding: 30px;
            color: #9ca3af;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN DATA EVENT</h1>
        <p>Sistem Manajemen Organisasi</p>
    </div>

    <div class="meta-info">
        <p><strong>Tanggal Cetak:</strong> {{ date('d F Y, H:i') }} WIB</p>
        <p><strong>Total Event:</strong> {{ $events->count() }} event</p>
    </div>

    @if($events->count() > 0)
        <table>
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 30%;">Judul Event</th>
                    <th style="width: 15%;">Tanggal Mulai</th>
                    <th style="width: 15%;">Tanggal Selesai</th>
                    <th style="width: 20%;">Penanggung Jawab</th>
                    <th style="width: 15%;">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($events as $index => $event)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td><strong>{{ $event->title }}</strong></td>
                        <td>{{ \Carbon\Carbon::parse($event->start_date)->format('d M Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($event->end_date)->format('d M Y') }}</td>
                        <td>{{ $event->penanggung_jawab }}</td>
                        <td>
                            <span class="status status-{{ $event->status }}">
                                {{ ucfirst($event->status) }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="no-data">
            <p>Tidak ada data event yang tersedia</p>
        </div>
    @endif

    <div class="footer">
        <p>Dokumen ini digenerate otomatis oleh sistem | © {{ date('Y') }} Sistem Manajemen Organisasi</p>
    </div>
</body>
</html>
