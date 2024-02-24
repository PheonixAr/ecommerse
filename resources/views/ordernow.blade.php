!@extends('master')
@section('content')
    <script type="text/javascript">
        $('#pastecontent').on('keyup', function() {
            $value = $(this).val();
            $.ajax({
                type: 'get',
                url: '{{ URL::to('searchcontent') }}',
                data: {
                    'search': $value
                },
                success: function(data) {
                    $('tbody').html(data);
                }
            });
        })
    </script>

    <div class="customer-product">
        <div class="col-sm-4">
            <table class="table">
                <h4>Order now</h4>
                <div class="ordernow">
                    <div class="order_address">
                        <h4> shipping to :</h4>
                        <hr>
                    </div>
                    <div class="order_items" id='orderitems'>
                        <p> Items : <span>${{ $total }}</span></p>
                        <p>Deleviry : <span>$40</span></p>
                        <p style="font-weight: bold"> Order Total : <span
                                style="color: rgb(177, 15, 15)">${{ $total + 40 }}</span></p>
                    </div>
                </div>
            </table>
            <div>
                <form action="checkout" method="POST">
                    @csrf
                    <div class="form-group">
                        <textarea id='pastecontent' name="address" placeholder="Enter your address" class="form-control"></textarea>
                    </div>
                    <div class="form-group" id='paymentmethod'>
                        <label for="pwd" style="padding:15px 10px 0px 10px">Payment Method</label>
                        <hr>

                        <input type="radio" value="online" name="payment"><span>online payment</span> <br> <br>
                        <input type="radio" value="EMI" name="payment"> <span>EMI payment</span> <br><br>
                        <input type="radio" value="cash on delivery" name="payment"> <span>Payment on Delivery</span> <br>
                        <br>

                    </div>
                    <button type="submit"class="btn btn-warning">Place Your Order</button>
                </form>
            </div>
        </div>
    </div>

    {{-- @include('payment') --}}
@endsection
