@extends('admin.layouts.admin')

@section('title')
categories index
@endsection

@section('content')

<!-- Content Row -->
<div class="row">
    <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
        <div class="d-flex flex-column text-center flex-md-row justify-content-between mb-4">
            <h5 class="font-weight-bold mt-4">لیست دسته بندی ها ({{$categories->total()}})</h5>
            </div>
                <a class="btn btn-sm btn-outline-primary mt-4" href="{{ route('admin.categories.create')}}" >
                    <i class="fa fa-plus"></i>
                    ایجاد دسته بندی
                </a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>نام</th>
                        <th>نام انگلیسی</th>
                        <th>والد</th>
                        <th>وضعیت</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $key=>$category)
                        <tr>
                            <th>
                                {{ $categories->firstItem() + $key }}
                            </th>
                            <th>
                                {{ $category->name }}
                            </th>
                            <th>
                                {{ $category->slug }}
                            </th>
                            <th>
                                @if ($category->parent_id==0)
                                    بدون والد
                                @else
                                    {{$category->parent->name }}
                                @endif
                            </th>
                            <th>
                                <span class="{{$category->getRawOriginal('is_active') ? 'text-success' : 'text-danger'}}">
                                    {{ $category->is_active }}
                                </span>
                            </th>
                            <th>
                                <a class="btn btn-sm btn-outline-success" href="{{ route('admin.categories.show', ['category' => $category->id])  }}"> نمایش </a>
                                <a class="btn btn-sm btn-outline-info mr-3" href="{{ route('admin.categories.edit', ['category' => $category->id])  }}"> ویرایش </a>
                            </th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-5">
            {{$categories->render()}}
        </div>
    </div>
</div>
@endsection
