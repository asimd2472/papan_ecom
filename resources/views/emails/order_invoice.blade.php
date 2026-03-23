<!DOCTYPE html>
<html lang="en" style="width: 100%; padding: 0; margin: 0;">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>order Teamplate</title>
    <!-- Google font  Poppins-->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body style="padding: 0; margin: 0; font-family: 'Poppins', sans-serif;">
    <table style="max-width: 900px; width: 100%; padding: 0; margin: 0 auto; border-spacing: 0px; border-collapse: collapse;">
        <tbody>
            <tr>
                <td>
                    <table style="width: 100%; background: #fff; padding: 0; margin: 50px auto 0; border-spacing: 0px; border-collapse: collapse;">
                        <thead>
                            <tr style="margin: 30px auto;">
                                <th>
                                    <a href="#" style="display: inline-block; text-decoration: none; padding: 0; margin: 30px 0;">
                                        <img style="width: 140px;" src="{{ Vite::asset('resources/front/images/logopng.png')}}" alt="">
                                    </a>
                                </th>
                            </tr>
                            <tr>
                                <td style="border-top: 1px solid rgba(145, 158, 171, 0.24);">
                                    <h4 style="padding: 0; margin: 20px 0; font-size: 45px; color: #11c7f7; text-align: center;">Order Summary</h4>
                                </td>
                            </tr>
                        </thead>
                    </table>

                    <table style="width: 100%; background: #fff; padding: 0; margin: 0 auto; border-spacing: 0px; border-collapse: collapse;">
                        <tbody>
                            <tr>
                                <td>
                                    <table style="max-width: 700px; width: 100%; padding: 0; margin: 0 auto; border-spacing: 0px; border-collapse: collapse;">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <p style="padding: 0; margin: 0; font-size: 16px; color: #000; text-align: center;">By order #{{$order_no}}</p>
                                                    {{-- <p style="padding: 0; text-align: center;"><a href="#" style="display: inline-block; border-radius: 5px; background-color: #11c7f7; color: #fff; text-decoration: none; padding: 5px 10px; font-size: 15px;">View your order</a></p> --}}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <table cellspacing="0" cellpadding="0" style="width: 100%; background: #fff; padding: 0; margin: 0 auto; border-spacing: 0px; border-collapse: collapse;">
                        <tbody>
                            <tr>
                                <td>
                                    <table cellspacing="0" cellpadding="0" style="max-width: 850px; width: 100%; background: rgb(247, 247, 247); padding: 0; margin: 0 auto; border-spacing: 0px; border-collapse: collapse; border-radius: 10px;">
                                        <tbody>
                                            <tr>
                                                <td style="padding: 30px 0;">
                                                    <table cellspacing="0" cellpadding="0" style="max-width: 780px; width: 100%; background: rgb(247, 247, 247); padding: 0; margin: 0 auto; border-spacing: 0px; border-collapse: collapse;">
                                                        <thead>
                                                            <tr>
                                                                <th style="text-align: left; padding: 0 5px 15px; color: #000; border-bottom: 1px solid rgba(145, 158, 171, 0.24);">Product</th>
                                                                <th style="text-align: right; padding: 0 5px 15px; color: #000; border-bottom: 1px solid rgba(145, 158, 171, 0.24); white-space: nowrap;">Unit Price</th>
                                                                <th style="text-align: center; padding: 0 5px 15px; color: #000; border-bottom: 1px solid rgba(145, 158, 171, 0.24);">Quantity</th>
                                                                <th style="text-align: right; padding: 0 5px 15px; color: #000; border-bottom: 1px solid rgba(145, 158, 171, 0.24);">Amount</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php $total =0; @endphp
                                                            @foreach ($cart_item as $key=> $item)
                                                                @php
                                                                    $total +=($item->price*$item->quantity);
                                                                @endphp
                                                            <tr>
                                                                <td style="padding: 5px;">
                                                                    <p style="padding: 0; margin: 0; font-size: 14px; display: flex; align-items: center; color: #04041c;">{{$item->name}}</p>
                                                                </td>
                                                                <td style="text-align: center; padding: 5px; width: 20%; color: #04041c;">${{($item->price)}}</td>
                                                                <td style="text-align: right; padding: 5px; width: 20%; color: #04041c;">{{$item->quantity}}</td>
                                                                <td style="text-align: right; padding: 5px; width: 20%; color: #04041c;">${{($item->price*$item->quantity)}}</td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                        <tfoot>

                                                            <tr>
                                                                <td align="right" colspan="3" style="padding: 5px; color: #11c7f7; border-top: 1px solid rgba(145, 158, 171, 0.24)"><strong>Subtotal:</strong></td>
                                                                <td align="right" colspan="2" style="padding: 5px; color: #11c7f7; border-top: 1px solid rgba(145, 158, 171, 0.24)"><strong>{{$total}}</strong></td>
                                                            </tr>
                                                            <tr>
                                                                <td align="right" colspan="3" style="padding: 5px; color: #11c7f7; border-top: 1px solid rgba(145, 158, 171, 0.24)"><strong>Discount:</strong></td>
                                                                <td align="right" colspan="2" style="padding: 5px; color: #11c7f7; border-top: 1px solid rgba(145, 158, 171, 0.24)"><strong>{{$discount}}</strong></td>
                                                            </tr>
                                                            <tr>
                                                                <td align="right" colspan="3" style="padding: 5px; color: #11c7f7; border-top: 1px solid rgba(145, 158, 171, 0.24)"><strong>Shipping charge:</strong></td>
                                                                <td align="right" colspan="2" style="padding: 5px; color: #11c7f7; border-top: 1px solid rgba(145, 158, 171, 0.24)"><strong>{{$shipping_charges}}</strong></td>
                                                            </tr>
                                                            @if($tax_amount!=0)
                                                            <tr>
                                                                <td align="right" colspan="3" style="padding: 5px; color: #11c7f7; border-top: 1px solid rgba(145, 158, 171, 0.24)"><strong>Tax:</strong></td>
                                                                <td align="right" colspan="2" style="padding: 5px; color: #11c7f7; border-top: 1px solid rgba(145, 158, 171, 0.24)"><strong>{{$tax_amount}}</strong></td>
                                                            </tr>
                                                            @endif

                                                            <tr>
                                                                <td align="right" colspan="3" style="padding: 5px; color: #11c7f7; border-top: 1px solid rgba(145, 158, 171, 0.24)"><strong>Total:</strong></td>
                                                                <td align="right" colspan="2" style="padding: 5px; color: #11c7f7; border-top: 1px solid rgba(145, 158, 171, 0.24)"><strong>{{$total_pay}}</strong></td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <table cellspacing="0" cellpadding="0" style="width: 100%; background: #fff; padding: 0; margin: 0 auto 50px; border-spacing: 0px; border-collapse: collapse;">
                        <tfoot>
                            <tr>
                                <td style="padding-top: 30px;">
                                    <p style="padding: 0; margin: 30px 0 0 0; font-size: 14px; color: #04041c; text-align: center;">Sincerely,</p>
                                    <p style="padding: 0 0 40px 0; margin: 0px; font-size: 14px; color: #04041c; text-align: center;">The {{env('APP_NAME')}} team</p>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>

</body>
</html>
