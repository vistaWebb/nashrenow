@extends('home.layouts.home')

@section('title')
    about-us
@endsection

@section('content')

<div class="breadcrumb-area pt-35 pb-35 bg-gray" style="direction: rtl;">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <ul>
                <li>
                    <a href="{{route('home.index')}}">صفحه اصلی</a>
                </li>
                <li class="active"> درباره ما </li>

            </ul>
        </div>
    </div>
</div>

<div class="about-story-area pt-100 pb-100" style="direction: rtl;">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="story-img">
                    <a href="#"><img src="{{asset('images/home/images (2).jpg')}}" alt=""></a>
                </div>
            </div>
            <div class="col-lg-6 text-right">
                <div class="story-details pl-50">
                    <div class="story-details-top">
                        <h2>درباره  <span> نشر نو</span> بدانید</h2>
                        <p>محمدرضا جعفری، مترجم و ویراستار، نشر نو را در سال
                             ۱۳۶۰ تأسیس کرد. نشر نو فعالیت خود را با انتشار رمان‌های ایران و جهان،
                            کتاب‌های فلسفی، سیاسی، تاریخی و پژوهشی آغاز کرد و نویسندگان پرشماری
                             را در میان همکاران خود داشت. آثاری همچون «یک بستر و دو رؤیا»، «جا
                            ی خالی سلوچ»، «دن کیشوت»، «چشمان بازمانده در گور»، «مرشد و مارگریتا» از
                            کتاب‌های این دورهٔ این انتشارات است. پس از یک دورهٔ فترت ناخواسته، در دههٔ
                             هفتاد نیز کتاب‌هایی از نشر نو منتشر شد که توجه خوانندگان بسیاری را به
                            خود جلب کرد. کتاب‌هایی همچون «فرهنگ فشردهٔ نشرنو»، «ژاک قضا و قدری و اربابش
                            »، «وضعیت آخر»، «ماندن در وضعیت آخر»، «زمستان ۶۲»، «تاریخ زبان فارسی
                            »، «فرهنگ ادبیات فارسی»، «موج سوم» و «شوک آینده» از کتاب‌های این دورهٔ
                             نشر نو است. این انتشارات پس از سال‌ها فترت ناخواستهٔ دیگر، در دههٔ ۹۰
                            فعالیت خود را از سر گرفت و با انتشار کتاب در زمینه‌های گوناگون و
                            بعضاً کمتر شناخته‌شده مخاطبان بسیاری را با فعالیت‌های نوین خود آشنا
                             کرد. کتاب‌هایی همچون «انسان خردمند»، «انسان خداگونه، ازجمله فعالیت‌های
                             این دورهٔ نشر نو است. .</p>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

<div class="feature-area" style="drection: rtl;">
    <div class="container">
      <div class="row">
        <div class="col-xl-4 col-lg-4 col-md-4">
          <div class="single-feature text-right mb-40">
            <div class="feature-icon">
              <img src="{{asset('images/home/free-shipping.png')}}" alt="" />
            </div>
            <div class="feature-content">
              <h4> ارسال سریع</h4>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4">
          <div class="single-feature text-right mb-40">
            <div class="feature-icon">
              <img src="{{asset('images/home/support.png')}}" alt="" />
            </div>
            <div class="feature-content">
              <h4> تعویض و مرجوع</h4>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4">
          <div class="single-feature text-right mb-40">
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

<div class="testimonial-area pt-80 pb-95 section-margin-1" style="background-image: url({{asset('images/home/bg-1.jpg')}});">
    <div class="container">
        <div class="row">
          <div class="col-lg-10 ml-auto mr-auto">
            <div class="testimonial-active owl-carousel nav-style-1">
                <div class="single-testimonial text-center">
                    <img src="{{asset('images/home/testi-1.png')}}" alt="" />
                    <p>چطور میتوانم سفارشم را تحویل بگیرم ؟</p>
                    <p>اکسپرس اگر شما در یکی از شهرهای تهران ، کرج ، اصفهان، تبریز، کرمانشاه، قم، یزد، قزوین، زنجان، اردبیل، گرگان، ارومیه، اراک، خرم آباد، مشهد، اهواز، شیراز، کرمان، بندرعباس، زاهدان، گیلان، مازندران، همدان هستید ، سفارش شما با اکسپرس تحویل شما میشود.

                        پست پیشتاز:  در صورتی که آدرس شما در محدوده اکسپرس نیست ، سفارش شما با پست پیشتاز تحویل شما میشود. </p>
                    <div class="client-info">
                      <img src="{{asset('images/home/testi.png')}}" alt="" />
                      <h5> سوالات کاربران</h5>
                    </div>
                </div>
                <div class="single-testimonial text-center">
                    <img src="{{asset('images/home/testi-2.png')}}" alt="" />
                    <p>اگر کالایی که دریافت کرده ام با آنچه در سایت دیده ام مغایرت داشت باید چه کار کنم؟</p>
                    <p>در صورت مشاهده هر گونه مغایرت، لطفا مراتب را به خدمات پس از فروش اطلاع دهید.

                        شما برای این کار می توانید از راه های ارتباطی که در صفحه تماس با ما ذکر شده است استفاده نمایید.

                        همچنین می توانید با مراجعه به قسمت سفارش های تحویل شده در حساب کاربری خود، درخواست بازگشت کالای خود را ثبت نمایید.</p>
                    <div class="client-info">
                      <img src="{{asset('images/home/testi.png')}}" alt="" />
                      <h5> سوالات کاربران </h5>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
</div>

{{-- <div class="banner-area pt-100 pb-65">
    <div class="container">
        <div class="row">
            @foreach ($bottomBanners as $banner)
            <div class="col-lg-6 col-md-6 text-right">
                <div class="single-banner mb-30 scroll-zoom">
                <img src="{{ asset(env('BANNER_IMAGES_UPLOAD_PATH') . $banner->image)}}" alt="{{ $banner->image}}" alt="" />
                <div class="{{$loop->last ? 'banner-content banner-position-4' : 'banner-content banner-position-3'}}">
                    <h3>{{$banner->title}} </h3>
                    <h2>{{$banner->text}} </h2>
                    <a href="{{$banner->button_link}}">{{$banner->button_text}}</a>
                </div>
                </div>
            </div>
            @endforeach
        </div>
      </div>
</div> --}}

@endsection
