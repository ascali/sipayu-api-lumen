<?php

namespace App\Http\Controllers;
// use Illuminate\Support\Str;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function jsonResponse($status=true, $message="", $data=[], $code=200)
    {
        return response()->json([
            "status"=> $status,
            "message"=> $message,
            "data"=> $data
        ], $code);
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
            $is_file = "/".date("YmdHis").".".$file_type;

            file_put_contents($this->public_path('storage') . $is_file, file_get_contents($base64_string));

            return $output_file . $is_file;
        }
        return null;
    }

    function public_path($path=null)
    {
        return rtrim(app()->basePath('public/'.$path), '/');
    }

    public function rulesImage()
    {
        // 'dokumen' => 'required|max:10240|mimes:doc,docx,xlsx,xls,ppt,pptx,pdf,zip,png,jpg,jpeg,svg',
        $rules = [
            'image' => 'mimes:png,jpg,jpeg,svg',
        ];

        return $rules;
    }

    public function uploadToStorageMinio($image = "")
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
            $file_name = date("YmdHis") . "." . $file_type;
        
            // --- Simpan file ke penyimpanan lokal ---
            // Misal: simpan di direktori public/storage
            $localPath = $this->public_path('storage') . DIRECTORY_SEPARATOR . $file_name;
            // Decode string base64 dan simpan ke file lokal
            // file_put_contents($localPath, file_get_contents($base64_string));
            file_put_contents($this->public_path('storage') . $file_name, file_get_contents($base64_string));
        
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
