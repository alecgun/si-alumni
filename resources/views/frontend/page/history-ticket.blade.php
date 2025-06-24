@extends('frontend.page.parts.master')
@section('content')
    <!-- START HERO -->
    <section class="bg-blue">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center text-white">
                        <h2 class="text-white fw-bold">Riwayat Tiket Bantuan</h2>
                        <p class="text-white-50">Tiket yang sudah dibuat akan ditampilkan disini.</p>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </section>
    <!-- END HERO -->
    <!-- START MAIN -->
    <section class="section bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="ps-4">Judul</th>
                                            <th>Tanggal Dibuat</th>
                                            <th>Status</th>
                                            <th class="text-end pe-4">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($tickets as $t)
                                            <tr>
                                                <td class="ps-4">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-grow-1">
                                                            <h6 class="mb-0">{{ $t->judul }}</h6>
                                                            <small class="text-muted">{{ $t->kategori }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column">
                                                        <span>{{ $t->formatted_date }}</span>
                                                        <small
                                                            class="text-muted">{{ $t->created_at->locale('id_ID')->diffForHumans() }}</small>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge rounded-pill bg-{{ $t->status_badge }} bg-opacity-10 px-3 py-2">
                                                        {{ $t->status_ticket }}
                                                    </span>
                                                </td>
                                                <td class="text-end pe-4">
                                                    <a href="{{ route('landing.ticket.show', $t->id) }}"
                                                        class="btn btn-sm btn-outline-primary rounded-pill px-3">Detail
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center py-4">
                                                    <div class="d-flex flex-column align-items-center">
                                                        <h5 class="text-muted">Belum ada tiket yang dibuat</h5>
                                                        <a href="{{ route('landing.ticket.open') }}"
                                                            class="btn btn-primary mt-2">
                                                            <i class="fas fa-plus me-1"></i> Buat Tiket Baru
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            @if ($tickets->hasPages())
                                <div class="card-footer bg-transparent border-top">
                                    {{ $tickets->links() }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END MAIN -->
@endsection

@push('customScripts')
    <script>
        // Jika diperlukan script tambahan
    </script>
@endpush

@push('customStyles')
    <style>
        .bg-blue {
            padding: 150px 0 80px 0;
            position: relative;
            background-color: #135fc9;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }

        /* Modern Table Styles */
        .card {
            border-radius: 12px;
            overflow: hidden;
        }

        .table {
            margin-bottom: 0;
        }

        .table thead th {
            border-bottom: none;
            padding: 16px 12px;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            color: #6c757d;
        }

        .table tbody tr {
            transition: all 0.2s ease;
        }

        .table tbody td {
            padding: 16px 12px;
            vertical-align: middle;
            border-top: 1px solid rgba(0, 0, 0, 0.03);
        }

        /* Status Badges */
        .bg-Open {
            background-color: #0dcaf0 !important;
            color: #fff !important;
        }

        .bg-Processing {
            background-color: #ffc107 !important;
            color: #212529 !important;
        }

        .bg-Resolved {
            background-color: #198754 !important;
            color: #fff !important;
        }

        .bg-Closed {
            background-color: #6c757d !important;
            color: #fff !important;
        }

        /* Empty State */
        .empty-state {
            padding: 3rem 0;
        }

        /* Pagination */
        .pagination {
            justify-content: center;
        }

        .page-item.active .page-link {
            background-color: #135fc9;
            border-color: #135fc9;
        }

        .page-link {
            color: #135fc9;
        }
    </style>
@endpush
