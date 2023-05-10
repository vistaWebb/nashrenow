<header class="header-area sticky-bar" dir="rtl">
  <div class="main-header-wrap">
    <div class="container">
      <div class="row">
        <div class="col-xl-2 col-lg-2">
          <div class="logo pt-4">
            <img src="{{asset('images/home/طراحی لوگو انتشارات_d4bf845a3a19.jpg')}}" width="50px" alt="...">
            <a href="{{route('home.index')}}" class="navbar-brand">نشر نو</a>
          </div>
        </div>

        <div class="col-xl-7 col-lg-7">
          <div class="main-menu text-center">
            <nav>
              <ul>
                <li class="angle-shape">
                  <a href="{{route('home.index')}}"> خانه </a>
                </li>

                <li class="angle-shape">
                    <a href="#"> فروشگاه </a>
                    @php
                        $parentCategories = App\models\Category::Where('parent_id' , 0)->get();
                    @endphp
                    <ul class="mega-menu">
                        @foreach ($parentCategories as $parentCategory)
                        <li>
                            <a class="menu-title" href="#">{{$parentCategory->name}}</a>
                            <ul>
                                @php
                                    $childCaregories = App\models\Category::Where('parent_id' , $parentCategory->id)->get();
                                @endphp
                                @foreach ($childCaregories as $childCategory)
                                    <li><a href="{{ route('home.categories.show' , ['category'=>$childCategory->slug ]) }}">{{ $childCategory->name }}</a></li>
                                @endforeach
                            </ul>
                          </li>
                        @endforeach
                    </ul>
                </li>

                <li class="angle-shape">
                  <a href="{{ Route('home.contact-us') }}"> تماس با ما   </a>
                </li>

                <li class="angle-shape">
                    <a href="{{ Route('home.about-us') }}"> درباره با ما   </a>
                </li>

              </ul>
            </nav>
          </div>
        </div>

        <div class="col-xl-3 col-lg-3">
          <div class="header-right-wrap pt-40">
            <div class="header-search">
              <a class="search-active" href="#"><i class="sli sli-magnifier"></i></a>
            </div>
            <div class="cart-wrap">
              <button class="icon-cart-active">
                <span class="icon-cart">
                  <i class="sli sli-bag"></i>
                  @if (! \Cart::isEmpty())
                  <span class="count-style">{{ \Cart::getContent()->count()}}</span>
                  @endif
                </span>
                @if (! \Cart::isEmpty())
                <span class="cart-price">
                  {{number_format(\Cart::getTotal())}}
                </span>
                <span class="mx-2"> تومان </span>
                @endif
              </button>
              @if (\Cart::isEmpty())
                <div class="shopping-cart-content">
                    <div class="shopping-cart-top">
                      <a class="cart-close" href="#"><i class="sli sli-close"></i></a>
                      <h4>سبد خرید</h4>

                    </div>
                    <p style="direction: rtl"> سبد خرید شما خالی می باشد.</p>
                    <div class="shopping-cart-bottom">
                      <div class="shopping-cart-btn btn-hover text-center">
                        <a class="default-btn" href="{{ route('home.index')}}">
                        فروشگاه
                        </a>
                      </div>
                    </div>
                  </div>
                @else
                <div class="shopping-cart-content">
                  <div class="shopping-cart-top">
                    <a class="cart-close" href="#"><i class="sli sli-close"></i></a>
                    <h4>سبد خرید</h4>
                  </div>
                  <ul>
                    @foreach (\Cart::getContent() as $item)
                    <li class="single-shopping-cart d-flex ">
                      <div class="shopping-cart-title">
                        <h4><a href="#">  {{ $item->name}} </a></h4>
                        <span>{{ $item->quantity}}  {{ number_format($item->price)}}x</span>
                      </div>
                      <div class="shopping-cart-img mr-auto">
                        <a href="{{route('home.products.show' , ['product' => $item->associatedModel->slug])}}">
                            <img alt="" src="{{asset(env('PRODUCT_IMAGES_UPLOAD_PATH') . $item->associatedModel->primary_image)}}" />
                        </a>

                        <div class="item-close">
                            <a href="{{route('home.cart.remove' , ['rowId'=>$item->id])}}"><i class="sli sli-close"></i></a>
                        </div>
                       </div>
                    </li>
                    @endforeach
                  </ul>
                  <div class="shopping-cart-bottom">
                    <div class="shopping-cart-total d-flex justify-content-between align-items-center"
                      style="direction: rtl;">
                      <h4>
                        جمع کل :
                      </h4>
                      <span class="shop-total">
                        {{number_format(\Cart::getTotal())}} تومان
                      </span>
                    </div>
                    <div class="shopping-cart-btn btn-hover text-center">
                      <a class="default-btn" href="{{route('home.orders.checkout')}}">
                        ثبت سفارش
                      </a>
                      <a class="default-btn" href="{{route('home.cart.index')}}">
                        سبد خرید
                      </a>
                    </div>
                  </div>
                </div>
                @endif
            </div>

            <div class="setting-wrap">
              <button class="setting-active">
                <i class="sli sli-settings"></i>
              </button>
              <div class="setting-content">
                <ul class="text-right">
                    @auth
                        <li><a href="{{route('home.users_profile.index')}}">پروفایل</a></li>
                        <li><a href="{{ route('logout') }}">خروج</a></li>
                    @else
                        <li><a href="{{ route('login') }}">ورود</a></li>
                        <li>
                            <a href="{{ route('register') }}">ایجاد حساب</a>
                        </li>
                    @endauth
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- main-search start -->
    <div class="main-search-active">
      <div class="sidebar-search-icon">
        <button class="search-close">
          <span class="sli sli-close"></span>
        </button>
      </div>
      <div class="sidebar-search-input">
        <form action="{{route('home.search.product')}}">
          <div class="form-search">
            <input id="search" name="search" class="input-text" value="" placeholder=" جستجوی محصول... " type="search" />
            <button>
              <i class="sli sli-magnifier"></i>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="header-small-mobile">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-6">
          <div class="mobile-logo">
            <a href="index.html">
              <h4 class="font-weight-bold">نشر نو</h4>
            </a>
          </div>
        </div>
        <div class="col-6">
          <div class="header-right-wrap">
            <div class="cart-wrap">
              <button class="icon-cart-active">
                <span class="icon-cart">
                  <i class="sli sli-bag"></i>
                  @if (! \Cart::isEmpty())
                  <span class="count-style">{{ \Cart::getContent()->count()}}</span>
                  @endif
                </span>
                @if (! \Cart::isEmpty())
                <span class="cart-price">
                  {{number_format(\Cart::getTotal())}}
                </span>
                <span class="mx-2"> تومان </span>
                @endif
              </button>
              @if (\Cart::isEmpty())
                <div class="shopping-cart-content">
                    <div class="shopping-cart-top">
                      <a class="cart-close" href="#"><i class="sli sli-close"></i></a>
                      <h4>سبد خرید</h4>

                    </div>
                    <p style="direction: rtl"> سبد خرید شما خالی می باشد.</p>
                    <div class="shopping-cart-bottom">
                      <div class="shopping-cart-btn btn-hover text-center">
                        <a class="default-btn" href="{{ route('home.index')}}">
                        فروشگاه
                        </a>
                      </div>
                    </div>
                  </div>
                @else
                <div class="shopping-cart-content">
                  <div class="shopping-cart-top">
                    <a class="cart-close" href="#"><i class="sli sli-close"></i></a>
                    <h4>سبد خرید</h4>
                  </div>
                  <ul>
                    @foreach (\Cart::getContent() as $item)
                    <li class="single-shopping-cart d-flex">
                      <div class="shopping-cart-title">
                        <h4><a href="#">  {{ $item->name}} </a></h4>
                        <span>{{ $item->quantity}} x {{ number_format($item->price)}}</span>
                      </div>

                      <div class="shopping-cart-img mr-auto">
                        <a href="{{route('home.products.show' , ['product' => $item->associatedModel->slug])}}">
                            <img alt="" src="{{asset(env('PRODUCT_IMAGES_UPLOAD_PATH') . $item->associatedModel->primary_image)}}" />
                        </a>
                        <div class="item-close">
                            <a href="{{route('home.cart.remove' , ['rowId'=>$item->id])}}"><i class="sli sli-close"></i></a>                        </div>
                      </div>
                    </li>
                    @endforeach
                  </ul>
                  <div class="shopping-cart-bottom">
                    <div class="shopping-cart-total d-flex justify-content-between align-items-center"
                      style="direction: rtl;">
                      <h4>
                        جمع کل :
                      </h4>
                      <span class="shop-total">
                        {{number_format(\Cart::getTotal())}} تومان
                      </span>
                    </div>
                    <div class="shopping-cart-btn btn-hover text-center">
                      <a class="default-btn" href="{{route('home.orders.checkout')}}">
                        ثبت سفارش
                      </a>
                      <a class="default-btn" href="{{route('home.cart.index')}}">
                        سبد خرید
                      </a>
                    </div>
                  </div>
                </div>
                @endif
            </div>
            <div class="mobile-off-canvas">
              <a class="mobile-aside-button" href="#"><i class="sli sli-menu"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>

