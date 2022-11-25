<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>{{  $title ?? "Inventaris" }}</title>
  @include('layouts.style')
  <style>
    .red .active a,
    .red .active a:hover {
        background-color: red;
    }
    .nav-pills > .active > a, .nav-pills > .active > a:hover {
    background-color: red;
}
  </style>
</head>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="page-error">
          <div class="page-inner">
            <h1>500</h1>
            <div class="page-description">
            	Terjadi kesalahan
            </div>
            <div class="page-search">
              <div class="mt-3">
                <a class="btn btn-primary" href="{{ url('dashboard') }}">Kembali ke dashboard</a>
              </div>
            </div>
          </div>
        </div>
        <div class="simple-footer mt-5">
          Copyright &copy; Laboratorium IF Unjani 2022
        </div>
      </div>
    </section>
  </div>

  <!-- General JS Scripts -->
  @include('layouts.script')

  <!-- Page Specific JS File -->
</body>
</html>


