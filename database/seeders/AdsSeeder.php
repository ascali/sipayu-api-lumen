<?php

namespace Database\Seeders;

use App\Models\Advertisment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $image_sample = $this->uploadToStorage('data:image/png;base64,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');
        Advertisment::create([
            'name' => 'Iklan Paket Wisata WA',
            'type' => 'wa',
            'image' => $image_sample,
            'url' => "https://wa.me/+6285624277920?text=I'm%20interested%20in%20your%20car%20for%20sale",
            'description' => 'wa',
            'efective' => '2023-12-12',
            'expired' => '2024-12-12',
            'latitude' => '',
            'longitude' => ''
        ]);
        Advertisment::create([
            'name' => 'Iklan Paket Wisata WEB',
            'type' => 'web',
            'image' => $image_sample,
            'url' => "https://wa.me/+6285624277920?text=I'm%20interested%20in%20your%20car%20for%20sale",
            'description' => 'web',
            'efective' => '2023-12-12',
            'expired' => '2024-12-12',
            'latitude' => '',
            'longitude' => ''
        ]);
        Advertisment::create([
            'name' => 'Iklan Paket Wisata WA 2',
            'type' => 'wa',
            'image' => $image_sample,
            'url' => "https://wa.me/+6285624277920?text=I'm%20interested%20in%20your%20car%20for%20sale",
            'description' => 'wa',
            'efective' => '2023-12-12',
            'expired' => '2024-12-12',
            'latitude' => '',
            'longitude' => ''
        ]);
        Advertisment::create([
            'name' => 'Iklan Paket Wisata WEB 2',
            'type' => 'web',
            'image' => $image_sample,
            'url' => "https://wa.me/+6285624277920?text=I'm%20interested%20in%20your%20car%20for%20sale",
            'description' => 'web',
            'efective' => '2023-12-12',
            'expired' => '2024-12-12',
            'latitude' => '',
            'longitude' => ''
        ]);
    }

    public function uploadToStorage($image = "")
    {
        if ($image != "") {
            $base64_string = $image;
            $output_file = "/public/storage";
            $splited = explode(',', substr( $base64_string , 5 ) , 2);
            $mime = $splited[0];
            $mime_split_without_base64=explode(';', $mime,2);
            $mime_split=explode('/', $mime_split_without_base64[0],2);
            $file_type = $mime_split[1];
            $is_file = "/ads_".date("YmdHis").".".$file_type;

            file_put_contents(public_path('storage') . $is_file, file_get_contents($base64_string));

            return $output_file . $is_file;
        }
        return null;
    }
}
