<?php

namespace App\Http\Libraries;
// mengatur posisi file
use Illuminate\Support\Facades\Http;

class BaseApi
{
    // variable yg cuman bisa diakses di class ini dan turunannya
    protected $baseUrl;
    // constructor: menyiapkan isi data, dijalankan otomatis tanpa dipanggil
    public function __construct()
    {
        // var $baseUrl yg diatas diisi nilainya dari isian file .env bagian API_HOST
        // var ini diisi otomatis ketika file/class BaseApi dipanggil di controller
        $this->baseUrl = "http://127.0.0.1:666";
    }
    private function client()
    {
        // koneksikan ip dari var $baseUrl ke depedency Http
        // menggunakan depedency Http karena project API nya berbasis web (protocol Http)
        return Http::baseUrl($this->baseUrl);
    }
    public function index(String $endpoint, Array $data = [])
    {
        // manggil ke func clients yg diatas trs manggil path yg dari $endpoint yg dikirim controller nya, kl ada data yg mau  dicari (params di postman) diambil dari parameter $data
        return $this->client()->get($endpoint, $data);
    }

    public function store(String $endpoint, Array $data = [])
    {
        // pake post() krn buat route nambah data di project REST API nya pake ::post
        return $this->client()->post($endpoint , $data);
    }

    public function edit(String $endpoint, Array $data = [])
    {
        return $this->client()->get($endpoint , $data);
    }
    public function update(String $endpoint, Array $data = [])
    {
        return $this->client()->patch($endpoint , $data);
    }

    public function delete(String $endpoint, Array $data = [])
    {
        return $this->client()->delete($endpoint , $data);
    }

    public function restore(String $endpoint, Array $data = [])
    {
        return $this->client()->get($endpoint , $data);
    }

    public function trash(String $endpoint, Array $data = [])
    {
        return $this->client()->get($endpoint , $data);
    }
    public function deletePermanent(String $endpoint, Array $data = [])
    {
        return $this->client()->delete($endpoint , $data);
    }
}