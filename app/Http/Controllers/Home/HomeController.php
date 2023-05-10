<?php

namespace App\Http\Controllers\Home;

use App\Models\Product;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Facades\SEOTools;

class HomeController extends Controller
{
    public function index()
    {

        SEOTools::setTitle('nashrenow.ir');
        SEOTools::setDescription('نشر نو فعالیت خود را با انتشار رمان‌های ایران و جهان، کتاب‌های فلسفی، سیاسی، تاریخی و پژوهشی آغاز کرد');
        SEOTools::opengraph()->setUrl(route('home.about-us'));
        SEOTools::opengraph()->addProperty('type', 'store');
        SEOTools::jsonLd()->addImage('https://codecasts.com.br/img/logo.jpg');

        $adabProducts = Product::where('category_id' , 14)->get()->take(5);
        $tarikhProducts = Product::where('category_id' , 27)->get()->take(5);
        $andishehProducts = Product::where('category_id' , 19)->get()->take(5);

        $lasts = Product::orderBy('created_at', 'desc')->get();


        return view('home.index' , compact('adabProducts' , 'tarikhProducts' , 'andishehProducts' , 'lasts'));
    }

    public function aboutUs()
    {
        SEOTools::setTitle('nashrenow.ir');
        SEOTools::setDescription(' نشر نو فعالیت خود را با انتشار رمان‌های ایران و جهان، کتاب‌های فلسفی، سیاسی، تاریخی و پژوهشی آغاز کرد');
        SEOTools::opengraph()->setUrl(route('home.about-us'));
        SEOTools::opengraph()->addProperty('type', 'store');
        SEOTools::jsonLd()->addImage('https://codecasts.com.br/img/logo.jpg');

        return view('home.about-us');
    }

    public function contactUs()
    {
        SEOTools::setTitle('nashrenow.ir');
        SEOTools::setDescription('نشر نو فعالیت خود را با انتشار رمان‌های ایران و جهان، کتاب‌های فلسفی، سیاسی، تاریخی و پژوهشی آغاز کرد');
        SEOTools::opengraph()->setUrl(route('home.contact-us'));
        SEOTools::opengraph()->addProperty('type', 'store');
        SEOTools::jsonLd()->addImage('https://codecasts.com.br/img/logo.jpg');

        return view('home.contact-us');
    }

    public function contactUsForm(Request $request)
    {
        $request->validate([
            'name'=>'required|string|min:4|max:40',
            'email'=>'required|email',
            'subject'=>'required|string|min:4|max:100',
            'text'=>'required|string|min:4|max:4000',
        ]);


        ContactUs::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'subject'=>$request->subject,
            'text'=>$request->text,
        ]);

        alert()->success('با موفقیت انجام شد','کامنت با موفقیت ارسال شد');
        return redirect()->back();

    }

    public function searchProduct(Request $request)
    {
        $keyword = $request->search;
        $products = Product::where('name' , 'LIKE' , '%'.$keyword.'%')->paginate(3);

        return view('home.search.show' , compact('products'));
    }

}
