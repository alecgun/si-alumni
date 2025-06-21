<!DOCTYPE html>
<html lang="en">

<head>
    <title>Support Ticket</title>
</head>

<body>
    <h1>Notifikasi Tiket Bantuan #{{ $ticket->id }}</h1>
    <p>Tiket Bantuan dengan judul "{{ $ticket->judul }}" telah dibuka oleh alumni {{ $user->name }}. Silahkan cek di
        menu Support Ticket.</p>
</body>

</html>
