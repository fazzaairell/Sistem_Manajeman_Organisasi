<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pengumuman</title>
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
            border-bottom: 3px solid #059669;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 18px;
            color: #059669;
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
            background: linear-gradient(135deg, #059669 0%, #10b981 100%);
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
        .badge {
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 7px;
            font-weight: 600;
            display: inline-block;
            margin-right: 3px;
        }
        /* Category badges */
        .cat-prestasi { background: #fef3c7; color: #92400e; }
        .cat-akademik { background: #dbeafe; color: #1e40af; }
        .cat-event { background: #d1fae5; color: #065f46; }
        .cat-teknis { background: #fee2e2; color: #991b1b; }
        .cat-sertifikat { background: #e0e7ff; color: #3730a3; }
        .cat-pendaftaran { background: #fce7f3; color: #831843; }
        .cat-umum { background: #f3f4f6; color: #374151; }
        
        /* Priority badges */
        .priority-urgent { background: #fee2e2; color: #991b1b; }
        .priority-penting { background: #fed7aa; color: #92400e; }
        .priority-normal { background: #e5e7eb; color: #374151; }
        
        /* Status badges */
        .status-published { background: #d1fae5; color: #065f46; }
        .status-draft { background: #fef3c7; color: #92400e; }
        
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
        <h1>LAPORAN DATA PENGUMUMAN</h1>
        <p>Sistem Manajemen Organisasi</p>
    </div>

    <div class="meta-info">
        <p><strong>Tanggal Cetak:</strong> {{ date('d F Y, H:i') }} WIB</p>
        <p><strong>Total Pengumuman:</strong> {{ $announcements->count() }} pengumuman</p>
    </div>

    @if($announcements->count() > 0)
        <table>
            <thead>
                <tr>
                    <th style="width: 4%;">No</th>
                    <th style="width: 28%;">Judul</th>
                    <th style="width: 12%;">Kategori</th>
                    <th style="width: 12%;">Tanggal</th>
                    <th style="width: 15%;">Author</th>
                    <th style="width: 10%;">Priority</th>
                    <th style="width: 10%;">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($announcements as $index => $announcement)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td><strong>{{ $announcement->title }}</strong></td>
                        <td>
                            <span class="badge cat-{{ strtolower($announcement->category) }}">
                                {{ $announcement->category }}
                            </span>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($announcement->date)->format('d M Y') }}</td>
                        <td>{{ $announcement->author }}</td>
                        <td>
                            <span class="badge priority-{{ $announcement->priority }}">
                                {{ ucfirst($announcement->priority) }}
                            </span>
                        </td>
                        <td>
                            <span class="badge status-{{ $announcement->status }}">
                                {{ ucfirst($announcement->status) }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="no-data">
            <p>Tidak ada data pengumuman yang tersedia</p>
        </div>
    @endif

    <div class="footer">
        <p>Dokumen ini digenerate otomatis oleh sistem | © {{ date('Y') }} Sistem Manajemen Organisasi</p>
    </div>
</body>
</html>
