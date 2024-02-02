@extends('layout.main')
@section('content')
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            @include('partials.sidebar')
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4 mb-4">Produksi</h1>
                    <div class="row my-4 justify-content-end">
                        <div class="col-md-3">
                            <div class="card"><a href="/dashboard/produksi/generateJadwal" class="btn btn-primary">Generate
                                    Jadwal
                                </a></div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            DataTable Example
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Model Produksi</th>
                                        <th>status </th>
                                        <th>tanggal estimasi</th>
                                        <th>tanggal selesai</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Model Produksi</th>
                                        <th>status </th>
                                        <th>tanggal estimasi</th>
                                        <th>tanggal selesai</th>
                                        <th>action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($produksi as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->model_produk }}</td>
                                            <td>{{ $item->status }}</td>
                                            <td>{{ $item->estimasi->bulan_estimasi }}</td>
                                            <td>{{ $item->tanggal_selesai == '' ? 'Belum Selesai' : $item->produksi->tanggal_selesai }}
                                            </td>
                                            <td>
                                                @if ($item->status == 'selesai')
                                                    <a href="/dashboard/penjadwalan/{{ $item->estimasi->id }}/detail"
                                                        class="btn btn-primary">Detail</a>
                                                @else
                                                    <a href="/dashboard/penjadwalan/{{ $item->estimasi->id }}"
                                                        class="btn btn-primary">Show</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2023</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
@endsection
