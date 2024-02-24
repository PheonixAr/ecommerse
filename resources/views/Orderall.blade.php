!@extends('master')
@section('content')
    <div class="customer-product">
        <div class="col-sm-4">
            <table class="table">
                <tbody>
                    <tr>
                        <td>Amount</td>
                        <td>${{ $total }}</td>
                    </tr>
                    <tr>
                        <td>tax</td>
                        <td>$0</td>
                    </tr>
                    <tr>
                        <td>Amount</td>
                        <td>$10</td>
                    </tr>
                    <tr>
                        <td>deleviry</td>
                        <td>${{ $total }}</td>
                    </tr>
                    <tr>
                        <td>Total Amount</td>
                        <td>${{ $total + 10 }}</td>
                    </tr>
                </tbody>
            </table>
            <div>
                <form action="/orderplace" method="POST">
                    @csrf
                    <div class="form-group">
                        <textarea name="address" placeholder="enter your address" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="pwd">Payment Method</label> <br> <br>
                        <input type="radio" value="online" name="payment"> <span>online payment</span> <br> <br>
                        <input type="radio" value="EMI" name="payment"> <span>EMI payment</span> <br><br>
                        <input type="radio" value="cash on delivery" name="payment"> <span>Payment on Delivery</span> <br>
                        <br>

                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
