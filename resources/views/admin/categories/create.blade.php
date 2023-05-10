@extends('admin.layouts.admin')

@section('title')
    create categories
@endsection

@section('content')

 <!-- Content Row -->
 <div class="row">
    <div class="col-xl-12 col-md-12 mb-4  p-md-5 bg-white">
        <div class="mb-4">
            <h5 class="font-weight-bold">ایجاد دسته بندی</h5>
        </div>
        <hr>
        @include('admin.sections.errors')
        <form action="{{ route('admin.categories.store') }}" method="POST" >
        @csrf

            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="name" class="form-label">نام</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name')}}">
                </div>

                <div class="form-group col-md-3">
                    <label for="slug" class="form-label">نام انگلیسی</label>
                    <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug')}}">
                </div>

                <div class="form-group col-md-3">
                    <label for="parent_id" class="form-label">والد </label>
                    <select class="form-control" id="parent_id" name="parent_id" type="text">
                    <option value="0">بدون والد</option>

                    @foreach ($parentCategories as $parentCategory)
                    <option value=" {{ $parentCategory->id }}"> {{ $parentCategory->name }}</option>

                    @endforeach
                    </select>
                </div>

                <div class="form-group col-md-3 ">
                    <label for="is_active" class="form-label">وضعیت</label>
                    <select class="form-control" id="is_active" name="is_active">
                        <option value="1" selected>فعال</option>
                        <option value="0" >غیر فعال</option>
                    </select>
                </div>

                <div class="form-group col-md-3">
                    <label for="icon">آیکون</label>
                    <input class="form-control" id="icon" name="icon" type="text" value="{{ old('icon')}}">
                </div>
            </div>
            <button class="btn btn-outline-primary mt-5" type="submit">ثبت</button>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-dark mt-5 mr-3">بازگشت</a>
        </form>
    </div>
 </div>
@endsection
