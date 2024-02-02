@extends('layout.main')
@section('content')
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            @include('partials.sidebar')
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4 mb-4">Penjadwalan</h1>
                    <div class="row my-4 justify-content-end">
                        <div class="col-md-3">
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Penjadwalan Produksi Mono mono Bulan Januari 2024
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Proses</th>
                                        <th>status </th>
                                        <th>tanggal proses</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Proses</th>
                                        <th>status </th>
                                        <th>tanggal proses</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    {{-- proses dulu --}}
                                    @foreach ($data['proses'] as $proses)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $proses->proses }}</td>
                                            <td>proses</td>
                                            @foreach ($data['jadwal'] as $item)
                                                {{-- jika id proses sama dengan id proses di jadwal --}}
                                                <td>{{ $item['start'] }}</td>
                                            @endforeach
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
