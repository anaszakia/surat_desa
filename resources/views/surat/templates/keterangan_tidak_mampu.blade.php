<!DOCTYPE html>
<html>
<head>
    <title>Surat Keterangan Tidak Mampu</title>
    <style>
        body { font-family: 'Times New Roman', Times, serif; line-height: 1.6; }
        .header { text-align: center; margin-bottom: 20px; }
        .content { margin: 0 auto; max-width: 800px; }
        .nomor-surat { text-align: right; }
        .body { margin-top: 30px; text-align: justify; }
        .footer { margin-top: 50px; display: flex; justify-content: flex-end; }
        .footer-content { text-align: center; width: 300px; }
        .underline { text-decoration: underline; }
        .bold { font-weight: bold; }
    </style>
</head>
<body>
    <div class="content">
        <div class="header">
            <div class="bold">PEMERINTAH KABUPATEN PATI</div>
            <div class="bold">KECAMATAN JAKEN</div>
            <div class="bold">DESA SUMBEREJO</div>
        </div>

        <div class="body">
            <p style="text-align: center;" class="bold underline">SURAT KETERANGAN TIDAK MAMPU</p>
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
                    <td>Alamat</td>
                    <td>: {{ $surat->alamat }}</td>
                </tr>
            </table>
            
            <p style="margin-top: 20px;">
                Adalah benar-benar warga kami yang berdomisili di wilayah kami dan termasuk keluarga tidak mampu.
            </p>
            
            <p>
                Surat keterangan ini diberikan untuk keperluan {{ $surat->data_lainnya ?? '-' }}.
            </p>
            
            <p>
                Demikian surat keterangan ini dibuat dengan sebenarnya untuk dapat dipergunakan sebagaimana mestinya.
            </p>
        </div>

        <div class="footer">
            <div class="footer-content">
                <div>Sumberejo, {{ date('d M Y', strtotime($surat->tanggal_terbit)) }}</div>
                <div>Mengetahui,</div>
                <div style="height: 80px;"></div>
                <div class="bold underline">(Amran Hadi, S.Kom)</div>
            </div>
        </div>
    </div>
</body>
</html>