@foreach ($categoryandType as $items)
    @if ($items->slug!='holiday')
        <li class="@if($singleCategory->id==$items->id) active @endif menu-item">
            @if(count($items->producttype)>0)
                <a href="javascript:void(0)" class="accordionBtn">{{$items->title}} <i class="fas fa-angle-down cdRight"></i></a>
            @else
                <a href="{{ route('product_categoty', $items->slug)}}" class="accordionBtn">{{$items->title}}</a>
            @endif
            @if(count($items->producttype)>0)
                <ul class="sub-menu">
                    <li><a href="{{ route('product_categoty', $items->slug)}}">Shop All</a></li>
                    @foreach ($items->producttype as $itemtype)
                        <li><a href="{{ route('product_listing_bytype', ['category_slug' => $items->slug, 'type_id' => base64_encode($itemtype->id)])}}">{{$itemtype->typename}}</a></li>
                    @endforeach
                </ul>
            @endif

        </li>
    @endif
@endforeach
