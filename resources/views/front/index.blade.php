@extends('front.layout')

@section('content')
<div class="row">
  <!-- Product Image & Thumbnails -->
  <div class="col-md-5">
    <img src="https://plus.unsplash.com/premium_photo-1661769750859-64b5f1539aa8?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8cHJvZHVjdCUyMGltYWdlfGVufDB8fDB8fHww" alt="Main Product" class="img-fluid mb-3">
    <div class="d-flex gap-2">
      <img src="https://plus.unsplash.com/premium_photo-1661769750859-64b5f1539aa8?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8cHJvZHVjdCUyMGltYWdlfGVufDB8fDB8fHww" class="thumb active">
      <img src="https://plus.unsplash.com/premium_photo-1661769750859-64b5f1539aa8?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8cHJvZHVjdCUyMGltYWdlfGVufDB8fDB8fHww" class="thumb">
      <img src="https://plus.unsplash.com/premium_photo-1661769750859-64b5f1539aa8?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8cHJvZHVjdCUyMGltYWdlfGVufDB8fDB8fHww" class="thumb">
    </div>
  </div>

  <!-- Product Details -->
  <div class="col-md-7">
    <h4>Women's Top</h4>
    <div class="mb-2">
      <span class="fs-5 text-primary fw-bold">₹{{$price}}</span>
      @if(session()->has('USER_LOGIN'))
      <span class="price-original ms-2">₹{{$cutOfPrice}}</span>
      <span class="price-discount ms-2">({{$discount}}% OFF)</span>
      @endif
    </div>

    <p class="mb-2">Rock paper scissors... half sleeves girl's regular fit...</p>

    <table class="table table-sm w-auto mb-3">
      <tr><td>Brand</td><td>Pixelstrap</td></tr>
      <tr><td>Availability</td><td class="text-success">In Stock</td></tr>
      <tr><td>Seller</td><td>Hector Magana</td></tr>
      <tr><td>Material</td><td>Cotton</td></tr>
      <tr><td>Fit</td><td>Regular Fit</td></tr>
    </table>



    <!-- Quantity Selector -->
    <div class="d-flex align-items-center mb-3">
      <span class="me-2">Quantity</span>
      <form class="d-flex align-items-center">
        <button type="button" class="btn btn-outline-secondary btn-sm btn-minus">−</button>
        <input type="number" id="qty" value="1" min="1" max="10" readonly class="form-control mx-2 text-center" style="width: 60px;">
        <button type="button" class="btn btn-outline-secondary btn-sm btn-plus">+</button>
      </form>
    </div>

    <!-- Buttons -->
    <div class="d-flex gap-2 mb-4">
      <button class="btn btn-primary" id="addToCart">Add To Cart</button>
      <button class="btn btn-danger">Add To Wishlist</button>
    </div>

    <!-- Rating -->
    <div class="mb-4">
      <span class="text-warning">★ ★ ★ ★ ☆</span>
      <span>(250 reviews)</span>
    </div>

    <!-- Tabs -->
    <ul class="nav nav-tabs mb-2" role="tablist">
      <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#desc">Description</a></li>
      <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#info">Additional Info</a></li>
      <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#review">Write Review</a></li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane fade show active" id="desc">
        <p>The model is wearing a white blouse... see the image for a mock-up...</p>
        <p><strong>Fabric:</strong> Cotton</p>
        <p><strong>Size & Fit:</strong> Model height 5'8"</p>
        <p><strong>Material & Care:</strong> 100% cotton</p>
      </div>
    </div>
  </div>
</div>

{{-- <input type="hidden" id="product_id" value="1"> --}}
<input type="hidden" id="product_price" value="{{ $price }}">
@endsection
@section('js')

<script>
    getCartCount()

    $('.btn-plus').click(function () {
      let $qty = $('#qty');
      let val = parseInt($qty.val()) || 1;
      if (val < 10) $qty.val(val + 1);
    });

    $('.btn-minus').click(function () {
      let $qty = $('#qty');
      let val = parseInt($qty.val()) || 1;
      if (val > 1) $qty.val(val - 1);
    });

    $('#addToCart').click(function () {
    // let product_id = $('#product_id').val();
    let price = $('#product_price').val();
    let qty = $('#qty').val();

    $.ajax({
        url: "{{ url('/add-to-cart') }}",
        method: "POST",
        data: {
            _token: '{{ csrf_token() }}',
            // product_id: product_id,
            price: price,
            qty: qty
        },
        success: function (res) {
            toastr.success('Product added into cart');
            getCartCount();
        },
        error: function (err) {
            alert('Something went wrong. Please try again.');
        }
    });
});


function getCartCount(){
    $.ajax({
    url: "{{ url('/cart-count') }}",
    method: "GET",
    success: function (res) {
        // console.log(res.count);
        if(res.count){

            $('#cart-count').text(res.count);
        }else{
            $('#cart-count').text(0);

        }
    }
});
}





</script>
@endsection
