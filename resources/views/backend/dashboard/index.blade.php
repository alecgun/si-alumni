@extends('backend.parts.master')
@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                        Dashboard</h1>
                    <!--end::Title-->
                </div>
                <!--end::Page title-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-fluid">
                <!--begin::Row-->
                <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                    <!--begin::Col-->
                    <div class="col-xl-4">
                        <!--begin::Chart widget 36-->
                        <div class="card card-flush overflow-hidden h-lg-100">
                            <!--begin::Header-->
                            <div class="card-header pt-5">
                                <!--begin::Title-->
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bold text-gray-900">Tiket Menunggu Respon</span>
                                    <span class="text-gray-500 mt-1 fw-semibold fs-6">{{ $openTicketCount }} Tiket</span>
                                </h3>
                                <!--end::Title-->
                                <!--begin::Toolbar-->
                                <div class="card-toolbar">
                                    <a href="{{ route('ticket') }}" class="btn btn-sm btn-light-primary fw-bold">
                                        <i class="ki-outline ki-archive fs-3"></i>Lihat Semua Tiket</a>
                                </div>
                                <!--end::Toolbar-->
                            </div>
                            <!--end::Header-->
                            <!--begin::Card body-->
                            <div class="card-body">
                                <!--begin::List-->
                                <div class="mb-5">
                                    @if ($openTicket->isEmpty())
                                        <div class="text-center text-muted">Tidak ada tiket terbuka saat ini.</div>
                                    @else
                                        <ul class="list-group">
                                            @foreach ($openTicket as $ticket)
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <span class="text-muted">{{ $ticket->id }} -
                                                            {{ $ticket->kategori }}</span>
                                                        <div class="fw-bold">{{ $ticket->judul }}</div>
                                                        <div class="text-muted">
                                                            {{ $ticket->formatted_created_at }} - {{ $ticket->nama_user }}
                                                            ({{ $ticket->nis }})
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Chart widget 36-->
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-xl-8">
                        <!--begin::Chart widget 36-->
                        <div class="card card-flush overflow-hidden h-lg-100">
                            <!--begin::Header-->
                            <div class="card-header pt-5">
                                <!--begin::Title-->
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bold text-gray-900">Total Data Alumni</span>
                                    <span class="text-gray-500 mt-1 fw-semibold fs-6">{{ $alumniCount }} Alumni</span>
                                </h3>
                                <!--end::Title-->
                                <!--begin::Toolbar-->
                                <div class="card-toolbar">
                                    <a href="{{ route('alumni.index') }}" class="btn btn-sm btn-light-primary fw-bold">
                                        <i class="fas fa-graduation-cap fs-4"></i>Lihat Semua Alumni</a>
                                </div>
                                <!--end::Toolbar-->
                            </div>
                            <!--end::Header-->
                            <!--begin::Card body-->
                            <div class="card-body">
                                <!--begin::Chart-->
                                <div id="total_alumni">
                                    <canvas id="chart_total_alumni"></canvas>
                                </div>
                                <!--end::Chart-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Chart widget 36-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
@endsection
@push('customScripts')
    <script>
        const data = {
            labels: @json($data->map(fn($data) => $data->tahun_lulus)),
            datasets: [{
                    label: 'Laki-laki',
                    data: @json($data->map(fn($data) => $data->jumlah_laki)),
                    backgroundColor: [
                        'rgba(54, 162, 235, 1)',
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                    ],
                    barPercentage: 0.5,
                    borderRadius: 5,
                },
                {
                    label: 'Perempuan',
                    data: @json($data->map(fn($data) => $data->jumlah_perempuan)),
                    backgroundColor: [
                        'rgba(255, 99, 132, 1)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                    ],
                    barPercentage: 0.5,
                    borderRadius: 5,
                }
            ]
        };

        const config = {
            type: 'bar',
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        min: 0,
                        max: 10,
                    }
                },
                maintainAspectRatio: false,
            },
        };

        const mainChart = new Chart(
            document.getElementById('chart_total_alumni'),
            config
        );
    </script>
@endpush
@push('customStyles')
    <style>
        #total_alumni {
            min-height: 500px;
        }
    </style>
@endpush
