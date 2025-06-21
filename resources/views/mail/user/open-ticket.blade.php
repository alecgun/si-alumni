<!DOCTYPE html>
<html lang="en">

<head>
    <title>Support Ticket</title>
</head>

<body>
    <h1>Notifikasi Tiket Bantuan #{{ $ticket->id }}</h1>
    <h4>Halo, {{ $user->name }}</h4>
    <p>Anda berhasil membuka Tiket Bantuan dengan judul "{{ $ticket->judul }}". Silahkan cek progress di
        menu History Ticket dan cek tiket yang sesuai dengan ID ticket Anda yaitu #{{ $ticket->id }}.</p>
</body>

</html>
