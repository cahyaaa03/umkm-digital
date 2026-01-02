<!DOCTYPE html>
<html>
<head>
    <title>Struk Pencairan Modal</title>
    <style>
        body { font-family: sans-serif; line-height: 1.5; color: #333; }
        .container { width: 100%; border: 1px solid #ddd; padding: 20px; }
        .header { text-align: center; border-bottom: 2px solid #444; padding-bottom: 10px; margin-bottom: 20px; }
        .status { color: #059669; font-weight: bold; text-transform: uppercase; border: 1px solid #059669; display: inline-block; padding: 5px 10px; margin-top: 10px; }
        table { width: 100%; margin-top: 20px; }
        td { padding: 8px 0; border-bottom: 1px solid #eee; }
        .label { color: #666; width: 150px; }
        .total { font-size: 1.2em; font-weight: bold; }
        .footer { margin-top: 30px; font-size: 0.8em; color: #999; text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2 style="margin:0;">BUKTI PENCAIRAN MODAL</h2>
            <p style="margin:5px 0;">Sistem Pembiayaan UMKM Digital</p>
            <div class="status">Berhasil / Success</div>
        </div>

        <table>
            <tr>
                <td class="label">ID Transaksi</td>
                <td>#PM-{{ str_pad($pinjam->id, 5, '0', STR_PAD_LEFT) }}</td>
            </tr>
            <tr>
                <td class="label">Nama Usaha</td>
                <td>{{ $pinjam->umkm->nama_usaha }}</td>
            </tr>
            <tr>
                <td class="label">Tanggal Cair</td>
                <td>{{ \Carbon\Carbon::parse($pinjam->tanggal_pinjam)->format('d F Y H:i') }} WIB</td>
            </tr>
            <tr>
                <td class="label">Bank Tujuan</td>
                <td>{{ $pinjam->umkm->nama_bank ?? 'Bank Default' }}</td>
            </tr>
            <tr>
                <td class="label">No. Rekening</td>
                <td>{{ $pinjam->umkm->nomor_rekening ?? 'XXXXXXXX' }}</td>
            </tr>
            <tr>
                <td class="label">Jatuh Tempo</td>
                <td>{{ \Carbon\Carbon::parse($pinjam->tenggat_waktu)->format('d F Y') }}</td>
            </tr>
            <tr class="total">
                <td class="label">Jumlah Cair</td>
                <td style="color: #2563eb;">Rp {{ number_format($pinjam->jumlah_pinjaman, 0, ',', '.') }}</td>
            </tr>
        </table>

        <div class="footer">
            <p>Struk ini dihasilkan secara otomatis oleh sistem dan berlaku sebagai bukti transfer yang sah dalam simulasi ini.</p>
            <p>&copy; 2026 Project Tugas UMKM</p>
        </div>
    </div>
</body>
</html>