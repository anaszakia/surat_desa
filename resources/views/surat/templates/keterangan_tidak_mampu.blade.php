<!DOCTYPE html>
<html>
<head>
    <title>Surat Keterangan Tidak Mampu</title>
    <style>
        body { font-family: 'Times New Roman', Times, serif; line-height: 1.6; }
        .header { text-align: center; margin-bottom: 20px; }
        .content { margin: 0 auto; max-width: 800px; }
        .nomor-surat { text-align: right; }
        .body { margin-top: 30px; margin-left: 70px; text-align: justify; }
        .footer { margin-top: 50px; display: flex; justify-content: flex-end; }
        .footer-content { text-align: center; width: 300px; }
        .underline { text-decoration: underline; }
        .bold { font-weight: bold; }

        @media print {
            body {
                margin: 0;
                padding: 0;
            }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="content">
        <div class="header">
            <div class="bold">PEMERINTAH KABUPATEN PATI</div>
            <div class="bold">KECAMATAN JAKEN</div>
            <div class="bold">DESA SUMBEREJO</div>
        </div>

        <div class="body">
            <p style="text-align: center; text-transform: uppercase;" class="bold underline">{{ $surat->kategori->nama }}</p>
             <div class="nomor-surat" style="text-align: center">
                <div>Nomor: {{ $surat->nomor_surat }}</div>
            </div>
            
            <p>Yang bertanda tangan di bawah ini, menerangkan bahwa:</p>
            
            <table style="margin-left: 50px;">
                <tr>
                    <td>Nama</td>
                    <td>: {{ $surat->nama_lengkap }}</td>
                </tr>
                <tr>
                    <td>NIK</td>
                    <td>: {{ $surat->nik }}</td>
                </tr>
                <tr>
                <tr>
                    <td>Tempat/Tanggal Lahir</td>
                    <td>: {{ $surat->tempat_lahir }}, {{ \Carbon\Carbon::parse($surat->tanggal_lahir)->translatedFormat('d F Y') }}</td>
                </tr>
                <tr>
                <tr>
                    <td>Agama</td>
                    <td>: {{ $surat->agama }}</td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>: {{ $surat->jenis_kelamin }}</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>: {{ $surat->alamat }}</td>
                </tr>
                <tr>
                    <td>Pekerjaan</td>
                    <td>: {{ $surat->pekerjaan }}</td>
                </tr>
            </table>
            
            <p style="margin-top: 20px;">
                Adalah benar-benar warga kami yang berdomisili di wilayah kami dan termasuk keluarga tidak mampu.
            </p>
            
            <p>
                Surat keterangan ini diberikan untuk keperluan <strong>{{ $surat->keperluan ?? '-' }}</strong>.
            </p>
            
            <p>
                Demikian surat keterangan ini dibuat dengan sebenarnya untuk dapat dipergunakan sebagaimana mestinya.
            </p>
        </div>

        <div class="footer">
            <div class="footer-content">
                <div>Sumberejo, {{ \Carbon\Carbon::parse($surat->tanggal_terbit)->translatedFormat('d F Y') }}</div>
                <div>Mengetahui,</div>
                <div>{{ $surat->ttd->jabatan ?? 'Jabatan Tidak Tersedia' }}</div>
                <div style="height: 80px;"></div>
                <div class="bold underline"><strong>{{ $surat->ttd->nama ?? 'Nama Tidak Tersedia' }}</strong></div>
            </div>
        </div>
    </div>
</body>
</html>
