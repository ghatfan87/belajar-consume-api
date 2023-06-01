<?php

namespace App\Http\Controllers;

use App\Http\Libraries\BaseApi;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // mengambil data dari input search
        $search = $request->search;
        // memanggil libraries BaseApi method index nya dengan mengirim parameter1 berupa path data dari API nya,parameter2 data untuk mengisi search_name API nya
        // new :  memanggil class
        $data = (new BaseApi)->index('/api/student', ['search_nama' => $search]);
        // ambil response json nya
        $students = $data->json();
        // dd($students);
        // kirim hasil pengambilan data ke blade index
        //  
        return view('index')->with(['students' => $students ['data']]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [
            'nama' => $request->nama,
            'nis' => $request->nis,
            'rombel' => $request->rombel,
            'rayon'=> $request->rayon,
        ];

        $proses = (new BaseApi)->store('/api/students/tambah-data',$data);
        if($proses->failed()) {
            $errors=$proses->json('data');
            return redirect()->back()->with(['errors' => $errors]);
        }else {
            return redirect('/')->with('success','Berhasil Menambahkan Data Baru Ke Students API');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // proses ambil data api ke route REST API /students/{id}
        $data = (new BaseApi)->edit('/api/students/'.$id);
        if($data->failed()){
            // kl gagal 
        $errors = $data->json('data');
        return redirect()->back()->with(['errors' => $errors]);
        }else {
            $student = $data->json('data');
            return view('edit')->with(['student' => $student]);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // data yg akan dikirm ($reques ke REST APInya)
        $payload = [
            'nama' => $request->nama,
            'nis' => $request->nis,
            'rombel' => $request->rombel,
            'rayon'=> $request->rayon,
        ];
        // panggil method update dari BaseApi, kirim endpoint dan data (route update dari REST APInya) dan data ($payload diatas)
        $proses = (new BaseApi)->update('/api/students/'.$id.'/update', $payload);
        if($proses->failed()) {
            // kl gagal,balikin lagi sama pesan errors dari json nya
            $errors=$proses->json('data');
            // dd($proses);
            return redirect()->back()->with(['errors' => $errors]);
        }else {
            // berhasil, balikin halaman paling awal dengan 
            return redirect('/')->with('success','Berhasil Mengubah data siswa dari API');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $proses = (new BaseApi)->delete('/api/students/'.$id.'/delete');

        if($proses->failed()) {
            $errors = $proses->json('data');
            return redirect()->back()->with(['errors' => $errors]);
    }else {
        return redirect('/')->with('success','Berhasil Menghapus data siswa dari API');
    }
}
    public function trash()
    {
        $proses = (new BaseApi)->trash('/api/students/show/trash');
        if ($proses->failed()){
            dd($proses);
            $errors = $proses->json('data');
            return redirect()->back()->with(['errors' => $errors]);
        }else {
            $studentsTrash =
            $proses->json('data');
            return view('trash')->with(['studentsTrash' => $studentsTrash]);
        }
    }

    public function deletePermanent($id)
    {
        $proses = (new BaseApi)->deletePermanent('/api/students/delete/permanent/' .$id);
        if ($proses->failed()){
            $errors = $proses->json('data');
            return redirect()->back()->with(['errors'=> $errors]);
        }else {
            return redirect('/')->with('success', 'Berhasil hapus data secara permanent');
        } 
    }

    public function restore($id)
    {
        $proses = (new BaseApi)->restore('/api/students/restore/'.$id);
        if ($proses->failed()) {
            dd($proses);
            $errors = $proses->json('data');
            return redirect()->back()->with(['errors' => $errors]);
        }else {
            return redirect('/')->with('success', 'Berhasil mengembalikan data dari sampah!');
        }
    }
}
