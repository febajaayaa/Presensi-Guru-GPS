<!DOCTYPE html>
<html>
<head>
    <title>Rekap Presensi Guru</title>

    <style>
        body{
            font-family: sans-serif;
        }

        table{
            width:100%;
            border-collapse: collapse;
            margin-top:20px;
        }

        th, td{
            border:1px solid #000;
            padding:8px;
            text-align:center;
        }

        th{
            background:#f2f2f2;
        }
    </style>
</head>
<body>

    <h2>Rekap Kehadiran Guru</h2>

    <p>
        Bulan: {{ $bulan }} / {{ $tahun }}
    </p>

    <table>

        <thead>
            <tr>
                <th>No</th>
                <th>Nama Guru</th>
                <th>Hadir</th>
                <th>Terlambat</th>
                <th>Sakit</th>
                <th>Izin</th>
                <th>Total</th>
                <th>Persentase</th>
            </tr>
        </thead>

        <tbody>

            @forelse($rekap as $item)

            <tr>

                <td>
                    {{ $loop->iteration }}
                </td>

                <td>
                    {{ $item['nama'] }}
                </td>

                <td>
                    {{ $item['hadir'] }}
                </td>

                <td>
                    {{ $item['terlambat'] }}
                </td>

                <td>
                    {{ $item['sakit'] }}
                </td>

                <td>
                    {{ $item['izin'] }}
                </td>

                <td>
                    {{ $item['total'] }}
                </td>

                <td>
                    {{ $item['persen'] }}%
                </td>

            </tr>

            @empty

            <tr>
                <td colspan="8">
                    Tidak ada data rekap
                </td>
            </tr>

            @endforelse

        </tbody>

    </table>

</body>
</html>