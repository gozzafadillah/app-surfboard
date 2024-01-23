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
                            <div class="card"><a href="#" class="btn btn-primary">Tambah
                                    Produksi</a></div>
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
                                        <th>tanggal selesai</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Model Produksi</th>
                                        <th>status </th>
                                        <th>tanggal selesai</th>
                                        <th>action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>The Brunette</td>
                                        <td>process</td>
                                        <td>Januari, 2024</td>
                                        <td>
                                            <a href="/dashboard/produksi/1/penjadwalan" class="btn btn-success">view</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Mono Mono</td>
                                        <td>process</td>
                                        <td>Januari, 2024</td>
                                        <td>
                                            <a href="/dashboard/produksi/2/penjadwalan" class="btn btn-success">view</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Bon Voyage</td>
                                        <td>process</td>
                                        <td>Januari, 2024</td>
                                        <td>
                                            <a href="/dashboard/produksi/2/penjadwalan" class="btn btn-success">view</a>
                                        </td>
                                    </tr>
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
