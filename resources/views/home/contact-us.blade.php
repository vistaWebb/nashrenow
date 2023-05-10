@extends('home.layouts.home')

@section('title')
    صفحه ای تماس با ما
@endsection

@section('style')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="
crossorigin=""/>
@endsection

@section('script')
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
    integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM="
    crossorigin="">
    </script>
    <script>
        var map = L.map('map').setView([36.286, 59.589], 13);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);
        var marker = L.marker([36.286, 59.589]).addTo(map);
        marker.bindPopup("<b>سلام</b><br>ما اینجاییم").openPopup();
    </script>
@endsection

@section('content')

    <div class="breadcrumb-area pt-35 pb-35 bg-gray" style="direction: rtl;">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <ul>
                    <li>
                        <a href="index.html">صفحه اصلی</a>
                    </li>
                    <li class="active">ارتباط با ما  </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="contact-area pt-100 pb-100">
        <div class="container">
            <div class="row text-right" style="direction: rtl;">
                <div class="col-lg-5 col-md-6">
                    <div class="contact-info-area">
                        <h2> انتشارات نشر نو </h2>
                        <p>در این بخش، هر کاربر مجاز است در چهارچوب شرایط و قوانین سایت، نظرات
                        خود را به اشتراک بگذارد و پس از بررسی کارشناسان تایید، نظرش را روی سایت مشاهده کند. بدیهی است که اگر قوانین سایت در نظرات کاربری رعایت نشود، تایید نمی‌شوند و در نتیجه در سایت به نمایش درنمی‌آیند. نشرنو در قبال درستی یا نادرستی نظرات منتشرشده در این قسمت، هیچ‌گونه مسئولیتی ندارد. نمایش نظرات کاربران در سایت به‌هیچ‌وجه به معنی تایید نشرنو درباره‌ٔ محتویات نظر نیست؛ لذا از کاربران محترم تقاضا می‌شود، نظرات را اصل و پایه‌ٔ انتخاب و تصمیم‌گیری خود قرار ندهند.</p>
                        <div class="contact-info-wrap">
                            <div class="single-contact-info">
                                <div class="contact-info-icon">
                                    <i class="sli sli-location-pin"></i>
                                </div>
                                <div class="contact-info-content">
                                    <p> تهران، خیابان مطهری، خیابان میرعماد، کوچهٔ سیزدهم، شمارهٔ ۱۳، کد پستی: ۱۵۸۷۷۷۷۱۱۳ </p>
                                </div>
                            </div>
                            <div class="single-contact-info">
                                <div class="contact-info-icon">
                                    <i class="sli sli-envelope"></i>
                                </div>
                                <div class="contact-info-content">
                                    <p><a href="#">INFO@NASHRENOW.COM</a></p>
                                </div>
                            </div>
                            <div class="single-contact-info">
                                <div class="contact-info-icon">
                                    <i class="sli sli-screen-smartphone"></i>
                                </div>
                                <div class="contact-info-content">
                                    <p style="direction: ltr;"> ۸۸۷۴۵۰۰۲- ۰۲۱
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-6">
                    <div class="contact-from contact-shadow">
                        <form id="contact-form" action="{{ route('home.contact-us.form') }}" method="post">
                            @csrf
                            <input name="name" type="text" placeholder="نام شما" value="{{ old('name') }}">
                            @error('name')
                                <p class="input-error-validation">
                                    <strong>{{ $message }}</strong>
                                </p>
                            @enderror
                            <input name="email" type="email" placeholder="ایمیل شما" value="{{ old('email') }}">
                            @error('email')
                                <p class="input-error-validation">
                                    <strong>{{ $message }}</strong>
                                </p>
                            @enderror
                            <input name="subject" type="text" placeholder="موضوع پیام" value="{{ old('subject') }}">
                            @error('subject')
                                <p class="input-error-validation">
                                    <strong>{{ $message }}</strong>
                                </p>
                            @enderror
                            <textarea name="text" placeholder="متن پیام">{{ old('text') }}</textarea>
                            @error('text')
                                <p class="input-error-validation">
                                    <strong>{{ $message }}</strong>
                                </p>
                            @enderror

                            <div id="contact_us_id"></div>

                            <button class="submit" type="submit"> ارسال پیام </button>
                        </form>
                    </div>
                </div>
            </div>
            <div width="400px" height="800px" class="contact-map pt-100">
                <div width="400px" height="800px" id="map"></div>
            </div>
        </div>
    </div>
@endsection
