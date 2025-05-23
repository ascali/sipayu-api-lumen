<?php

namespace Database\Seeders;

use App\Models\Type_of_interest;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

class TypeOfInterestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        Type_of_interest::create([
            'name' => 'Wisata', 
            'image' => $this->uploadToStorageMinio('1', 'data:image/png;base64,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'),
            'description' => ''
        ]);
        Type_of_interest::create([
            'name' => 'Paket Wisata', 
            'image' => $this->uploadToStorageMinio('2', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAACXBIWXMAAAsTAAALEwEAmpwYAAAEzklEQVR4nO1aXWgcVRT+mghlE1Fo0hq0fVAoVVKr1PyQdFf7INiCfVZE6g+miFUU64smVNNoTRUEMUaprSDGJ0vrHy0YxU3RVhMLeWhfxCYxay2oqVWfmrQ5ctY50+k492dnZzYrvQe+h9zcO9/5vrn3nLubAC5cuHDhwoULFy5cuLjcYxGARwF8DeCkJWYAnEkJcwCoBEx5+ceOZ0okrFbcE9eASX7AEEAnLTED0JmUMAcQWWIeoN0XDZgGkIljAKEE0mpE7qIJz8U2AAYsB+hggPQzgK5b4HUZgL4C6DuAFv079ieAZakYAIBWBBJaXgXrMpk6envflzQ8cY7uar9dxt+KZcDwxLlI5KdmaeLsvE8qCQXXjZ6ao+m/iAohTBnW6aBaJ89mPuaV+UOHf6DFNTU85zyA5kQMyHvimVCV0LcK8ZNn52lketZoQPPaDn9sdcs6KwPC4hmcR9djT8m8T8s2IB8QrzNA9eZHfprVChEeFi1jN7dmjQZEiZcdeKLwBy2pv1Lm3hnbgHxIPD/ctCWjxNsYUOoRUIkX/u07X5O54wBqSjYgHyGeSWwMCIv/IgUDdOKLR29mlm5oulbmby7JgLxCvE1RkjMfFH/8twuxDOA8TOt0tWfn6+/J/J8B1FkZkNeINxmgEq+rHaoiaNN1TIWX57SsuF7WdFsZMKERrzMgatuLeBsDgkVwTVvW2HV0LTeYx+CHebkc/Q2gyWhAQSNeVwN04m0MSLrrBPPYtGGTrBu0MmBa02JMQqLE2xqQZNcJ5nHk+CQtrq01Xo5I1V+DZ00nRCXexoByuo6u9gi6tjxhvBxRVH8NFxpVQjrxJgNY/Nr2Tn+stSNbdtcJ8xcvR5k6Wb9eacCwob+qEtKJ162TN8+iZezWdvNN0LTto9DTu0vWHzAaMKqosrZn0nZdWl0nCkdPTMn6X5UGoEIfa+N2nVL4DIhnAIs4FEjooGVS4XVBA3SFN2yALV9sA6hCED4RH7wJ3tK2Ttl1kuKtGgNGvTcfvAm2deaUtaNiBnQmd9Z8ZDX3ANuuY4tOA6/RgGwKBuQ0Bth2HVtkDbxKAwoAjQM0ljJsP9XJvHL5xj1tRgPGKgThE/EtoZtg+LvEpHljGfA5QI8AdCNAdR5u8saGYyYibz54E2ztyPnX26i8yskjtgGvAlSvOd/13pxSDTB9qgvnVW4eUQZcAaDftpC1dqynHa/spQ8OHC2id9ceamm/I/GCWYE8+gDUsgEv2S66/+Enad+h8Ujc98DjFROfYB498L4wpMF3P6HDx07/Bw92Pe07riIV3Ob9WeqhLdsin1UOksxjYO/HYsCPbECBf+DBqMkrVzUXJ/N2E4Jne9+gJQ3LqKHxGuruG/DHX+h/pzh35arViRuQZB4Dez66xIAXbbbL0P4jPgETynjj0iZ//P3936S+/RPOo0eK4MsATl9GBvwCYIcUQVN8z4u4ygoBbzcmZ9Luvjf98ef7dwvBGJKPBctjOz+MW4yx+LTlLtlaCceC5dEI4Hd+ILcYFem9m7cGv25qSIK4mvK4W/5tjVsMV1k+iwzebgHHec7GpEirLY+NnquqwsK/25A0abXlcbX3/4QjAE55yAPYBuCqtEirOA8XLly4cOHChQsX+L/GPwJWq55iTo4mAAAAAElFTkSuQmCC'),
            'description' => ''
        ]);
        Type_of_interest::create([
            'name' => 'Event', 
            'image' => $this->uploadToStorageMinio('3', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAACXBIWXMAAAsTAAALEwEAmpwYAAAD/UlEQVR4nO1bWWgTURQ9aWtdcKutFrVgFFxB/RBErdIWqyL0o+BetyruBUWLRlzQihZ/VLC4ROpWtVgTcAdFNFZxQwRFBS3UKorihooLiOiVmyaTqWTmjcnMJNF34MBQ3rnvzOHNm3eHFJCQkJCQkDADDgDbAJwAkAbzkQrgEICqwHXcoSsACrDIgvrZqvp8HXdwqgwWW1A/V1Wfr+MOThkA5Aqgf/URGA5gCwC3DqtVBn2CsZHwtKr+acHYLQHPUSMJwA4Av1STJwrZc0Xg9Rwx5isFU1IJmd20mZEVmrxtuv7YSJiWGarP13pj2WsoiDnRBHDVX4RvrvIhwftGmzvvhCYt2a4/NhKWHQ/V52u9sZUPCBldg+OvRBPAE3+RnAlig/EUAJM9N47ne4gYDf4ieZMTLwD23Di+wZ4A9twLGVyyy/wANp4J1d90Ng4D8LwmFCwgDB5LOFhnfgBHXzQu65yJjddxF4A3zigDmCxXAEx7BFq2Nv9gYzXZs2kBIKEZfQBdevWkUfNmJxTZs2kB5BVPIy99TSiyZxkALFgBBz+8pKy+vYXPXlJyMhW6lim68hs+at0hTahr3qoVuU7UKLrCFUv9tUS6rH59qOrjK+tXwIba84Y3oE7dnYpuUtkaw7q8WdMVHdcwqmNvlgdQ5junTDgFIFcYZgcDcHZTdBPXrVJ0Lg22Cwagmo9r8N/6a2gWqAJgb7YG4AOIwnCdIADSoFMngGINTYMMAHIFQD4CkHsAYrEJlgLkDsMCwSbo1mC6ziY4VENTbvcesOHyOePnAHUA61cbPweECcDQOeCyDQHsff2U2mSkGzKUO3Oqolt7/hQlp6QINQ6Hg0r27VZ0OTOKDM3VtmMG7XvzzJ5e4MjXt7Sj/oEudz97RJ5fX5roDrx/IdRxwGoN1+BaIl31t3eyGfLa0Q3W/PhEYxbOpQH5ebocOHoklXoOKzr38zoaMq5QqBtUMJa23r+t6JbVVPlriXRjFs3ze7M8gE3XLhrelLr07qnoisrLDOv4g0ZQp/qwIWT59Uv2vgYHAZQfhj0Er8F8DbbQeQt01tBkx/Ic4JPNEGQ3SLIdhvweQP/rB5FqgOrDcLEggHoNZukEME5DUxvLAPA3zZAqAKuaIVsC2P74LjmSkgwZ6jsiW9EtrNxp+EbGr12p6PoMH2ZIw54q6u7Z0wxtvlVL890VuizZ727S2Hh+fibXyWNCHR99j37/0KT75FoiHXuyrBfIVbW1iUL2bEYAt4Jnem6BY31TRsle2XMggJvRBLA8+Iy1z+xE/UfmCruyWJM9slfV/lAaTQCpf/xGN9F4EkAzRAlH4D9AvAAuJAg9AKZEe+MSEhISEvjH8RvbMPBvjEzDMAAAAABJRU5ErkJggg=='),
            'description' => ''
        ]);
        Type_of_interest::create([
            'name' => 'Kuliner', 
            'image' => $this->uploadToStorageMinio('4', 'data:image/png;base64,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'),
            'description' => ''
        ]);
        Type_of_interest::create([
            'name' => 'Akomodasi', 
            'image' => $this->uploadToStorageMinio('5', 'data:image/png;base64,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'),
            'description' => ''
        ]);
        Type_of_interest::create([
            'name' => 'Ekonomi Kreatif', 
            'image' => $this->uploadToStorageMinio('6', 'data:image/png;base64,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'),
            'description' => ''
        ]);
    }

    public function uploadToStorage($no = "1", $image = "")
    {
        if ($image != "") {
            $base64_string = $image;
            $output_file = "/public/storage";
            $splited = explode(',', substr( $base64_string , 5 ) , 2);
            $mime = $splited[0];
            $mime_split_without_base64=explode(';', $mime,2);
            $mime_split=explode('/', $mime_split_without_base64[0],2);
            $file_type = $mime_split[1];
            $is_file = "/".$no."_toi_".date("YmdHis").".".$file_type;

            file_put_contents($this->public_path('storage') . $is_file, file_get_contents($base64_string));

            return $output_file . $is_file;
        }
        return null;
    }

    function public_path($path=null)
    {
            return rtrim(app()->basePath('public/'.$path), '/');
    }

    public function uploadToStorageMinio($no = "1", $image = "")
    {
        // Pastikan variabel $image berisi string base64 (misalnya "data:image/png;base64,iVBORw0KGgo...")
        if ($image != "") {
            // --- Proses string Base64 ---
            // Contoh format: data:image/png;base64,.....
            $base64_string = $image;
        
            // Pisahkan metadata MIME dan data base64
            // Hilangkan "data:" dari awal string, kemudian pisahkan berdasarkan koma
            $splited = explode(',', substr($base64_string, 5), 2);
            $mime = $splited[0]; // misalnya "image/png;base64"
            $mime_parts = explode(';', $mime, 2);
            $mime_full = $mime_parts[0]; // misalnya "image/png"
            $mime_split = explode('/', $mime_full, 2);
            $file_type = isset($mime_split[1]) ? $mime_split[1] : 'png'; // default png jika tidak ada
        
            // Buat nama file unik berdasarkan timestamp
            $file_name = $no . "_" . date("YmdHis") . "." . $file_type;
        
            // --- Simpan file ke penyimpanan lokal ---
            // Misal: simpan di direktori public/storage
            $localPath = $this->public_path('storage') . DIRECTORY_SEPARATOR . $file_name;
            // Decode string base64 dan simpan ke file lokal
            file_put_contents($localPath, file_get_contents($base64_string));
        
            // --- Upload file ke MinIO ---
            $disk = Storage::disk('minio');
            // Tentukan path pada bucket MinIO (misal, simpan di folder "storage")
            // $minioPath = 'storage/' . $file_name;
            $minioPath = $file_name;
        
            // Baca konten file dari penyimpanan lokal
            $fileContents = file_get_contents($localPath);
            $uploadSuccess = $disk->put($minioPath, $fileContents);
        
            if ($uploadSuccess) {
                // --- Hapus file lokal setelah upload berhasil ---
                if (file_exists($localPath)) {
                    unlink($localPath);
                }
        
                /*
                // Opsi 1: Menghasilkan Presigned URL (dengan masa berlaku, misal 7 hari).
                // Catatan: Presigned URL selalu memiliki masa expired.
                $adapter = $disk->getAdapter();
                $client = $adapter->getClient();
                $bucket = Config::get('filesystems.disks.minio.bucket');
                $command = $client->getCommand('GetObject', [
                    'Bucket' => $bucket,
                    'Key'    => $minioPath,
                ]);
                // Set expired hingga 7 hari (maksimum untuk AWS Signature V4)
                $expiration = '+7 days';
                $request = $client->createPresignedRequest($command, $expiration);
                $url = (string) $request->getUri();
                */
        
                // Opsi 2: Mengembalikan URL permanen (tanpa expired) dengan asumsi bucket/objek sudah diatur agar bersifat publik.
                // Pastikan bucket MinIO Anda diatur untuk akses publik (ACL: public-read).
                $minioEndpoint = rtrim(Config::get('filesystems.disks.minio.endpoint'), '/');
                $bucket = Config::get('filesystems.disks.minio.bucket');
                // Hasil URL misal: https://minio.example.com/nama_bucket/storage/20250206123456.png
                $url = $minioEndpoint . '/' . $bucket . '/' . $minioPath;
        
                return $url;
            } else {
                return response()->json(['error' => 'Gagal mengupload file'], 500);
            }
        }
        return null;
    }

}
