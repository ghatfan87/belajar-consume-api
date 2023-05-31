<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Consume REST API Students</title>
</head>

<body>
    <h1>List Semua Data Student</h1>
    <form action="" method="get">
        @csrf
        <input type="text" name="search" placeholder="Cari Nama..">
        <button type="submit">Cari</button>
        <a href="/">Refresh</a>
        <a style="text-decoration: none" href="/add">Tambah Data Baru</a>
        <a href="/trash">Sampah Disini</a>
    </form>

    <br>
    @if (Session::get('success'))
        <div style="width: 100%; background: green; color:white; padding: 10px;">
            {{ Session::get('success') }}
        </div>
    @endif

    @foreach ($students as $student)
        <ol>
            <li>NIS : {{ $student['nis'] }}</li>
            <li>Nama : {{ $student['nama'] }}</li>
            <li>Rombel: {{ $student['rombel'] }}</li>
            <li>Rayon : {{ $student['rayon'] }}</li>
            <li>Aksi: <a href= "{{route('edit', $student['id'])}}">Edit</a>||
                 <form action="{{route('delete', $student['id'])}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Hapus</button>
                 </form> 
            </li>
        </ol>
    @endforeach
</body>

</html>
