<div class="mobile-off-canvas-active">
    <a class="mobile-aside-close">
      <i class="sli sli-close"></i>
    </a>

    <div class="header-mobile-aside-wrap">
      <div class="mobile-search">
        <form action="{{route('home.search.product')}}" class="search-form">
          <input name="search" type="text" placeholder=" ... جستجو محصولات " />
          <button class="button-search">
            <i class="sli sli-magnifier"></i>
          </button>
        </form>
      </div>

      <div class="mobile-menu-wrap">
        <!-- mobile menu start -->
        <div class="mobile-navigation">
          <!-- mobile menu navigation start -->
          <nav>
            <ul class="mobile-menu text-right">
              <li class="menu-item-has-children">
                <a href="{{route('home.index')}}"> خانه   </a>
              </li>
              <li class="menu-item-has-children">
                <a href="#">فروشگاه</a>
                    @php
                        $parentCategories = App\models\Category::Where('parent_id' , 0)->get();
                    @endphp
                <ul class="dropdown">
                    @foreach ($parentCategories as $parentCategory)
                  <li class="menu-item-has-children">
                    <a href="#">{{$parentCategory->name}}</a>
                     <ul class="dropdown">
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

              <li><a href="{{ Route('home.contact-us') }}"">تماس با ما</a></li>

              <li><a href="{{ Route('home.about-us') }}"> در باره ما</a></li>
            </ul>
          </nav>
          <!-- mobile menu navigation end -->
        </div>
        <!-- mobile menu end -->
      </div>

      <div class="mobile-curr-lang-wrap">
        <div class="single-mobile-curr-lang">
          <ul class="text-right">
            @auth
                <li class="my-3"><a href="{{route('home.users_profile.index')}}"> پروفایل </a></li>
                <li><a href="{{ route('logout') }}">خروج</a></li>

            @else
                <li class="my-3"><a href="{{ route('login') }}"> ورود </a></li>
                <li class="my-3">
                <a href="{{ route('register') }}"> ایجاد حساب </a>
                </li>
            @endauth
          </ul>
        </div>
      </div>

      <div class="mobile-social-wrap text-center">
        <a class="facebook" href="#"><i class="sli sli-social-facebook"></i></a>
        <a class="twitter" href="#"><i class="sli sli-social-twitter"></i></a>
        <a class="pinterest" href="#"><i class="sli sli-social-pinterest"></i></a>
        <a class="instagram" href="#"><i class="sli sli-social-instagram"></i></a>
        <a class="google" href="#"><i class="sli sli-social-google"></i></a>
      </div>
    </div>
  </div>
