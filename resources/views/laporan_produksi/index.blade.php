@extends('layout.main')
@section('content')
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            @include('partials.sidebar')
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4 mb-4">Laporan Produksi</h1>
                    <div class="row my-4 justify-content-end">
                        <div class="col-md-3">
                            <div class="card"><a href="#" class="btn btn-success">Export Excel
                                </a></div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Data Laporan Produksi
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Produksi</th>
                                        <th>Model Produk</th>
                                        <th>tanggal Produksi</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Produksi</th>
                                        <th>Model Produk</th>
                                        <th>tanggal Produksi</th>
                                        <th>action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    {{-- dummy data --}}
                                    <tr>
                                        <td>1</td>
                                        <td>123456</td>
                                        <td>Mono mono</td>
                                        <td>12-12-2021</td>
                                        <td>
                                            <a href="#" class="btn btn-warning">Edit</a>
                                            <form action="#" method="post" class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Yakin ingin menghapus data?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>123456</td>
                                        <td>Longboard</td>
                                        <td>12-12-2021</td>
                                        <td>
                                            <a href="#" class="btn btn-warning">Edit</a>
                                            <form action="#" method="post" class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Yakin ingin menghapus data?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>123456</td>
                                        <td>The Little Fish</td>
                                        <td>12-12-2021</td>
                                        <td>
                                            <a href="#" class="btn btn-warning">Edit</a>
                                            <form action="#" method="post" class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Yakin ingin menghapus data?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>123456</td>
                                        <td>The Brunette</td>
                                        <td>12-12-2021</td>
                                        <td>
                                            <a href="#" class="btn btn-warning">Edit</a>
                                            <form action="#" method="post" class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Yakin ingin menghapus data?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
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
