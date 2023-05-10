@extends('home.layouts.home')

@section('title')
index home
@endsection

@section('content')

{{-- carosel --}}
<div class="slider-area section-padding-1 ">
    <div class="slider-active owl-carousel nav-style-1 ">
      <div class="single-slider slider-height-1 bg-paleturquoise">
        <div class="container">
          <div class="row align-items-center">

            <div class="col-12  ">
              <div class="slider-single-img slider-animated-1">

                <img class="animated" src="{{asset('images/slider/قصه-های-احکام.jpg')}}" alt="" />
              </div>
            </div>
          </div>
        </div>
    </div>
    <div class="single-slider slider-height-1 bg-paleturquoise">
        <div class="container">
          <div class="row align-items-center">

            <div class="col-xl-12">
              <div class="slider-single-img slider-animated-1">

                <img class="animated" src="{{asset('images/slider/نماز-گل-سرخ.jpg')}}" alt="" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>


{{-- product-category --}}
<div class="product-area mt-5">
    <div class="container">
      <div class="section-title text-center">
        <h2 >موضوعات منتخب   </h2>
        <div class="heading-line mb-4"></div>
      </div>
      <div class="product-tab-list nav pb-60 text-center flex-row-reverse">
        <a class="active" href="#product-1" data-toggle="tab">
          <h4>ادبیات</h4>
        </a>
        <a href="#product-2" data-toggle="tab">
          <h4>تاریخ</h4>
        </a>
        <a href="#product-3" data-toggle="tab">
          <h4>اندیشه </h4>
        </a>
      </div>
      <div class="tab-content jump-2">
        <div id="product-1" class="tab-pane active">
          <div class="ht-products product-slider-active owl-carousel">
            <!--Product Start-->
            @foreach ($adabProducts as $adabProduct)
            <div class="ht-product ht-product-action-on-hover ht-product-category-right-bottom mb-30">
              <div class="ht-product-inner">
                <div class="ht-product-image-wrap">
                  <a href="{{ route('home.products.show' , ['product' => $adabProduct->slug])}}" class="ht-product-image">
                    <img height="400px" src="{{ asset(env('PRODUCT_IMAGES_UPLOAD_PATH') . $adabProduct->primary_image)}}" alt="Universal Product Style" />
                  </a>
                  <div class="ht-product-action">
                    <ul>
                      <li>
                        <a href="#" data-toggle="modal" data-target="#productModal-{{$adabProduct->id}}"><i
                            class="sli sli-magnifier"></i><span class="ht-product-action-tooltip"> مشاهده سریع
                          </span></a>
                      </li>
                      <li>
                        @auth
                            @if ($adabProduct->checkUserWishList(auth()->id()))
                                <a href="{{ route('home.wishlist.remove' , ['product' => $adabProduct->id ]) }}"><i class="fas fa-heart" style="color:red"></i>
                                <span class="ht-product-action-tooltip">   به لیست علاقه مندی ها اضافه شده است</span></a>
                            @else
                                <a href="{{ route('home.wishlist.add' , ['product' => $adabProduct->id ]) }}"><i class="sli sli-heart"></i>
                                <span class="ht-product-action-tooltip"> افزودن به لیست علاقه مندی ها </span></a>
                            @endif
                        @else
                            <a href="{{ route('home.wishlist.add' , ['product' => $adabProduct->id ]) }}"><i class="sli sli-heart"></i>
                            <span class="ht-product-action-tooltip">افزودن به لیست علاقه مندی ها </span></a>
                        @endauth
                        </li>
                        {{-- <li>
                            <form action="{{route('home.cart.add')}}" method="POST" >
                                <input type="hidden" name="product_id" value="{{$adabProduct->id}}" >
                                @csrf
                            <button href="#"><i  type="submit"  class="sli sli-bag"></i><span class="ht-product-action-tooltip"> افزودن به سبد
                                خرید </span></button>
                            </form>
                        </li> --}}
                    </ul>
                  </div>
                </div>
                <div class="ht-product-content">
                  <div class="ht-product-content-inner">
                    <div class="ht-product-categories">
                      <a href="{{ route('home.categories.show' , ['category'=>$adabProduct->category->slug ]) }}">{{$adabProduct->category->parent->name}}</a>
                    </div>
                    <h4 class="ht-product-title text-right">
                      <a href="product-details.html">{{$adabProduct->name}}</a>
                    </h4>
                    <div class="ht-product-price">
                        @if ($adabProduct->quantity > 0)
                        <span class="new">
                            {{number_format($adabProduct->price)}}
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
                        data-rating-value="{{ceil($adabProduct->rates->avg('rate'))}}">
                        </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
            @endforeach
            <!--Product End-->
          </div>
        </div>

        <div id="product-2" class="tab-pane">
          <div class="ht-products product-slider-active owl-carousel">
            <!--Product Start-->
            @foreach ($tarikhProducts as $tarikhProduct)
            <div class="ht-product ht-product-action-on-hover ht-product-category-right-bottom mb-30">
              <div class="ht-product-inner">
                <div class="ht-product-image-wrap">
                  <a href="product-details.html" class="ht-product-image">
                    <img  height="400px" src="{{ asset(env('PRODUCT_IMAGES_UPLOAD_PATH') . $tarikhProduct->primary_image)}}" alt="Universal Product Style" />
                  </a>
                  <div class="ht-product-action">
                    <ul>
                      <li>
                        <a href="#" data-toggle="modal" data-target="#productModal-{{$tarikhProduct->id}}"><i
                            class="sli sli-magnifier"></i><span class="ht-product-action-tooltip"> مشاهده سریع
                          </span></a>
                      </li>
                      <li>
                        @auth
                            @if ($tarikhProduct->checkUserWishList(auth()->id()))
                                <a href="{{ route('home.wishlist.remove' , ['product' => $tarikhProduct->id ]) }}"><i class="fas fa-heart" style="color:red"></i>
                                <span class="ht-product-action-tooltip">   به لیست علاقه مندی ها اضافه شده است</span></a>
                            @else
                                <a href="{{ route('home.wishlist.add' , ['product' => $tarikhProduct->id ]) }}"><i class="sli sli-heart"></i>
                                <span class="ht-product-action-tooltip"> افزودن به لیست علاقه مندی ها </span></a>
                            @endif
                        @else
                            <a href="{{ route('home.wishlist.add' , ['product' => $tarikhProduct->id ]) }}"><i class="sli sli-heart"></i>
                            <span class="ht-product-action-tooltip">افزودن به لیست علاقه مندی ها </span></a>
                        @endauth
                        </li>

                    </ul>
                  </div>
                </div>
                <div class="ht-product-content">
                  <div class="ht-product-content-inner">
                    <div class="ht-product-categories">
                      <a href="{{ route('home.categories.show' , ['category'=>$tarikhProduct->category->slug ]) }}">{{$tarikhProduct->category->parent->name}}</a>
                    </div>
                    <h4 class="ht-product-title text-right">
                      <a href="product-details.html">{{$tarikhProduct->name}} </a>
                    </h4>
                    <div class="ht-product-price">
                      @if ($tarikhProduct->quantity > 0)
                      <span class="new">
                          {{number_format($tarikhProduct->price)}}
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
                    data-rating-value="{{ceil($tarikhProduct->rates->avg('rate'))}}">
                    </div>
                </div>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
            <!--Product End-->
          </div>
        </div>

        <div id="product-3" class="tab-pane">
          <div class="ht-products product-slider-active owl-carousel">
            <!--Product Start-->
            @foreach ($andishehProducts as $andishehProduct)
            <div class="ht-product ht-product-action-on-hover ht-product-category-right-bottom mb-30">
              <div class="ht-product-inner">
                <div class="ht-product-image-wrap">
                  <a href="product-details.html" class="ht-product-image">
                    <img  height="400px" src="{{ asset(env('PRODUCT_IMAGES_UPLOAD_PATH') . $andishehProduct->primary_image)}}" alt="Universal Product Style" />
                  </a>
                  <div class="ht-product-action">
                    <ul>
                      <li>
                        <a href="#" data-toggle="modal" data-target="#productModal-{{$andishehProduct->id}}"><i
                            class="sli sli-magnifier"></i><span class="ht-product-action-tooltip"> مشاهده سریع
                          </span></a>
                      </li>
                      <li>
                        @auth
                            @if ($andishehProduct->checkUserWishList(auth()->id()))
                                <a href="{{ route('home.wishlist.remove' , ['product' => $andishehProduct->id ]) }}"><i class="fas fa-heart" style="color:red"></i>
                                <span class="ht-product-action-tooltip">   به لیست علاقه مندی ها اضافه شده است</span></a>
                            @else
                                <a href="{{ route('home.wishlist.add' , ['product' => $andishehProduct->id ]) }}"><i class="sli sli-heart"></i>
                                <span class="ht-product-action-tooltip"> افزودن به لیست علاقه مندی ها </span></a>
                            @endif
                        @else
                            <a href="{{ route('home.wishlist.add' , ['product' => $andishehProduct->id ]) }}"><i class="sli sli-heart"></i>
                            <span class="ht-product-action-tooltip">افزودن به لیست علاقه مندی ها </span></a>
                        @endauth
                        </li>
                    </ul>
                  </div>
                </div>
                <div class="ht-product-content">
                  <div class="ht-product-content-inner">
                    <div class="ht-product-categories">
                      <a href="{{ route('home.categories.show' , ['category'=>$andishehProduct->category->slug ]) }}">{{$andishehProduct->category->parent->name}}</a>
                    </div>
                    <h4  class="ht-product-title text-right ">
                      <a  href="#">{{$andishehProduct->name}} </a>
                    </h4>
                    <div class="ht-product-price">
                      @if ($andishehProduct->quantity > 0)
                      <span class="new">
                          {{number_format($andishehProduct->price)}}
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
                    data-rating-value="{{ceil($andishehProduct->rates->avg('rate'))}}">
                    </div>
                </div>
                  </div>
                </div>
              </div>
            </div>
            <!--Product End-->
            @endforeach
          </div>
        </div>
      </div>
    </div>
</div>

        <div class="feature-area bg-paleturquoise" style="drection: rtl;">
          <div class="container">
            <div class="row">
              <div class="col-xl-4 col-lg-4 col-md-4 pt-40 pb-20">
                <div class="single-feature text-right ">
                  <div class="feature-icon">
                    <img src="{{asset('images/home/free-shipping.png')}}" alt="" />
                  </div>
                  <div class="feature-content ">
                    <h4> ارسال سریع</h4>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 col-lg-4 col-md-4 pt-40 pb-20">
                <div class="single-feature text-right ">
                  <div class="feature-icon">
                    <img src="{{asset('images/home/support.png')}}" alt="" />
                  </div>
                  <div class="feature-content">
                    <h4> تعویض و مرجوع</h4>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 col-lg-4 col-md-4 pt-40 pb-20">
                <div class="single-feature text-right">
                  <div class="feature-icon">
                    <img src="{{asset('images/home/security.png')}}" alt="" />
                  </div>
                  <div class="feature-content">
                    <h4> منحصر بفرد بودن محصول</h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
{{-- product-last --}}
<div class="product-area pb-70 mt-5">
    <div class="container">
      <div class="section-title text-center">
        <h2 > جدیدترین محصولات   </h2>
        <div class="heading-line mb-5"></div>
      </div>
      <div class="tab-content jump-2">
        <div id="product-1" class="tab-pane active">
          <div class="ht-products product-slider-active owl-carousel">
            <!--Product Start-->
            @foreach ($lasts as $product)
            <div class="ht-product ht-product-action-on-hover ht-product-category-right-bottom mb-30">
              <div class="ht-product-inner">
                <div class="ht-product-image-wrap">
                  <a href="{{ route('home.products.show' , ['product' => $product->slug])}}" class="ht-product-image">
                    <img height="400px" src="{{ asset(env('PRODUCT_IMAGES_UPLOAD_PATH') . $product->primary_image)}}" alt="Universal Product Style" />
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
                      <a href="product-details.html">{{$product->name}}</a>
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
                        data-rating-value="{{ceil($product->rates->avg('rate'))}}">
                        </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
            @endforeach
            <!--Product End-->
          </div>
        </div>
      </div>
    </div>
</div>




        <!-- Modal adabProducts -->
        @foreach ($adabProducts as $adabProduct)
         <div class="modal fade" id="productModal-{{$adabProduct->id}}" tabindex="-1" role="dialog">
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
                        <h2 class="text-right mb-4"> {{$adabProduct->name}}</h2>
                        <div class="product-details-price variation-price-{{$adabProduct->id}}">
                          @if ($adabProduct->quantity > 0)
                          <span class="new mt-3">
                              {{number_format($adabProduct->price)}}
                              تومان
                              </span>
                          @else
                          <div class="not-in-stock" >
                              <p class="text-wight">ناموجود</p>
                          </div>
                          @endif
                        </div>
                        <div class="pro-details-rating-wrap">

                            <div class="mx-3"
                            data-rating-stars="5"
                            data-rating-readonly="true"
                            data-rating-value="{{ceil($adabProduct->rates->avg('rate'))}}">
                            </div>
                            <span> | </span>
                            <span class="mx-3"> ({{ $adabProduct->approvedComments()->count()}})  دیدگاه  </span>
                        </div>
                        <p class="text-right">
                            {{$adabProduct->description}}
                        </p>

                        <form action="{{route('home.cart.add')}}" method="POST" >
                            <input type="hidden" name="product_id" value="{{$adabProduct->id}}" >
                            @csrf
                            @if ($adabProduct->quantity > 0)
                                <div class="pro-details-quality">
                                    <div class="cart-plus-minus">
                                        <input class="cart-plus-minus-box quantity-input" type="text" name="qtybutton" value="1" data-max="{{$adabProduct->quantity}}" />
                                    </div>
                                    <div class="pro-details-cart">
                                        <button type="submit">افزودن به سبد خرید</button>
                                    </div>
                                    <div class="pro-details-wishlist">
                                        @auth
                                            @if ($adabProduct->checkUserWishList(auth()->id()))
                                                <a href="{{ route('home.wishlist.remove' , ['product' => $adabProduct->id ]) }}">
                                                    <i class="fas fa-heart" style="color:red"></i>
                                                </a>
                                            @else
                                                <a href="{{ route('home.wishlist.add' , ['product' => $adabProduct->id ]) }}">
                                                    <i class="sli sli-heart"></i>
                                                </a>
                                            @endif
                                        @else
                                            <a href="{{ route('home.wishlist.add' , ['product' => $adabProduct->id ]) }}">
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

                        <div class="pro-details-meta mt-3">
                          <span>دسته بندی :</span>
                          <ul>
                            <li><a href="{{ route('home.categories.show' , ['category'=>$adabProduct->category->slug ]) }}">{{$adabProduct->category->parent->name}} , {{$adabProduct->category->name}}</a></li>
                          </ul>
                        </div>
                        <div class="pro-details-meta">
                          <span>تگ ها :</span>
                          <ul>
                            @foreach ($adabProduct->tags as $tag)
                             <li><a href="#">{{$tag->name}} {{$loop->last ? '' : ','}}</a></li>
                            @endforeach
                          </ul>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-5 col-sm-12 col-xs-12">
                      <div class="tab-content quickview-big-img">
                        <div id="pro-primary{{$adabProduct->id}}" class="tab-pane fade show active">
                          <img src="{{ asset(env('PRODUCT_IMAGES_UPLOAD_PATH') . $adabProduct->primary_image)}}" alt="" />
                        </div>
                       @foreach ($adabProduct->images as $image )
                        <div id="pro-{{$image->id}}" class="tab-pane fade">
                            <img src="{{ asset(env('PRODUCT_IMAGES_UPLOAD_PATH') . $image->image)}}" alt="" />
                        </div>
                       @endforeach
                      </div>
                      <!-- Thumbnail Large Image End -->
                      <!-- Thumbnail Image End -->
                      <div class="quickview-wrap mt-15">
                        <div class="quickview-slide-active owl-carousel nav nav-style-2" role="tablist">
                          <a class="active" data-toggle="tab" href="#pro-primary{{$adabProduct->id}}">
                            <img src="{{ asset(env('PRODUCT_IMAGES_UPLOAD_PATH') . $adabProduct->primary_image)}}" alt="" /></a>

                          @foreach ($adabProduct->images as $image )
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

        <!-- Modal adabProducts -->
        @foreach ($tarikhProducts as $tarikhProduct)
         <div class="modal fade" id="productModal-{{$tarikhProduct->id}}" tabindex="-1" role="dialog">
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
                        <h2 class="text-right mb-4"> {{$tarikhProduct->name}}</h2>
                        <div class="product-details-price variation-price-{{$tarikhProduct->id}}">
                          @if ($tarikhProduct->quantity > 0)
                          <span class="new">
                              {{number_format($tarikhProduct->price)}}
                              تومان
                              </span>
                          @else
                          <div class="not-in-stock" >
                              <p class="text-wight">ناموجود</p>
                          </div>
                          @endif
                        </div>
                        <div class="pro-details-rating-wrap">

                            <div class="mx-3"
                            data-rating-stars="5"
                            data-rating-readonly="true"
                            data-rating-value="{{ceil($tarikhProduct->rates->avg('rate'))}}">
                            </div>
                            <span> | </span>
                          <span class="mx-3"> ({{ $tarikhProduct->approvedComments()->count()}})  دیدگاه  </span>
                        </div>
                        <p class="text-right">
                            {{$tarikhProduct->description}}
                        </p>

                        <form action="{{route('home.cart.add')}}" method="POST" >
                            <input type="hidden" name="product_id" value="{{$tarikhProduct->id}}" >
                            @csrf
                            @if ($tarikhProduct->quantity > 0)
                                <div class="pro-details-quality">
                                    <div class="cart-plus-minus">
                                        <input class="cart-plus-minus-box quantity-input" type="text" name="qtybutton" value="1" data-max="{{$tarikhProduct->quantity}}" />
                                    </div>
                                    <div class="pro-details-cart">
                                        <button type="submit">افزودن به سبد خرید</button>
                                    </div>
                                    <div class="pro-details-wishlist">
                                        @auth
                                            @if ($tarikhProduct->checkUserWishList(auth()->id()))
                                                <a href="{{ route('home.wishlist.remove' , ['product' => $tarikhProduct->id ]) }}">
                                                    <i class="fas fa-heart" style="color:red"></i>
                                                </a>
                                            @else
                                                <a href="{{ route('home.wishlist.add' , ['product' => $tarikhProduct->id ]) }}">
                                                    <i class="sli sli-heart"></i>
                                                </a>
                                            @endif
                                        @else
                                            <a href="{{ route('home.wishlist.add' , ['product' => $tarikhProduct->id ]) }}">
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

                        <div class="pro-details-meta mt-3">
                          <span>دسته بندی :</span>
                          <ul>
                            <li><a href="{{ route('home.categories.show' , ['category'=>$tarikhProduct->category->slug ]) }}">{{$tarikhProduct->category->parent->name}} , {{$tarikhProduct->category->name}}</a></li>
                          </ul>
                        </div>
                        <div class="pro-details-meta">
                          <span>تگ ها :</span>
                          <ul>
                            @foreach ($tarikhProduct->tags as $tag)
                             <li><a href="#">{{$tag->name}} {{$loop->last ? '' : ','}}</a></li>
                            @endforeach
                          </ul>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-5 col-sm-12 col-xs-12">
                      <div class="tab-content quickview-big-img">
                        <div id="pro-primary{{$tarikhProduct->id}}" class="tab-pane fade show active">
                          <img src="{{ asset(env('PRODUCT_IMAGES_UPLOAD_PATH') . $tarikhProduct->primary_image)}}" alt="" />
                        </div>
                       @foreach ($tarikhProduct->images as $image )
                        <div id="pro-{{$image->id}}" class="tab-pane fade">
                            <img src="{{ asset(env('PRODUCT_IMAGES_UPLOAD_PATH') . $image->image)}}" alt="" />
                        </div>
                       @endforeach
                      </div>
                      <!-- Thumbnail Large Image End -->
                      <!-- Thumbnail Image End -->
                      <div class="quickview-wrap mt-15">
                        <div class="quickview-slide-active owl-carousel nav nav-style-2" role="tablist">
                          <a class="active" data-toggle="tab" href="#pro-primary{{$tarikhProduct->id}}">
                            <img src="{{ asset(env('PRODUCT_IMAGES_UPLOAD_PATH') . $tarikhProduct->primary_image)}}" alt="" /></a>

                          @foreach ($tarikhProduct->images as $image )
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

        <!-- Modal adabProducts -->
        @foreach ($andishehProducts as $andishehProduct)
         <div class="modal fade" id="productModal-{{$andishehProduct->id}}" tabindex="-1" role="dialog">
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
                        <h2 class="text-right mb-4"> {{$andishehProduct->name}}</h2>
                        <div class="product-details-price variation-price-{{$andishehProduct->id}}">
                          @if ($andishehProduct->quantity > 0)
                          <span class="new">
                              {{number_format($andishehProduct->price)}}
                              تومان
                              </span>
                          @else
                          <div class="not-in-stock" >
                              <p class="text-wight">ناموجود</p>
                          </div>
                          @endif
                        </div>
                        <div class="pro-details-rating-wrap">

                            <div class="mx-3"
                            data-rating-stars="5"
                            data-rating-readonly="true"
                            data-rating-value="{{ceil($andishehProduct->rates->avg('rate'))}}">
                            </div>
                            <span> | </span>
                          <span class="mx-3"> ({{ $andishehProduct->approvedComments()->count()}})  دیدگاه  </span>
                        </div>
                        <p class="text-right">
                            {{$andishehProduct->description}}
                        </p>

                        <form action="{{route('home.cart.add')}}" method="POST" >
                            <input type="hidden" name="product_id" value="{{$andishehProduct->id}}" >
                            @csrf
                            @if ($andishehProduct->quantity > 0)
                                <div class="pro-details-quality">
                                    <div class="cart-plus-minus">
                                        <input class="cart-plus-minus-box quantity-input" type="text" name="qtybutton" value="1" data-max="{{$andishehProduct->quantity}}" />
                                    </div>
                                    <div class="pro-details-cart">
                                        <button type="submit">افزودن به سبد خرید</button>
                                    </div>
                                    <div class="pro-details-wishlist">
                                        @auth
                                            @if ($andishehProduct->checkUserWishList(auth()->id()))
                                                <a href="{{ route('home.wishlist.remove' , ['product' => $andishehProduct->id ]) }}">
                                                    <i class="fas fa-heart" style="color:red"></i>
                                                </a>
                                            @else
                                                <a href="{{ route('home.wishlist.add' , ['product' => $andishehProduct->id ]) }}">
                                                    <i class="sli sli-heart"></i>
                                                </a>
                                            @endif
                                        @else
                                            <a href="{{ route('home.wishlist.add' , ['product' => $andishehProduct->id ]) }}">
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

                        <div class="pro-details-meta mt-3">
                          <span>دسته بندی :</span>
                          <ul>
                            <li><a href="{{ route('home.categories.show' , ['category'=>$andishehProduct->category->slug ]) }}">{{$andishehProduct->category->parent->name}} , {{$andishehProduct->category->name}}</a></li>
                          </ul>
                        </div>
                        <div class="pro-details-meta">
                          <span>تگ ها :</span>
                          <ul>
                            @foreach ($andishehProduct->tags as $tag)
                             <li><a href="#">{{$tag->name}} {{$loop->last ? '' : ','}}</a></li>
                            @endforeach
                          </ul>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-5 col-sm-12 col-xs-12">
                      <div class="tab-content quickview-big-img">
                        <div id="pro-primary{{$andishehProduct->id}}" class="tab-pane fade show active">
                          <img src="{{ asset(env('PRODUCT_IMAGES_UPLOAD_PATH') . $andishehProduct->primary_image)}}" alt="" />
                        </div>
                       @foreach ($andishehProduct->images as $image )
                        <div id="pro-{{$image->id}}" class="tab-pane fade">
                            <img src="{{ asset(env('PRODUCT_IMAGES_UPLOAD_PATH') . $image->image)}}" alt="" />
                        </div>
                       @endforeach
                      </div>
                      <!-- Thumbnail Large Image End -->
                      <!-- Thumbnail Image End -->
                      <div class="quickview-wrap mt-15">
                        <div class="quickview-slide-active owl-carousel nav nav-style-2" role="tablist">
                          <a class="active" data-toggle="tab" href="#pro-primary{{$andishehProduct->id}}">
                            <img src="{{ asset(env('PRODUCT_IMAGES_UPLOAD_PATH') . $andishehProduct->primary_image)}}" alt="" /></a>

                          @foreach ($andishehProduct->images as $image )
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
@endsection
