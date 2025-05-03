<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>@yield('title', 'Product Details')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>
  <style>
    .price-original { text-decoration: line-through; color: #aaa; }
    .price-discount { color: green; font-weight: bold; }
    .color-swatch { width: 20px; height: 20px; display: inline-block; border-radius: 50%; margin-right: 5px; border: 1px solid #ccc; }
    .thumb { width: 60px; border: 2px solid transparent; cursor: pointer; }
    .thumb.active { border-color: #007bff; }
  </style>
</head>
<body>
  @include('front.includes.header')
  <div class="container py-5">
    @yield('content')
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  @yield("js")

  <script>
    @if(session('success'))
        toastr.success("{{ session('success') }}");
    @endif

    @if(session('error'))
        toastr.error("{{ session('error') }}");
    @endif
</script>

</body>
</html>
