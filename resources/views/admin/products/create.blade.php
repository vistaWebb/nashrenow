@extends('admin.layouts.admin')

@section('title')
    create products
@endsection

@section('script')
    <script>

        // $('#tagSelect').selectpicker({
        //     'title': 'انتخاب تگ'
        // });
          // Show File Name
          $('#primary_image').change(function() {
            //get the file name
            var fileName = $(this).val();
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        });
        $('#images ').change(function() {
            //get the file name
            var fileName = $(this).val();
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        });

        $("#czContainer").czMore();
    </script>
@endsection

@section('content')

 <!-- Content Row -->
 <div class="row">
    <div class="col-xl-12 col-md-12 mb-4 bg-white">
        <div class="mb-4">
            <h5 class="font-weight-bold mt-4">ایجاد محصول</h5>
        </div>
        <hr>
        @include('admin.sections.errors')
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

            <div class="form-row mb-3">
                <div class="form-group col-md-3">
                    <label for="name">نام</label>
                    <input class="form-control" id="name" name="name" type="text" value="{{ old('name')}}">
                </div>

                <div class="form-group col-md-3 ">
                    <label for="is_active" class="form-label">وضعیت</label>
                    <select class="form-control" id="is_active" name="is_active">
                        <option value="1" selected>فعال</option>
                        <option value="0" >غیر فعال</option>
                    </select>
                </div>

                <div class="form-group col-md-3 ">
                    <label for="tag_id" class="form-label">تگ </label>
                    <select id="tagSelect" class="form-control" name="tag_id"
                    data-live-search="true">
                    @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach
                    </select>
                </div>



                <div class="form-group col-md-3 ">
                    <label for="category_id" class="form-label">دسته بندی</label>
                    <select id="categorySelect" class="form-control" name="category_id"
                    data-live-search="true">
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name}}-{{ $category->parent->name}}</option>
                    @endforeach
                    </select>
                </div>

                <div class="form-group col-md-12">
                    <label for="description">توضیحات</label>
                    <textarea class="form-control" id="description" name="description">{{ old('description')}}</textarea>
                </div>

                {{-- product image section  --}}
                <div class="col-md-12">
                    <hr>
                    <p>تصاویر محصول :</p>
                </div>

                <div class="form-group col-md-6">
                    <label for="primary_image"> انتخاب تصویر اصلی </label>
                    <div class="custom-file">
                        <input type="file" name="primary_image" class="custom-file-input" id="primary_image">
                        <label class="custom-file-label" for="primary_image"> انتخاب فایل </label>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <label for="images"> انتخاب تصاویر  </label>
                    <div class="custom-file">
                        <input type="file" name="images[]" class="custom-file-input" id="images" multiple>
                        <label class="custom-file-label" for="images"> انتخاب فایل </label>
                    </div>
                </div>

                         {{-- product image section  --}}
                         <div class="col-md-12">
                            <hr>
                            <p>قیمت محصول :</p>
                        </div>

                        <div class="form-group col-md-3">
                            <label>قیمت</label>
                            <input class="form-control" name="price" type="text">
                        </div>
                        <div class="form-group col-md-3">
                            <label>تعداد</label>
                            <input class="form-control" name="quantity" type="text">
                        </div>
                        <div class="form-group col-md-3">
                            <label>شناسه انبار</label>
                            <input class="form-control" name="sku" type="text">
                        </div>

                          {{-- Sale Section --}}
                          <div class="col-md-12">
                            <p> حراج : </p>
                        </div>

                        <div class="form-group col-md-3">
                            <label> قیمت حراجی </label>
                            <input type="text" name="sale_price" class="form-control">
                        </div>

                        <div class="form-group col-md-3">
                            <label> تاریخ شروع حراجی </label>
                            <input type="date" name="date_on_sale_from" class="form-control">
                        </div>

                        <div class="form-group col-md-3">
                            <label> تاریخ پایان حراجی </label>
                            <input type="date" name="date_on_sale_to" class="form-control">
                        </div>


                 {{-- delivery  section  --}}
                 <div class="col-md-12">
                    <hr>
                    <p>  هزینه ارسال :</p>
                </div>

                <div class="form-group col-md-3">
                    <label for="delivery_amount">هزینه ارسال</label>
                    <input class="form-control" id="delivery_amount" name="delivery_amount" type="text" value="{{ old('delivery_amount')}}">
                </div>

                <div class="form-group col-md-3">
                    <label for="delivery_amount_per_product">هزینه ارسال به ازای محصول اضافی</label>
                    <input class="form-control" id="delivery_amount_per_product" name="delivery_amount_per_product" type="text" value="{{ old('delivery_amount_per_product')}}">
                </div>

            </div>
            <button class="btn btn-outline-primary mt-0 mb-2 mr-3" type="submit">ثبت</button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-dark mt-0 mb-2 mr-3">بازگشت</a>
        </form>
    </div>
 </div>
@endsection
