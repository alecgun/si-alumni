<table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_kerjas">
    <thead>
        <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
            <th class="w-10px pe-2">#</th>
            <th class="text-center min-w-125px">Posisi Kerja</th>
            <th class="text-center min-w-125px">Tempat Kerja</th>
            <th class="text-center min-w-125px">Tahun Masuk</th>
            @canany(['kerja.edit', 'kerja.delete'])
                <th class="text-center min-w-100px">Aksi</th>
            @endcanany

            {{-- <th class="text-center min-w-100px">Aksi</th> --}}
        </tr>
    </thead>
    <tbody class="text-gray-600 fw-semibold">
        <!-- DataTables will populate this tbody -->
    </tbody>
</table>
