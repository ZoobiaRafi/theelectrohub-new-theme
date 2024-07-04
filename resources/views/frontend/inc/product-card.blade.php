@php 
    $flag = 0;
    foreach($wishlistitems as $items){
        if($items->product_id == $product->id){
            $flag = 1;
        }
    }
@endphp
<div class="product-item  mx-1 remove-divider h-256">
    <div class="product-item__outer h-100 w-100">
        <div class="product-item__inner px-wd-4 p-2 p-md-3">
            <div class="product-item__body pb-xl-2">
                <h5 class="d-none d-md-block mb-1 product-item__title"><a class="text-blue font-weight-bold" title="{{$product->title}}" href="{{ url(implode('/', $routeParameters))}}">{{$product->title}}</a></h5>
                <h5 class="d-md-none d-block mb-1 product-item__title text-ellipsis text-center"><a class="text-blue font-weight-bold" title="{{$product->title}}" href="{{ url(implode('/', $routeParameters))}}">{{$product->title}}</a></h5>
                <div class="mb-2">
                    <a href="{{ url(implode('/', $routeParameters))}}" class="d-block text-center">
                    @php
                        $images = [];
                        if (isset($product->uploader_image)) {
                            $images = json_decode($product->uploader_image, true);
                            if (json_last_error() !== JSON_ERROR_NONE) {
                                $images = explode(',', $product->uploader_image);
                            }
                        }

                        $imageUrl = '';
                        foreach ($images as $image) {
                            if (!filter_var($image, FILTER_VALIDATE_URL)) {
                                if (file_exists(public_path($image))) {
                                    $imageUrl = $image;
                                    break;
                                }
                            } else {
                                if (getimagesize($image)) {
                                    $imageUrl = $image;
                                    break;
                                }
                            }
                        }

                        if (empty($imageUrl) && $product->image) {
                            $imageUrl = $product->image;
                        }

                        if(empty($imageUrl) && !isset($product->image))
                        {
                            $imageUrl= url('/frontend/background/no-image-teh.png');
                        }


                        if (!filter_var($imageUrl, FILTER_VALIDATE_URL)) {
                            if (!file_exists(public_path($imageUrl))) {
                                $imageUrl = '/public' . $imageUrl;
                            }
                            else {
                                $imageUrl = '/' . $imageUrl;
                            }
                        }
                    @endphp
                    <img class="w-100" src="{{($imageUrl)}}" alt="{{$product->title}}">
                    </a>
                </div>
                <div class="flex-center-between mb-1 position-relative">
                    <!-- <div class="position-absolute font-size-12 font-weight-bold left-0 top-0 bg-green rounded text-white text-lh-21 px-2 mt-n4">
                        -72%
                    </div> -->
                   
                    <div class="prodcut-price">
                        <div class="text-gray-100 nowrap">£@if($product->price != null){{number_format($product->price_including_vat,2)}}@else 0.00 @endif <span class="font-size-12 pt-2 px-1 d-md-block d-none">inc. V.A.T</span></div>
                        <div class="text-gray-100 font-size-12 d-md-block d-none"> ex. V.A.T £{{number_format($product->price,2)}}</div>
                    </div>
                    <div class="cart-wish d-md-none d-flex align-items-end justify-content-end" style="gap:4px;">
                        <div class="product-wishlist d-block d-md-none bg-primary-light text-ellipsis">
                            <a data-id="{{$product->id}}" @if($flag == 1) style="pointer-events: none;color: var(--primary);" @endif href="javascript:void(0);" class="font-size-13 add-to-wishlist-phone btn-add-to-wishlist-{{$product->id}}">
                            @if($flag == 1)
                                <i class="yith-wcwl-icon fa fa-heart"></i>
                            @else 
                            <i class="ec ec-favorites font-size-15 wish-icon"></i>
                            @endif</a>
                        </div>
                        <div class="prodcut-add-cart">
                            <a data-qty="1" data-id="{{$product->id}}" href="javascript:void(0);" class="btn-add-cart btn-primary transition-3d-hover btn-add-cart-{{$product->id}}"><i class="ec ec-add-to-cart"></i></a>
                            <!-- <a href="{{ url(implode('/', $routeParameters))}}" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a> -->
                        </div>
                    </div>
                    <div class="prodcut-add-cart d-none d-md-flex">
                        <a data-qty="1" data-id="{{$product->id}}" href="javascript:void(0);" class="btn-add-cart btn-primary transition-3d-hover btn-add-cart-{{$product->id}}"><i class="ec ec-add-to-cart"></i></a>
                        <!-- <a href="{{ url(implode('/', $routeParameters))}}" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a> -->
                    </div>
                    
                </div>
            </div>
            
            <div class="product-item__footer">
                <div class="border-top pt-2 flex-center-between flex-wrap d-flex justify-content-center align-items-center">
                    <a href="#" class="text-gray-6 font-size-13 d-none"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                    <a data-id="{{$product->id}}" @if($flag == 1) style="pointer-events: none;color: var(--primary);" @endif href="javascript:void(0);" class="text-gray-6 font-size-13 add-to-wishlist btn-add-to-wishlist-{{$product->id}}">
                    @if($flag == 1)
                        <i class="yith-wcwl-icon fa fa-heart"></i> Added 
                     @else 
                     <i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist 
                     @endif</a>
                </div>
            </div>
        </div>
    </div>
</div>