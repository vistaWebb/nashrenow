@extends('admin.layouts.admin')

@section('title')
    show products
@endsection

@section('content')

 <!-- Content Row -->
 <div class="row">
    <div class="col-xl-12 col-md-12 mb-4 bg-white">

        <div class="mb-4">
            <h5 class="font-weight-bold mt-4">محصول : {{ $product->name }}</h5>
        </div>

        <hr>

        <div class="row">

            <div class="form-group col-md-3">
                <label>نام</label>
                <input class="form-control" type="text" value="{{ $product->name }}" disabled >
            </div>

            <div class="form-group col-md-3">
                <label>نام دسته بندی</label>
                <input class="form-control" type="text" value="{{ $product->category->name }}" disabled >
            </div>

            <div class="form-group col-md-3">
                <label>وضعیت </label>
                <input class="form-control" type="text" value="{{ $product->is_active}}" disabled >
            </div>

            <div class="form-group col-md-3">
                <label>تگ ها </label>
                <div class="form-control div-disabled" >
                    @foreach ($product->tags as $tag)
                        {{ $tag->name }} {{ $loop->last ? '' : ',' }}
                    @endforeach
                </div>
            </div>

            <div class="form-group col-md-3">
                <label>تاریخ ایجاد</label>
                <input class="form-control" type="text" value="{{ verta($product->created_at) }}" disabled >
            </div>

            <div class="form-group col-md-12">
                <label>توضیحات </label>
                <textarea class="form-control" rows="3" disabled >{{$product->description}}</textarea>
            </div>
          {{-- price Section --}}
            <div class="col-md-12">
                    <div class="card card-body">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label> قیمت </label>
                                <input type="text" disabled class="form-control" value="{{ $product->price }}">
                            </div>

                            <div class="form-group col-md-3">
                                <label> تعداد </label>
                                <input type="text" disabled class="form-control" value="{{ $product->quantity }}">
                            </div>

                            <div class="form-group col-md-3">
                                <label> sku </label>
                                <input type="text" disabled class="form-control" value="{{ $product->sku }}">
                            </div>

                            {{-- Sale Section --}}
                            <div class="col-md-12">
                                <p> حراج : </p>
                            </div>

                            <div class="form-group col-md-3">
                                <label> قیمت حراجی </label>
                                <input type="text" value="{{ $product->sale_price }}" disabled
                                    class="form-control">
                            </div>

                            <div class="form-group col-md-3">
                                <label> تاریخ شروع حراجی </label>
                                <input type="text"
                                    value="{{ $product->date_on_sale_from == null ? null : verta($product->date_on_sale_from) }}"
                                    disabled class="form-control">
                            </div>

                            <div class="form-group col-md-3">
                                <label> تاریخ پایان حراجی </label>
                                <input type="text"
                                    value="{{ $product->date_on_sale_to == null ? null : verta($product->date_on_sale_to) }}"
                                    disabled class="form-control">
                            </div>
                        </div>

                </div>
            </div>

            {{-- delivery  section  --}}
            <div class="col-md-12">
                <hr>
                <p>  هزینه ارسال :</p>
            </div>

            <div class="form-group col-md-3">
                <label>هزینه ارسال </label>
                <input class="form-control" type="text" value="{{ $product->delivery_amount}}" disabled >
            </div>

            <div class="form-group col-md-3">
                <label>هزینه ارسال به ازای هر محصول اضافی </label>
                <input class="form-control" type="text" value="{{ $product->delivery_amount_per_product}}" disabled >
            </div>

            {{-- images  section  --}}
            <div class="col-md-12">
                <hr>
                <p>  تصاویر محصول   :</p>
            </div>

            <div class="col-md-3">
                <div class="card">
                    <img class="card-img-top"
                    src="{{ url(env('PRODUCT_IMAGES_UPLOAD_PATH') . $product->primary_image) }}"
                    alt="{{ $product->name }}">
                </div>
            </div>

            <div class="col-md-12">
                <hr>
            </div>

            @foreach ($images as $image)
            <div class="col-md-3">
                <div class="card">
                    <img class="card-img-top"
                     src="{{ url(env('PRODUCT_IMAGES_UPLOAD_PATH') . $image->image) }}"
                        alt="{{ $product->name }}">
                </div>
            </div>
            @endforeach



        </div>
        <a href="{{ route('admin.products.index') }}" class="btn btn-dark mt-0 mb-2 mr-3">بازگشت</a>
    </div>
 </div>
@endsection
