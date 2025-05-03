@extends('front.layout')

@section('content')
    <div class="container mt-4">
        <h4>My Cart</h4>

        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price (₹)</th>
                    <th>Qty</th>
                    <th>Total</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalPrice = 0;
                @endphp
                @if (count($cart) > 0)
                    @foreach ($cart as $list)
                        @php
                            $totalPrice = $totalPrice + $list->price * $list->qty;
                        @endphp
                        <tr data-id="{{ $list->id }}">
                            <td>demo</td>
                            <td class="price">{{ $list->price }}</td>
                            <td class="d-flex align-items-center">
                                <button type="button" class="btn btn-sm btn-outline-secondary btn-minus">−</button>
                                <input type="number" class="form-control qty mx-1 text-center" readonly
                                    value="{{ $list->qty }}" data-id="{{ $list->id }}" min="1" max="10"
                                    style="width: 60px;">
                                <button type="button" class="btn btn-sm btn-outline-secondary btn-plus">+</button>
                            </td>
                            <td class="item-total">{{ $list->price * $list->qty }}</td>
                            <td>
                                <a href="{{ url('/delete-cart-item') }}/{{ $list->id }}"><button
                                        class="btn btn-sm btn-danger btn-delete">×</button></a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" class="text-center text-muted">No item found in cart.</td>
                    </tr>
                @endif
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="2">Total</th>
                    <th></th>
                    <th id="grand-total">{{ $totalPrice }}</th>
                </tr>
            </tfoot>
        </table>
    </div>

@endsection
@section('js')
    <script>
        getCartCount()



        function getCartCount() {
            $.ajax({
                url: "{{ url('/cart-count') }}",
                method: "GET",
                success: function(res) {
                    // console.log(res.count);
                    if (res.count) {

                        $('#cart-count').text(res.count);
                    } else {
                        $('#cart-count').text(0);

                    }
                }
            });
        }


        function updateQty(id, qty, inputElement) {
            $.ajax({
                url: '{{ url('/update-cart-qty') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id,
                    qty: qty
                },
                success: function() {

                    var row = $(inputElement).closest('tr');
                    var price = parseFloat(row.find('.price').text());
                    row.find('.item-total').text((price * qty));
                    updateCartSummary();
                }
            });
        }

        $('.btn-plus').click(function() {
            var row = $(this).closest('tr');
            var input = row.find('.qty');
            var qty = parseInt(input.val());
            if (qty < 10) {
                qty++;
                input.val(qty);
                var id = input.data('id');
                updateQty(id, qty, input);
            }
        });

        $('.btn-minus').click(function() {
            var row = $(this).closest('tr');
            var input = row.find('.qty');
            var qty = parseInt(input.val());
            if (qty > 1) {
                qty--;
                input.val(qty);
                var id = input.data('id');
                updateQty(id, qty, input);
            }
        });



        function updateCartSummary() {
            var totalQty = 0;
            var totalPrice = 0;
            $('tr').each(function() {
                var qty = parseInt($(this).find('.qty').val()) || 0;
                var price = parseFloat($(this).find('.price').text()) || 0;
                totalQty += qty;
                totalPrice += qty * price;
            });

            $('#total-qty').text(totalQty);
            $('#grand-total').text(totalPrice);
        }
    </script>
@endsection
