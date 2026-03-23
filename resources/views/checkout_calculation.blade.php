<table class="table">
    <thead>
        <tr>
            <th>image</th>
            <th>product name</th>
            <th class="text-center">quantity</th>
            <th class="text-end">unit price</th>
            <th class="text-end">total</th>
        </tr>
    </thead>
    <tbody>
        @php $total =0;  @endphp
        @foreach ($cart_item as $key=> $item)
            @php



                $total +=($item->price*$item->quantity);
            @endphp
            <tr>
                <td data-label="image :">
                    <div class="crt-product-img">
                        <a class="d-block" href="#"> <img class="img-block" src="{{asset("upload/product/images/".$item->attributes->product_image)}}"> </a>
                    </div>
                </td>
                <td data-label="product name :">
                    <div class="crt-product-name"> <a href="#">{{$item->name}}</a> </div>
                </td>
                <td data-label="quantity :" class="text-center">{{$item->quantity}}</td>
                <td data-label="unit price :" class="text-end">${{($item->price)}}</td>
                <td data-label="total :" class="text-end">${{($item->price*$item->quantity)}}</td>
            </tr>
        @endforeach
        <input type="hidden" name="total_amount" id="total_amount" value="{{$total}}">

    </tbody>
    <tfoot class="text-nowrap">
        <tr>
            <td class="text-end" colspan="4"><strong>Sub Total :</strong></td>
            <td class="text-end"><strong><span class="d-block">${{$total}}</span></strong></td>
        </tr>
        <tr>
            <td class="text-end" colspan="4"><strong>Coupon Discount :</strong></td>
            <td class="text-end"><strong><span class="d-block">${{$coupon_discount}}</span></strong></td>
        </tr>
        <tr>
            <td class="text-end" colspan="4"><strong>Shipping charge :</strong></td>
            <td class="text-end"><strong><span class="d-block">${{$shipping_charge}}</span></strong></td>
        </tr>
        @if($tax_amount!=0)
        <tr>
            <td class="text-end" colspan="4"><strong>Tax :</strong></td>
            <td class="text-end"><strong><span class="d-block">${{$tax_amount}}</span></strong></td>
        </tr>
        @endif
        <tr>
        <td class="text-end" colspan="4"><strong>Total :</strong></td>
        <td class="text-end"><strong><span class="d-block">${{$final_amount}}</span></strong></td>
        </tr>

        {{-- <tr class="hide_discount" style="display: none;">
            <td class="text-end" colspan="4"><strong>Discount :</strong></td>
            <td class="text-end"><strong><span class="d-block discount_amount"></span></strong></td>
        </tr>
        <tr class="hide_discount" style="display: none;">
            <td class="text-end" colspan="4"><strong>Sub Total :</strong></td>
            <td class="text-end"><strong><span class="d-block final_amount"></span></strong></td>
        </tr> --}}
        <input type="hidden" name="discount_amount" id="discount_amount" value="0">
    </tfoot>
</table>
