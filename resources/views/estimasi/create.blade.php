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
                    <div class="card mb-4">

                        <div class="card-header">
                            Form Estimasi Produksi
                        </div>
                        <div class="card-body">
                            <form action="/dashboard/produksi/create" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="produksi_id" class="form-label">Produksi</label>
                                    <select class="form-select" aria-label="Default select example" name="produksi_id"
                                        id="produksi_id">
                                        <option selected>Produksi</option>
                                        @foreach ($produksi as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama_produk }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="model_produk" class="form-label">Model Produk</label>
                                    <input type="text" class="form-control" id="model_produk" name="model_produk">
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
