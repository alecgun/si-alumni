<table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_alumnis">
    <thead>
        <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
            <th class="w-10px pe-2">#</th>
            <th class="min-w-125px">NIS</th>
            <th class="min-w-125px">Nama</th>
            <th class="min-w-125px">Kelas</th>
            <th class="min-w-125px">Tahun Masuk</th>
            <th class="min-w-125px">Tahun Lulus</th>
            <th class="min-w-125px">Instagram</th>
            <th class="min-w-125px">Dibuat Tanggal</th>
            <th class="min-w-125px">Diubah Tanggal</th>
            @canany(['alumni.edit', 'alumni.delete', 'kuliah.index'])
                <th class="text-center min-w-300px">Aksi</th>
            @endcanany

            {{-- <th class="text-center min-w-100px">Aksi</th> --}}
        </tr>
    </thead>
    <tbody class="text-gray-600 fw-semibold">
        <!-- DataTables will populate this tbody -->
    </tbody>
</table>
