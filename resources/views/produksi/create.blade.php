@extends('layout.main')
@section('content')
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            @include('partials.sidebar')
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4 mb-4">Estimasi</h1>
                    <div class="card mb-4">

                        <div class="card-header">
                            Form Estimasi
                        </div>
                        <div class="card-body">
                            <form action="/dashboard/produksi/create" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="produksi" class="form-label">Produksi</label>
                                    <input type="text" class="form-control" id="produksi" name="produksi">
                                </div>
                                <div class="mb-3">
                                    <label for="model_produk_id" class="form-label">Model Produk</label>
                                    <select class="form-select" aria-label="Default select example" name="model_produk_id"
                                        id="model_produk_id">
                                        <option selected>Model Produk</option>
                                        @foreach ($modelProduk as $item)
                                            <option value="{{ $item->id }}">{{ $item->model }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="tgl_produksi" class="form-label">tanggal Produksi</label>
                                    <input type="date" class="form-control" id="tgl_produksi" name="tgl_produksi">
                                </div>
                                <div class="mb-3">
                                    <label for="jumlah_produksi" class="form-label">Jumlah Produksi</label>
                                    <input type="number" class="form-control" id="jumlah_produksi" name="jumlah_produksi">
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
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
