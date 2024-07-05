<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HistorySeeder extends Seeder
{
    public function run()
    {
        DB::table('histories')->insert([
            ['title' => 'Toko Puncak', 'description' => 'Kejayaan PT. JMPS diawali dengan berdirinya toko konveksi, yakni Toko Puncak pada tahun 1978. Toko ini berdiri dengan kokoh selama lebih kurang sepuluh tahun. Namun pada akhirnya tahun 1988 tidak diteruskan karena habis masa kontraknya.', 'date' => '1978-01-01'],
            ['title' => 'JM Fashion Shop', 'description' => 'Terhitung 5 tahun sejak pembukaan toko pertamanya, Bapak Yusuf Masawan mendirikan satu toko lagi, yakni JM Fashion Shop tepatnya pada 8 April 1983 dan bertahan hingga tahun 1988 karena tidak diteruskan lagi masa kontraknya.', 'date' => '1983-04-08'],
            ['title' => 'Ratu Fashion', 'description' => 'Pada 8 April 1984, berdiri lagi satu toko bernama Ratu Fashion, dan hanya bertahan hingga tahun 1988 karena mengalami musibah kebakaran sehingga tidak lagi beroperasi.', 'date' => '1984-04-08'],
            ['title' => 'President Dept. Store', 'description' => 'Dengan konsep yang sama pada 8 April 1985 berdiri lagi satu pusat perbelanjaan di Makmur Shopping Center yang bernama President Dept. Store tetapi karena musibah kebakaran pada tahun 1988 akhirnya toko ini ditutup.', 'date' => '1985-04-08'],
            ['title' => 'Pasaraya Bandung', 'description' => 'Pada April 1989 didirikan satu outlet lagi bernama Pasaraya Bandung. Walaupun masih berdiri dengan kokoh hingga saat ini, tetapi pada tahun 1998 outlet Pasaraya Bandung pernah mengalami musibah kebakaran. Namun akhirnya saat memasuki tahun 2000 Pasaraya Bandung dibuka kembali untuk umum.', 'date' => '1989-04-01'],
            ['title' => 'JM Kenten Supermarket & Dept. Store', 'description' => 'Memasuki usia ke-25 tahun PT. JMPS semakin kokoh dengan menambah satu outlet lagi yakni JM Kenten Supermarket & Dept. Store yang dibuka pada tanggal 30 Oktober 2003 dan bertahan hingga saat ini.', 'date' => '2003-10-30'],
            ['title' => 'Grand JM', 'description' => 'Pada tahun 2004 PT. JMPS kembali membuka outlet yang menghadirkan nuansa Mall yang elegan, tetapi tetap dengan harga terjangkau dan mutu yang baik. Outlet ini diberi nama Grand JM yang diresmikan pada bulan Agustus 2004.', 'date' => '2004-08-01'],
            ['title' => 'JM Sukarami Supermarket & Dept. Store', 'description' => 'Pada tanggal 28 Juli 2010, diresmikan satu outlet lagi, yaitu JM Sukarami Supermarket & Dept. Store dan tepat pada 15 Juli 2012 outlet JM Sukarami secara resmi mengalami perluasan.', 'date' => '2010-07-28'],
            ['title' => 'JM Plaju Supermarket & Dept. Store', 'description' => 'Pada tanggal 7 Juli 2011 diresmikan satu outlet lagi, yaitu JM Plaju Supermarket & Dept. Store. Outlet ini diresmikan langsung oleh Walikota Palembang, Ir. H. Eddy Santana Putra, MT.', 'date' => '2011-07-07'],
            ['title' => 'JM Linggau Supermarket & Dept. Store', 'description' => 'Outlet terus bertambah. Berekspansi keluar kota Palembang, dibuka satu outlet lagi, yaitu JM Linggau Supermarket & Dept. Store yang diresmikan pada tanggal 28 Juni 2012.', 'date' => '2012-06-28'],
            ['title' => 'JM Lemabang Supermarket & Dept.Store', 'description' => 'Pada 5 Desember 2018 diresmikan JM Lemabang Supermarket & Dept.Store.', 'date' => '2018-12-05'],
            ['title' => 'Central Market Sako', 'description' => 'Outlet yang termuda saat ini adalah Central Market Sako yang diresmikan pada tanggal 01 Februari 2024. Keberadaan outlet-outlet tersebut diharapkan dapat memenuhi kebutuhan konsumen di daerah sekitarnya.', 'date' => '2024-02-01']
        ]);
    }
}

