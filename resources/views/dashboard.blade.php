<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <!-- NAVBAR -->
    <nav>
        <a href="{{ route('dashboard') }}">Dashboard</a> |
        <a href="{{ route('profile.edit') }}">Profile</a> |
        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
            @csrf
            <button type="submit">Keluar</button>
        </form>
    </nav>
    
    <hr>
    
    <h1>Selamat Datang di Dashboard</h1>
    
    @if(session('success'))
        <p><strong>{{ session('success') }}</strong></p>
    @endif
    
    <!-- Tampilkan foto profile jika ada -->
    @if(Auth::user()->photo)
        <div>
            <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="Foto Profile" width="100" height="100">
        </div>
        <br>
    @endif
    
    <p><strong>Nama:</strong> {{ Auth::user()->name }}</p>
    <p><strong>Username:</strong> {{ Auth::user()->username }}</p>
    <p><strong>Role:</strong> {{ ucfirst(Auth::user()->role->name) }}</p>
    
    <hr>
    
    @if(Auth::user()->role->name === 'admin')
        <h1>HALAMAN KHUSUS ADMIN</h1>
        
        <h2>Menu Kelola</h2>
        <ul>
            <li><a href="{{ route('users.index') }}">Kelola Data User</a></li>
            <li>Kelola Data Mahasiswa</li>
            <li>Kelola Data Dosen</li>
            <li>Kelola Mata Kuliah</li>
            <li>Kelola Jadwal</li>
            <li>Laporan dan Statistik</li>
        </ul>
    @elseif(Auth::user()->role->name === 'mahasiswa')
        <h1>HALAMAN KHUSUS MAHASISWA</h1>
        
        <h2>Jadwal Kuliah Anda</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>Hari</th>
                    <th>Waktu</th>
                    <th>Mata Kuliah</th>
                    <th>Ruangan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Senin</td>
                    <td>08:00 - 10:00</td>
                    <td>Pemrograman Web</td>
                    <td>Lab Komputer 1</td>
                </tr>
                <tr>
                    <td>Selasa</td>
                    <td>10:00 - 12:00</td>
                    <td>Basis Data</td>
                    <td>Ruang 301</td>
                </tr>
                <tr>
                    <td>Rabu</td>
                    <td>13:00 - 15:00</td>
                    <td>Sistem Operasi</td>
                    <td>Lab Komputer 2</td>
                </tr>
            </tbody>
        </table>
    @endif
</body>
</html>
