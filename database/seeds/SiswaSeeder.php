<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SiswaSeeder extends Seeder
{
    public function run()
    {
        $userId = 1;
        $year   = Carbon::now()->year;

        // ===============================
        // BULAN (INDONESIA)
        // ===============================
        $bulanUrut = [
            1  => 'Bulan Pertama (Januari)',
            2  => 'Bulan Kedua (Februari)',
            3  => 'Bulan Ketiga (Maret)',
            4  => 'Bulan Keempat (April)',
            5  => 'Bulan Kelima (Mei)',
            6  => 'Bulan Keenam (Juni)',
            7  => 'Bulan Ketujuh (Juli)',
            8  => 'Bulan Kedelapan (Agustus)',
            9  => 'Bulan Kesembilan (September)',
            10 => 'Bulan Kesepuluh (Oktober)',
            11 => 'Bulan Kesebelas (November)',
            12 => 'Bulan Kedua Belas (Desember)',
        ];

        // ===============================
        // NAMA SISWA INDONESIA
        // ===============================
        $namaSiswa = [
            'Ahmad Fauzi',
            'Muhammad Rizki',
            'Rizal Mukhaimin',
            'Andi Pratama',
            'Budi Santoso',
            'Dimas Saputra',
            'Agus Setiawan',
            'Fajar Maulana',
            'Hendra Wijaya',
            'Ilham Ramadhan',
            'Aisyah Putri',
            'Siti Nurhaliza',
            'Putri Ayu Lestari',
            'Dewi Anggraini',
            'Nur Aulia',
            'Rina Safitri'
        ];

        // ===============================
        // RESET DATA
        // ===============================
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('credit')->truncate();
        DB::table('debit')->truncate();
        DB::table('categories_credit')->truncate();
        DB::table('categories_debit')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        shuffle($namaSiswa);
        $siswaTerpilih = array_slice($namaSiswa, 0, rand(10, 12));

        foreach ($siswaTerpilih as $siswaName) {

            $creditCategoryId = DB::table('categories_credit')->insertGetId([
                'user_id' => $userId,
                'name'    => $siswaName,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $debitCategoryId = DB::table('categories_debit')->insertGetId([
                'user_id' => $userId,
                'name'    => $siswaName,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // ===============================
            // TRANSAKSI BULANAN (SELISIH KECIL)
            // ===============================
            for ($month = 1; $month <= 12; $month++) {

                // Debit (masuk)
                $debitNominal = rand(50_000, 100_000);

                // Credit (keluar) -> hampir sama
                $creditNominal = $debitNominal - rand(1_000, 3_000);

                DB::table('debit')->insert([
                    'user_id'     => $userId,
                    'category_id' => $debitCategoryId,
                    'nominal'     => $debitNominal,
                    'description' => "Pembayaran {$siswaName} - {$bulanUrut[$month]}",
                    'debit_date'  => Carbon::create($year, $month, rand(1, 28)),
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ]);

                DB::table('credit')->insert([
                    'user_id'     => $userId,
                    'category_id' => $creditCategoryId,
                    'nominal'     => $creditNominal,
                    'description' => "Pengeluaran {$siswaName} - {$bulanUrut[$month]}",
                    'credit_date' => Carbon::create($year, $month, rand(1, 28)),
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ]);
            }
        }
    }
}
