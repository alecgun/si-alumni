<table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_tickets">
    <thead>
        <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
            <th class="w-10px pe-2">ID</th>
            <th class="min-w-200px">Judul</th>
            <th class="min-w-100px">Status</th>
            <th class="min-w-100px">Kategori</th>
            <th class="min-w-150px">Nama Alumni</th>
            <th class="min-w-100px">Email User</th>
            <th class="min-w-100px">Dibuat Tanggal</th>
            @canany(['ticket.delete', 'ticket.show'])
                <th class="text-center min-w-150px">Aksi</th>
            @endcanany

            {{-- <th class="text-center min-w-100px">Aksi</th> --}}
        </tr>
    </thead>
    <tbody class="text-gray-600 fw-semibold">
        <!-- DataTables will populate this tbody -->
    </tbody>
</table>
