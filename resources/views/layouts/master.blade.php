<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>{{  $title ?? "Inventaris" }}</title>
  @include('layouts.style')
</head>

<body>
  <div id="app">
    <div class="main-wrapper">
        @include('layouts.navbar')
        @include('layouts.sidebar')

      <!-- Main Content -->
      <div class="main-content">
        @yield('content')
      </div>
        @include('layouts.footer')
    </div>
  </div>

  <!-- General JS Scripts -->
  @include('layouts.script')

  <!-- Page Specific JS File -->
</body>
</html>
