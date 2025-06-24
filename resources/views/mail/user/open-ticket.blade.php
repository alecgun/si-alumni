<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support Ticket Notification</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            color: #333333;
            background-color: #f7f9fc;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: #135fc9;
            padding: 30px 20px;
            text-align: center;
            color: white;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }

        .content {
            padding: 30px;
        }

        .greeting {
            font-size: 18px;
            margin-bottom: 20px;
            color: #2b2d42;
        }

        .ticket-info {
            margin-bottom: 25px;
        }

        .ticket-id {
            display: inline-block;
            background: #edf2fb;
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: 500;
            color: #135fc9;
            margin-bottom: 10px;
        }

        .ticket-title {
            font-size: 18px;
            font-weight: 500;
            margin: 10px 0;
            color: #2b2d42;
        }

        .action-btn {
            display: inline-block;
            background: #135fc9;
            color: white !important;
            text-decoration: none;
            padding: 12px 25px;
            border-radius: 6px;
            font-weight: 500;
            margin-top: 15px;
            transition: all 0.3s ease;
        }

        .action-btn:hover {
            background: #0e4796;
            transform: translateY(-2px);
        }

        .footer {
            text-align: center;
            padding: 20px;
            font-size: 12px;
            color: #6c757d;
            background: #f8f9fa;
        }

        .divider {
            height: 1px;
            background: #e9ecef;
            margin: 20px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Tiket Anda Telah Dibuka</h1>
        </div>

        <div class="content">
            <div class="greeting">
                Halo, <strong>{{ $user->name }}</strong>
            </div>
            <p>
                Terima kasih telah menghubungi tim dukungan kami. Kami telah menerima permintaan bantuan Anda dan akan
                segera menanggapinya.
            </p>
            <div class="ticket-info">
                <span class="ticket-id">ID Tiket: {{ $ticket->id }}</span>
                <h2 class="ticket-title">{{ $ticket->judul }}</h2>
                <p>Anda dapat melacak perkembangan tiket Anda melalui menu History Ticket di platform kami.</p>
            </div>

            <div class="divider"></div>

            <p>Mohon untuk tidak membalas pada alamat email ini.</p>

            <a href="{{ route('landing.ticket.show', $ticket->id) }}" class="action-btn">LIHAT TIKET</a>
        </div>

        <div class="footer">
            <p>© {{ date('Y') }} SMAN 1 Blitar</p>
            <p>Jika Anda tidak meminta tiket bantuan ini, silakan abaikan email ini.</p>
        </div>
    </div>
</body>

</html>
