<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Donasi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 24px;
            margin: 0;
        }
        .table-container {
            margin: 20px auto;
            width: 90%;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        .text-center {
            text-align: center;
        }
        .highlight {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

    <div class="header">
        <h1>Riwayat Donasi</h1>
        <p>{{ now()->format('d F Y') }}</p>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Nama Donatur</th>
                    <th>Nama Donasi</th>
                    <th>Jumlah Donasi</th>
                    <th>Pesan</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksiDonasi as $transaksi)
                <tr class="{{ $loop->index % 2 == 0 ? 'highlight' : '' }}">
                    <td class="py-2">{{ $transaksi->nama }}</td>
                    <td class="py-2">{{ $transaksi->kegiatan_id }}</td>
                    <td class="py-2">Rp {{ number_format($transaksi->jumlah_donasi, 2) }}</td>
                    <td class="py-2">{{ $transaksi->pesan }}</td>
                    <td class="py-2">{{ ucfirst($transaksi->status) }}</td>
                    <td class="py-2">{{ $transaksi->created_at->format('d-m-Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <button id="exportPdf" class="bg-blue-500 text-white px-4 py-2 rounded">Export to PDF</button>

        <script>
            document.getElementById('exportPdf').addEventListener('click', () => {
                // Import jsPDF
                const { jsPDF } = window.jspdf;
                const doc = new jsPDF();
        
                // Add a title
                doc.setFontSize(18);
                doc.text("Riwayat Donasi", 10, 10);
        
                // Fetch the table
                const table = document.querySelector("table");
        
                // Extract the table data
                let rows = [];
                table.querySelectorAll("tr").forEach((row) => {
                    let cells = Array.from(row.querySelectorAll("th, td")).map(cell => cell.innerText.trim());
                    rows.push(cells);
                });
        
                // Add table to PDF
                let startY = 20;
                rows.forEach((row, i) => {
                    row.forEach((cell, j) => {
                        doc.text(cell, 10 + j * 40, startY + i * 10); // Adjust x, y positions
                    });
                });
        
                // Save or download the PDF
                doc.save("riwayat_donasi.pdf");
            });
        </script>
        

    </div>
    
</body>
</html>
