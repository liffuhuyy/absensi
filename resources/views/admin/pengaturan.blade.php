<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Pengaturan</title>

  <link rel="shortcut icon" href="./assets/compiled/svg/favicon.svg" type="image/x-icon" />
  <link rel="stylesheet" href="assets/extensions/sweetalert2/sweetalert2.min.css" />
  <link rel="stylesheet" href="./assets/compiled/css/app.css" />
  <link rel="stylesheet" href="./assets/compiled/css/app-dark.css" />
</head>

<body>
  <script src="assets/static/js/initTheme.js"></script>
  <div id="app">
    <!-- Sidebar (potong agar tidak terlalu panjang) -->
    <div id="main">
      <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
          <i class="bi bi-justify fs-3"></i>
        </a>
      </header>

      <div class="page-heading">
        <div class="page-title">
          <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
              <h3>Pengaturan</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
              <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ url('/dashboardmin') }}">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Pengaturan</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>

        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Maintenance Mode</h4>
              <p class="text-muted">Atur status Maintenance</p>
              <div class="form-check form-switch fs-6">
                <input
                  class="form-check-input me-0"
                  type="checkbox"
                  id="toggle-maintenance"
                  style="cursor: pointer"
                />
                <label class="form-check-label" for="toggle-maintenance">Aktifkan Maintenance Mode</label>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="assets/extensions/sweetalert2/sweetalert2.all.min.js"></script>
  <script>
    // Inisialisasi toggle sesuai status awal, misal dari backend
    const toggle = document.getElementById("toggle-maintenance");
    // Contoh: fetch status maintenance dari backend jika perlu, set toggle.checked = true/false

    toggle.addEventListener("change", function () {
      if (this.checked) {
        Swal.fire({
          icon: "warning",
          title: "Maintenance Mode Aktif",
          text: "Website sedang dalam mode pemeliharaan.",
          timer: 2000,
          showConfirmButton: false,
        });
        // TODO: kirim status maintenance aktif ke server lewat fetch/AJAX
      } else {
        Swal.fire({
          icon: "success",
          title: "Maintenance Mode Nonaktif",
          text: "Website kembali normal.",
          timer: 2000,
          showConfirmButton: false,
        });
        // TODO: kirim status maintenance nonaktif ke server lewat fetch/AJAX
      }
    });
  </script>
</body>

</html>
