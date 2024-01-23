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
                                        <th>tanggal selesai</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Proses</th>
                                        <th>status </th>
                                        <th>tanggal selesai</th>
                                        <th>action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Layer</td>
                                        <td>process</td>
                                        <td>
                                            <p class="badge bg-success">Senin, 23 Januari 2024</p>
                                        </td>
                                        <td>
                                            <a href="#" @disabled(true)
                                                class="btn btn-success disabled">Selesai</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Pole Frame </td>
                                        <td>process</td>
                                        <td>
                                            <p class="badge bg-danger light">Belum Selesai</p>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-success">Selesai</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Press Body</td>
                                        <td>process</td>
                                        <td>
                                            <p class="badge bg-danger light">Belum Selesai</p>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-success">Selesai</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Press Full</td>
                                        <td>process</td>
                                        <td>
                                            <p class="badge bg-danger light">Belum Selesai</p>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-success">Selesai</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Finishing</td>
                                        <td>process</td>
                                        <td>
                                            <p class="badge bg-danger light">Belum Selesai</p>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-success">Selesai</a>
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
