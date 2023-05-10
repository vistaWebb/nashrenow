@extends('home.layouts.home')

@section('title')
    index shop
@endsection


@section('content')
  <div class="breadcrumb-area pt-35 pb-35 bg-gray" style="direction: rtl;">
    <div class="container">
      <div class="breadcrumb-content text-center">
        <ul>
          <li>
            <a href="{{ route('home.index')}}">صفحه اصلی</a>
          </li>
          <li class="active">فروشگاه </li>
        </ul>
      </div>
    </div>
  </div>

  <form id="filter-form">
    <div class="shop-area pt-95 pb-100">
      <div class="container">
        <div class="row flex-row-reverse text-right">
          <!-- content -->
          <div class="col-12 order-1 order-sm-1 order-md-2">
            <!-- shop-top-bar -->


            <div class="shop-bottom-area mt-35">
              <div class="tab-content jump">

                <div class="row ht-products" style="direction: rtl;">
                  @foreach ($products as $product)
                    <div class="col-xl-4 col-md-6 col-lg-6 col-sm-6">
                      <!--Product Start-->
                      <div class="ht-product ht-product-action-on-hover ht-product-category-right-bottom mb-30">
                        <div class="ht-product-inner">
                          <div class="ht-product-image-wrap">
                            <a href="{{ route('home.products.show' , ['product' => $product->slug])}}" class="ht-product-image">
                              <img height="300" src="{{ asset(env('PRODUCT_IMAGES_UPLOAD_PATH') . $product->primary_image)}}" alt="{{ $product->name}}" alt="Universal Product Style" />
                            </a>
                            <div class="ht-product-action">
                              <ul>
                                <li>
                                  <a href="#" data-toggle="modal" data-target="#productModal-{{$product->id}}"><i
                                      class="sli sli-magnifier"></i><span class="ht-product-action-tooltip"> مشاهده سریع
                                    </span></a>
                                </li>
                                <li>
                                    @auth
                                        @if ($product->checkUserWishList(auth()->id()))
                                            <a href="{{ route('home.wishlist.remove' , ['product' => $product->id ]) }}"><i class="fas fa-heart" style="color:red"></i>
                                            <span class="ht-product-action-tooltip">   به لیست علاقه مندی ها اضافه شده است</span></a>
                                        @else
                                            <a href="{{ route('home.wishlist.add' , ['product' => $product->id ]) }}"><i class="sli sli-heart"></i>
                                            <span class="ht-product-action-tooltip"> افزودن به لیست علاقه مندی ها </span></a>
                                        @endif
                                    @else
                                        <a href="{{ route('home.wishlist.add' , ['product' => $product->id ]) }}"><i class="sli sli-heart"></i>
                                        <span class="ht-product-action-tooltip">افزودن به لیست علاقه مندی ها </span></a>
                                    @endauth
                                </li>

                              </ul>
                            </div>
                          </div>
                          <div class="ht-product-content">
                            <div class="ht-product-content-inner">
                              <div class="ht-product-categories">
                                <a href="{{ route('home.categories.show' , ['category'=>$product->category->slug ]) }}">{{$product->category->parent->name}}</a>
                              </div>
                              <h4 class="ht-product-title text-right">
                                <a href="product-details.html"> {{$product->name}}  </a>
                              </h4>
                              <div class="ht-product-price">
                              @if ($product->quantity > 0)
                <span class="new">
                    {{number_format($product->price)}}
                    تومان
                    </span>
                @else
                <div class="not-in-stock" >
                    <p class="text-wight">ناموجود</p>
                </div>
                @endif
                              </div>
                              <div class="ht-product-ratting-wrap">
                                <div
                                data-rating-stars="5"
                                data-rating-readonly="true"
                                data-rating-value="{{ceil($product->rates->avg('rate'))}}"
                                >
                                </div>
                              </div>
                            </div>

                          </div>
                        </div>
                      </div>
                      <!--Product End-->
                    </div>
                  @endforeach
                </div>

              </div>

              <div class="pro-pagination-style text-center mt-30">
                {{$products->withQueryString()->links()}}
              </div>

            </div>
          </div>

        </div>
      </div>
    </div>
  </form>


<!-- Modal -->
@foreach ($products as $product)
<div class="modal fade" id="productModal-{{$product->id}}" tabindex="-1" role="dialog">
   <div class="modal-dialog" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">x</span>
         </button>
       </div>
       <div class="modal-body">
         <div class="row">
           <div class="col-md-7 col-sm-12 col-xs-12" style="direction: rtl;">
             <div class="product-details-content quickview-content">
               <h2 class="text-right mb-4"> {{$product->name}}</h2>
               <div class="ht-product-price">
                @if ($product->quantity > 0)
                <span class="new">
                    {{number_format($product->price)}}
                    تومان
                    </span>
                @else
                <div class="not-in-stock" >
                    <p class="text-wight">ناموجود</p>
                </div>
                @endif
            </div>

            <div class="pro-details-rating-wrap">
                   <div
                   data-rating-stars="5"
                   data-rating-readonly="true"
                   data-rating-value="{{ceil($product->rates->avg('rate'))}}">
                   </div>
                   <span class="mx-2"> | </span>
                 <span>5دیدگاه  </span>
               </div>
               <p class="text-right">
                   {{$product->description}}
               </p>
               <form action="{{route('home.cart.add')}}" method="POST" >
                <input type="hidden" name="product_id" value="{{$product->id}}" >
                @csrf
                @if ($product->quantity > 0)
                    <div class="pro-details-quality">
                        <div class="cart-plus-minus">
                            <input class="cart-plus-minus-box quantity-input" type="text" name="qtybutton" value="1" data-max="{{$product->quantity}}" />
                        </div>
                        <div class="pro-details-cart">
                            <button type="submit">افزودن به سبد خرید</button>
                        </div>
                        <div class="pro-details-wishlist">
                            @auth
                                @if ($product->checkUserWishList(auth()->id()))
                                    <a href="{{ route('home.wishlist.remove' , ['product' => $product->id ]) }}">
                                        <i class="fas fa-heart" style="color:red"></i>
                                    </a>
                                @else
                                    <a href="{{ route('home.wishlist.add' , ['product' => $product->id ]) }}">
                                        <i class="sli sli-heart"></i>
                                    </a>
                                @endif
                            @else
                                <a href="{{ route('home.wishlist.add' , ['product' => $product->id ]) }}">
                                    <i class="sli sli-heart"></i>
                                </a>
                            @endauth
                        </div>
                    </div>
                @else
                    <div class="not-in-stock" >
                        <p class="text-wight">ناموجود</p>
                    </div>
                @endif
            </form>



               <div class="pro-details-meta">
                 <span>دسته بندی :</span>
                 <ul>
                   <li><a href="{{ route('home.categories.show' , ['category'=>$product->category->slug ]) }}">{{$product->category->parent->name}} , {{$product->category->name}}</a></li>
                 </ul>
               </div>
               <div class="pro-details-meta">
                 <span>تگ ها :</span>
                 <ul>
                   @foreach ($product->tags as $tag)
                    <li><a href="#">{{$tag->name}} {{$loop->last ? '' : ','}}</a></li>
                   @endforeach
                 </ul>
               </div>
             </div>
           </div>

           <div class="col-md-5 col-sm-12 col-xs-12">
             <div class="tab-content quickview-big-img">
               <div id="pro-primary{{$product->id}}" class="tab-pane fade show active">
                 <img src="{{ asset(env('PRODUCT_IMAGES_UPLOAD_PATH') . $product->primary_image)}}" alt="" />
               </div>
              @foreach ($product->images as $image )
               <div id="pro-{{$image->id}}" class="tab-pane fade">
                   <img src="{{ asset(env('PRODUCT_IMAGES_UPLOAD_PATH') . $image->image)}}" alt="" />
               </div>
              @endforeach
             </div>
             <!-- Thumbnail Large Image End -->
             <!-- Thumbnail Image End -->
             <div class="quickview-wrap mt-15">
               <div class="quickview-slide-active owl-carousel nav nav-style-2" role="tablist">
                 <a class="active" data-toggle="tab" href="#pro-primary{{$product->id}}">
                   <img src="{{ asset(env('PRODUCT_IMAGES_UPLOAD_PATH') . $product->primary_image)}}" alt="" /></a>

                 @foreach ($product->images as $image )
                 <a data-toggle="tab" href="#pro-{{$image->id}}">
                   <img src="{{ asset(env('PRODUCT_IMAGES_UPLOAD_PATH') . $image->image)}}" alt="" />
                 </a>
                 @endforeach
               </div>
             </div>
           </div>

         </div>
       </div>
     </div>
   </div>
 </div>
@endforeach
<!-- Modal end -->
</div>


@endsection
