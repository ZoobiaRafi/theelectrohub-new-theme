<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <style>
        @page {
            @bottom-center {
            content: "2024 © Copyright  Electro Hub - All rights Reserved";
            color: #ff6600;
            }
        }
        body {
            margin: 0;
            padding: 0;
            font-family: "M PLUS Rounded 1c", sans-serif;
            /* background-color: #f7f7f7; */
            color: #444;
            line-height: 1;
        }

        .container {
            max-width: 800px;
            margin: 9px 10px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        /* .header, */
        /* .order-summary, */
        .customer-info
        {
            padding: 15px;
            border-bottom: 1px solid #333;
        }

        .header h1 {
            margin: 0;
            font-size: 18px;
            color: #333;
        }

        .header p {
            margin: 5px 0;
            font-size: 13px;
            color: #666;
        }

        .customer-info h3,
        .order-summary h3 {
            margin: 0 0 10px;
            color: #333;
            font-size: 18px;
        }

        .customer-info p,
        .order-summary table {
            margin: 0;
            color: #666;
        }

        .order-summary table {
            width: 100%;
            border: 1px solid #333;
            border-collapse: collapse;

            /* border: 1px solid #ff6600; */
         }

        .order-summary table tbody,
        .order-summary table tfoot{
            border: 1px solid #333;
            /* border-bottom: 1px solid #333; */
        }
        .order-summary table tfoot tr{
            line-height: 1;
        }
        .order-summary table tfoot tr td{
            font-size: 12px;
            /* border: 1px solid #333; */

        }
        .order-summary table thead tr th{
            padding-left: 3px;
            padding-right: 3px;
        }

        .order-summary table tbody tr{
            padding-left: 4px;
            padding-right: 4px;
        } 
        .order-summary table tbody tr td{
            border: 1px solid #333;
            border-collapse: collapse;
        }

        .order-summary table th{
            padding: 10px 0;
            border-bottom: 1px solid #333;
            text-align: center;
            border: 1px solid #333;
            font-size: 14px;
            font-weight: bold;
            color: #333;
        }
        .order-summary table td {
            padding: 10px 0;
            /* border-bottom: 1px solid #333; */
            text-align: right;
            font-size: 12px;
        }

        .row{
            display: flex;
            width: 100%;
        }
        .row .header .heading{
            display: flex;
            align-items: center;
            justify-content:center ;
        }
        .row .header .heading-2{
            display: flex;
            align-items: center;
            /* justify-content:center ; */
        }
        .badge.bg-success{
            background-color: green;
            color: #fff;
            font-weight: 800;
            padding: 5px 10px;
            border-radius: 9px;
            margin-left: 5px;
        }
        .badge.bg-pending{
            background-color: #f7cb73;
            color: #ff6600;
            font-weight: 800;
            padding: 5px 10px;
            border-radius: 9px;
            margin-left: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="header">
                <div class="col-6" style="margin:0;">
                    <div class="heading" style="margin:0;">
                        <!-- <img src="{{ url('storage') }}/{{ setting('site.logo-black') }}" alt="logo"> -->
                        <!-- <img src="{{public_path('/frontend/logo-black.png')}}" alt="logo"> -->
                        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('frontend/logo-black.png'))) }}" alt="logo">
                    </div>
                </div>
                <div class="col-6"style="margin:0;">
                    <div class="heading"style="margin:0;">
                        <h1 style="text-align: right; margin-top:-25px;">Invoice # {{$OrderInfo->order_no}}
                        @if($OrderInfo->payment_status != "pending")
                        <span class="badge bg-success">Paid</span>
                        @else
                        <span class="badge bg-pending">Pending</span>
                        @endif
                        </h1>
                    </div>
                </div>
                <div class="col-12">
                    <div class="heading-2" style="margin:0; margin-bottom:10px">
                        <!-- <h1 style="text-align: right;">Invoice # {{$OrderInfo->order_no}}<span class="badge bg-success">Paid</span></h1> -->
                        <h3>Billing details</h3>
                        <p>{{ ucwords($OrderInfo->name) }}</p>
                        <p>@if(isset($OrderInfo->address)){{ $OrderInfo->address }}, @endif
                            @if(isset($OrderInfo->city)) {{ $OrderInfo->city }}, @endif 
                            @if(isset($OrderInfo->postal_code))	{{ $OrderInfo->postal_code }} @endif
                        </p>
                        <p>@if(isset($OrderInfo->email)) {{ $OrderInfo->email }} @endif | @if(isset($OrderInfo->contact_no)){{ $OrderInfo->contact_no }} @endif
                        </p>
                    </div>
                </div>
                
            </div>
        </div>

        <div class="order-summary">
            <h3>Order Summary</h3>
            <table>
                <thead>
                    <tr>
                        <th style="text-align: center; ">SNo.</th>
                        <th  style="" colspan="3">Product</th>
                        <th style="text-align: left;">Price</th>
                        <th style="text-align: center;">Quantity</th>
                        <th style="text-align: right;">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $vat = 0;	
                        $subtotal = 0;	
                        $count = 0;
                    @endphp
																								
                    @foreach($OrderInfo->order_products as $op)
                        @php
                            $count = $count + 1;
                        @endphp
                        <tr>
                            <td style="text-align: center;">{{ $count }}</td>
                            <td colspan="3" style="text-align: left;  word-wrap: break-word; padding-right:10px; padding-left: 5px;">{{ ucwords($op->product_detail ? $op->product_detail->title : "") }}</td>
                            <td style="text-align: center;">&pound;{{ number_format($op->price , 2) }}</td>
                            <td style="text-align: center;">{{ $op->quantity }}</td>
                            <td style="text-align: center;font-weight: 400; font-family: 'M PLUS Rounded 1c', sans-serif;">&pound;{{ number_format($op->quantity * $op->price,2) }}</td>
                        </tr>
                        @php
                            $subtotal += $op->price	* $op->quantity;
                        @endphp
                    @endforeach

                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5" style="text-align: right; padding-right:5px; font-size:14px; "><strong>Sub Total: </strong></td>
                        <td colspan="2" style="text-align: right; padding-right:5px; font-size:14px; "><strong>&pound;{{number_format($subtotal, 2)}}</strong></td>
                    </tr>
                    @if(floatval($OrderInfo->order_discount) > 0 )
                    <tr>
                        <td colspan="5" style="text-align: right; padding-right:5px; font-size:14px; color:#ff6600;"><strong>Discount: </strong></td>
                        <td colspan="2" style="text-align: right; padding-right:5px; font-size:14px; color:#ff6600;"><strong> - &pound;{{number_format($OrderInfo->order_discount , 2)}}</strong></td>
                    </tr>
                    @endif
                    @if( $OrderInfo->shipping_total <= 0)
                    <tr>
                        <td colspan="5" style="text-align: right; padding-right:5px; font-size:14px; color:#ff6600;"><strong>Delivery Charges: </strong></td>
                        <td colspan="2" style="text-align: right; padding-right:5px; font-size:14px; color:#ff6600;"><strong>Free</strong></td>
                    </tr>
                    @else
                    <tr>
                        <td colspan="5" style="text-align: right; padding-right:5px; font-size:14px; "><strong>Delivery Charges: </strong></td>
                        <td colspan="2" style="text-align: right; padding-right:5px; font-size:14px; "><strong>&pound;{{ number_format($OrderInfo->shipping_total,2) }}</strong></td>
                    </tr>
                    @endif
                    @if($subtotal <= setting('site.vat'))
                        @php
                            $vat += ($subtotal - floatval($OrderInfo->order_discount))  * 20/100;	
                        @endphp
                        <tr>
                            <td colspan="5" style="text-align: right; padding-right:5px; font-size:14px; "><strong>VAT: </strong></td>
                            <td colspan="2" style="text-align: right; padding-right:5px; font-size:14px; "><strong>&pound;{{ number_format($vat,2) }}</strong></td>
                        </tr>
                    @endif
                    <tr>
                        <td colspan="5" style="text-align: right; padding-right:5px; font-size:14px; font-weight:900; color: #333;"><strong>Total: </strong></td>
                        <td colspan="2" style="text-align: right; padding-right:5px; font-size:14px; font-weight:900; color: #333;"><strong>&pound;{{ number_format($OrderInfo->order_total,2) }}</strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>

    </div>
</body>
</html>
