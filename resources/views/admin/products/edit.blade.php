@extends('admin.layouts.admin')

@section('title')
    edit products
@endsection

@section('content')

 <!-- Content Row -->
 <div class="row">
    <div class="col-xl-12 col-md-12 mb-4 bg-white">
        <div class="mb-4">
            <h5 class="font-weight-bold mt-4">ویرایش محصول {{ $product->name }} </h5>
        </div>
        <hr>
        @include('admin.sections.errors')
        <form action="{{ route('admin.products.update' , ['product' => $product->id ])}}" method="POST" >
        @csrf
        @method('put')

        <div class="form-row mb-0">

            <div class="form-group col-md-3">
                <label for="name">نام</label>
                <input class="form-control" id="name" name="name" type="text" value="{{ $product->name }}">
            </div>

            <div class="form-group col-md-3 ">
                <label for="is_active" class="form-label">وضعیت</label>
                <select class="form-control" id="is_active" name="is_active">
                    <option value="1" {{ $product->getRawOriginal('is_active') ? 'selected' : ''}}>فعال</option>
                    <option value="0" {{ $product->getRawOriginal('is_active') ? '' : 'selected'}}>غیر فعال</option>
                </select>
            </div>

            <div class="form-group col-md-5 ">
                <label for="category_id" class="form-label">دسته بندی</label>
                <select id="categorySelect" class="form-control" name="category_id"
                    data-live-search="true">
                    @foreach ($categories as $category)
                <option value="{{ $category->id }}"  {{$category->id == $product->category->id ? 'selected' : ''}}>{{ $category->name }} - {{ $category->parent->name }}</option>
                    @endforeach
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name}}-{{ $category->parent->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-12">
                <label for="description">توضیحات</label>
                <textarea class="form-control" id="description" name="description">{{ $product->description}}</textarea>
            </div>

            {{-- delivery  section  --}}
            <div class="col-md-12">
                <hr>
                <p>  هزینه ارسال :</p>
            </div>

            <div class="form-group col-md-3">
                <label for="delivery_amount">هزینه ارسال</label>
                <input class="form-control" id="delivery_amount" name="delivery_amount" type="text" value="{{ $product->delivery_amount}}">
            </div>

            <div class="form-group col-md-3">
                <label for="delivery_amount_per_product">هزینه ارسال به ازای محصول اضافی</label>
                <input class="form-control" id="delivery_amount_per_product" name="delivery_amount_per_product" type="text" value="{{ $product->delivery_amount_per_product}}">
            </div>


            <div class="col-md-12">
                    <div class="card card-body">
                        <div class="row">
                        {{-- price  section  --}}
                        <div class="col-md-12">
                            <p>  قیمت محصول :</p>
                            <hr>
                        </div>

                        <div class="form-group col-md-3">
                            <label> قیمت </label>
                            <input type="text" class="form-control" name="price" value="{{ $product->price }}">
                        </div>

                        <div class="form-group col-md-3">
                            <label> تعداد </label>
                            <input type="text" class="form-control" name="quantity" value="{{ $product->quantity }}">
                        </div>

                        <div class="form-group col-md-3">
                            <label> sku </label>
                            <input type="text" class="form-control" name="sku" value="{{ $product->sku }}">
                        </div>

                        {{-- Sale Section --}}
                        <div class="col-md-12">
                            <p> حراج محصول : </p>
                            <hr>
                        </div>

                        <div class="form-group col-md-3">
                            <label> قیمت حراجی </label>
                            <input type="text" name="sale_price" value="{{ $product->sale_price }}"
                                class="form-control">
                        </div>

                        <div class="form-group col-md-3">
                            <label> تاریخ شروع حراجی </label>
                            <input type="date" name="date_on_sale_from"
                                value="{{ $product->date_on_sale_from == null ? null : verta($product->date_on_sale_from) }}"
                                class="form-control">
                        </div>

                        <div class="form-group col-md-3">
                            <label> تاریخ پایان حراجی </label>
                            <input type="date" name="date_on_sale_to"
                                value="{{ $product->date_on_sale_to == null ? null : verta($product->date_on_sale_to) }}"
                                class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <button class="btn btn-outline-primary my-4 mr-3" type="submit">ویرایش</button>
        <a href="{{ route('admin.products.index') }}" class="btn btn-dark my-4 mr-3">بازگشت</a>
        </form>
    </div>
 </div>
@endsection
