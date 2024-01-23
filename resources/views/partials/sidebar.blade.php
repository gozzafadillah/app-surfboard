<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading">Core</div>
            <a class="nav-link" href="/">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>
            <div class="sb-sidenav-menu-heading">Interface</div>
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProduk"
                aria-expanded="false" aria-controls="collapseProduk">
                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                Produksi
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseProduk" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="/dashboard/estimasi">Estimasi Produksi</a>
                    <a class="nav-link" href="/dashboard/produksi">Produksi</a>
                </nav>
            </div>
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseKaryawan"
                aria-expanded="false" aria-controls="collapseKaryawan">
                <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                Karyawan
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseKaryawan" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="/dashboard/karyawan">List Karyawan</a>
                </nav>
            </div>
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLaporan"
                aria-expanded="false" aria-controls="collapseLaporan">
                <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                Laporan
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseLaporan" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="#">Laporan Penjualan</a>
                </nav>
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="#">Laporan Produksi</a>
                </nav>
            </div>
        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="small">Logged in as:</div>
        {{ Auth::user()->nama }}
    </div>
</nav>
