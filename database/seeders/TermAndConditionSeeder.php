<?php

namespace Database\Seeders;

use App\Models\Term_and_condition;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TermAndConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        Term_and_condition::create([
            'name' => 'Definisi', 
            'description' => '
            Dalam syarat dan ketentuan ini, yang dimaksud dengan:
            "Aplikasi Sistem Informasi Pariwisata Kabupaten Indramayu" adalah aplikasi berbasis web dan mobile yang dikembangkan oleh Pemerintah Kabupaten Indramayu untuk memberikan informasi dan layanan pariwisata kepada masyarakat.
            "Pengguna" adalah setiap orang yang menggunakan Aplikasi Sistem Informasi Pariwisata Kabupaten Indramayu.
            '
        ]);        
        Term_and_condition::create([
            'name' => 'Ketentuan Umum', 
            'description' => '
            Pengguna wajib membaca dan memahami syarat dan ketentuan ini sebelum menggunakan Aplikasi Sistem Informasi Pariwisata Kabupaten Indramayu.
            Dengan menggunakan Aplikasi Sistem Informasi Pariwisata Kabupaten Indramayu, pengguna dianggap telah menyetujui syarat dan ketentuan ini.
            '
        ]);        
        Term_and_condition::create([
            'name' => 'Hak dan Kewajiban Pengguna', 
            'description' => '
            Pengguna memiliki hak untuk menggunakan Aplikasi Sistem Informasi Pariwisata Kabupaten Indramayu sesuai dengan ketentuan yang berlaku.
            Pengguna wajib menjaga keamanan dan kerahasiaan data pribadinya.
            Pengguna dilarang menggunakan Aplikasi Sistem Informasi Pariwisata Kabupaten Indramayu untuk tujuan yang melanggar hukum atau merugikan pihak lain.
            '
        ]);
        Term_and_condition::create([
            'name' => 'Hak dan Kewajiban Pemerintah Kabupaten Indramayu',
            'description' => 'Pemerintah Kabupaten Indramayu memiliki hak untuk mengelola dan mengembangkan Aplikasi Sistem Informasi Pariwisata Kabupaten Indramayu.
            Pemerintah Kabupaten Indramayu memiliki hak untuk memantau dan mengawasi penggunaan Aplikasi Sistem Informasi Pariwisata Kabupaten Indramayu.
            Pemerintah Kabupaten Indramayu berhak untuk memblokir akses pengguna yang melanggar syarat dan ketentuan ini.',
        ]);
        Term_and_condition::create([
            'name' => 'Layanan yang Disediakan',
            'description' => 'Aplikasi Sistem Informasi Pariwisata Kabupaten Indramayu menyediakan layanan-layanan berikut:
            Informasi tentang pariwisata Kabupaten Indramayu, termasuk destinasi wisata, akomodasi, transportasi, dan kuliner.
            Layanan reservasi online untuk akomodasi dan transportasi.
            Layanan umpan balik dari pengguna.',

        ]);
        Term_and_condition::create([
            'name' => 'Perubahan Syarat dan Ketentuan',
            'description' => 'Pemerintah Kabupaten Indramayu berhak untuk mengubah syarat dan ketentuan ini sewaktu-waktu. Perubahan syarat dan ketentuan akan diumumkan di situs web resmi Pemerintah Kabupaten Indramayu.',
        ]);
        Term_and_condition::create([
            'name' => 'Penyelesaian Sengketa',
            'description' => 'Segala perselisihan yang timbul sehubungan dengan penggunaan Aplikasi Sistem Informasi Pariwisata Kabupaten Indramayu akan diselesaikan secara musyawarah mufakat. Apabila musyawarah mufakat tidak dapat dicapai, maka perselisihan akan diselesaikan melalui pengadilan yang berwenang.',
        ]);
        Term_and_condition::create([
            'name' => 'Kebijakan Privasi',
            'description' => 'Kebijakan privasi Aplikasi Sistem Informasi Pariwisata Kabupaten Indramayu mengatur bagaimana Pemerintah Kabupaten Indramayu mengumpulkan, menggunakan, dan melindungi data pribadi pengguna. Kebijakan privasi dapat diakses di situs web resmi Pemerintah Kabupaten Indramayu.',
        ]);
        Term_and_condition::create([
            'name' => 'Lain-lain',
            'description' => 'Apabila terdapat ketentuan dalam syarat dan ketentuan ini yang bertentangan dengan hukum yang berlaku, maka ketentuan yang bertentangan tersebut tidak berlaku dan akan diganti dengan ketentuan yang sesuai dengan hukum yang berlaku.',
        ]);
        Term_and_condition::create([
            'name' => 'Ketentuan Tambahan untuk Aplikasi Web',
            'description' => 'Pengguna bertanggung jawab untuk menyediakan perangkat dan koneksi internet yang memadai untuk menggunakan Aplikasi Sistem Informasi Pariwisata Kabupaten Indramayu.
            Pengguna bertanggung jawab untuk menjaga keamanan dan kerahasiaan kata sandi dan informasi akun lainnya.',
        ]);
        Term_and_condition::create([
            'name' => 'Ketentuan Tambahan untuk Aplikasi Mobile',
            'description' => 'Pengguna bertanggung jawab untuk mengunduh dan menginstal aplikasi dari sumber yang resmi.
            Pengguna bertanggung jawab untuk menjaga keamanan dan kerahasiaan perangkat selulernya.',
        ]);
        Term_and_condition::create([
            'name' => 'Penutup',
            'description' => 'Dengan menggunakan Aplikasi Sistem Informasi Pariwisata Kabupaten Indramayu, pengguna dianggap telah menyetujui syarat dan ketentuan ini.',
        ]);
    }
}
