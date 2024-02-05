@extends('layout.main')
@section('content')
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            @include('partials.sidebar')
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4 mb-4">Estimasi Produksi</h1>
                    <div class="row my-4 justify-content-end">
                        <div class="col-md-3">
                            <div class="card"><a href="/dashboard/estimasi/create" class="btn btn-primary">Tambah
                                    Estimasi</a></div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Data Estimasi Produksi
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Model Produksi</th>
                                        <th>Jumlah Produksi</th>
                                        <th>Bulan Estimasi</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Model Produksi</th>
                                        <th>Jumlah Produksi</th>
                                        <th>Bulan Estimasi</th>
                                        <th>action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    {{-- dummy --}}
                                    @foreach ($estimasi as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->modelProduk->model }}</td>
                                            <td>{{ $item->jumlah }}</td>
                                            <td>{{ $item->bulan_estimasi }}</td>
                                            <td>
                                                <a href="/dashboard/estimasi/{{ $item->id }}"
                                                    class="btn btn-warning">Edit</a>
                                                <form action="/dashboard/estimasi/{{ $item->id }}/delete" method="post"
                                                    class="d-inline">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('Yakin ingin menghapus data?')">Delete</button>
                                                </form>
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
