@extends('layout.main')
@section('content')
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            @include('partials.sidebar')
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    {{-- tombol kembali --}}
                    <a href="/dashboard/produksi" class="btn btn-primary mt-4">Kembali</a>
                    {{-- judul halaman --}}
                    <h1 class="mt-4 mb-4">Penjadwalan</h1>
                    <div class="row my-4 justify-content-end">
                        <div class="col-md-3">
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Penjadwalan Produksi Mono mono tanggal {{ $tanggal }}
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Proses</th>
                                        <th>status </th>
                                        <th>tanggal proses</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Proses</th>
                                        <th>status </th>
                                        <th>tanggal proses</th>
                                        <th>action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($jadwal as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item['proses'] }}</td>
                                            <td>{{ $item['status']->penjadwalan->status == 1 ? 'Selesai' : 'Proses' }}</td>
                                            <td>{{ $item['start'] . ' - ' . $item['end'] }} WIB</td>
                                            <td>
                                                <a href="/dashboard/penjadwalan/{{ $item['status']->penjadwalan->uuid }}/status"
                                                    class="btn btn-warning btn-sm">Selesai</a>
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
