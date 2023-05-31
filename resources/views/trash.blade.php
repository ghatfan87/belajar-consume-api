<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @foreach ($studentsTrash as $show)
        <ol>
            <li>NIS : {{ $show['nis'] }}</li>
            <li>Nama : {{ $show['nama'] }}</li>
            <li>Rombel: {{ $show['rombel'] }}</li>
            <li>Rayon : {{ $show['rayon'] }}</li>
            <li>Aksi: <a href= "{{route('restore', $show['id'])}}">Restore</a></li>
        </ol>
    @endforeach
</body>
</html>