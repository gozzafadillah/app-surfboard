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
                        <div class="card-header" style="display:flex; justify-content: space-between">
                            <p>Form Estimasi</p>
                            <p>{{ $date }}</p>
                        </div>
                        <div class="card-body">
                            <form action="/dashboard/produksi/create" method="post">
                                @csrf
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
                                    <label for="jumlah_produksi" class="form-label">Jumlah Produksi</label>
                                    <input type="number" placeholder="0" class="form-control" id="jumlah_produksi"
                                        name="jumlah_produksi">
                                </div>
                                <div class="mb-3">
                                    <label for="bln_estimasi" class="form-label">Bulan Estimasi</label>
                                    <select class="form-select" aria-label="Default select example" name="bln_estimasi"
                                        id="bln_estimasi">
                                        <option selected>Bulan Estimasi</option>
                                        <option value="Januari">Januari</option>
                                        <option value="Februari">Februari</option>
                                        <option value="Maret">Maret</option>
                                        <option value="April">April</option>
                                        <option value="Mei">Mei</option>
                                        <option value="Juni">Juni</option>
                                        <option value="Juli">Juli</option>
                                        <option value="Agustus">Agustus</option>
                                        <option value="September">September</option>
                                        <option value="Oktober">Oktober</option>
                                        <option value="November">November</option>
                                        <option value="Desember">Desember</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
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
