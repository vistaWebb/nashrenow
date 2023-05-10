@extends('admin.layouts.admin')

@section('title')
    edit categories
@endsection
{{--

@section('script')
    <script>
         $('#attributeSelect').selectpicker({
            'title': 'انتخاب ویژگی'
        });

        $('#attributeSelect').on('changed.bs.select', function() {
            let attributesSelected = $(this).val();
            let attributes = @json($attributes);

            let attributeForFilter = [];

            attributes.map((attribute) => {
                $.each(attributesSelected , function(i,element){
                    if( attribute.id == element ){
                        attributeForFilter.push(attribute);
                    }
                });
            });

            $("#attributeIsFilterSelect").find("option").remove();
            $("#variationSelect").find("option").remove();
            attributeForFilter.forEach((element)=>{
                let attributeFilterOption = $("<option/>" , {
                    value : element.id,
                    text : element.name
                });

                let variationOption = $("<option/>" , {
                    value : element.id,
                    text : element.name
                });

                $("#attributeIsFilterSelect").append(attributeFilterOption);
                $("#attributeIsFilterSelect").selectpicker('refresh');

                $("#variationSelect").append(variationOption);
                $("#variationSelect").selectpicker('refresh');
            });


        });

        $("#attributeIsFilterSelect").selectpicker({
            'title': 'انتخاب ویژگی'
        });

        $("#variationSelect").selectpicker({
            'title': 'انتخاب متغیر'
        });

    </script>
@endsection --}}

@section('content')

 <!-- Content Row -->
 <div class="row">
    <div class="col-xl-12 col-md-12 mb-4  p-md-5 bg-white">
        <div class="mb-4">
            <h5 class="font-weight-bold">  ویرایش دسته بندی  {{  $category->name }}</h5>
        </div>
        <hr>
        @include('admin.sections.errors')
        <form action="{{ route('admin.categories.update' , ['category'=>$category->id]) }}" method="POST" >
        @csrf
        @method('put')
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="name" class="form-label">نام</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $category->name}}">
                </div>

                <div class="form-group col-md-3">
                    <label for="slug" class="form-label">نام انگلیسی</label>
                    <input type="text" class="form-control" id="slug" name="slug" value="{{ $category->slug}}">
                </div>

                <div class="form-group col-md-3">
                    <label for="parent_id" class="form-label">والد </label>
                    <select class="form-control" id="parent_id" name="parent_id" type="text">
                    <option value="0">بدون والد</option>

                    @foreach ($parentCategories as $parentCategory)
                    <option value=" {{ $parentCategory->id }}"
                        {{ $category->parent_id ==$parentCategory->id ? 'selected' : ''}}
                        >
                        {{ $parentCategory->name }}</option>

                    @endforeach
                    </select>
                </div>

                <div class="form-group col-md-3 ">
                    <label for="is_active" class="form-label">وضعیت</label>
                    <select class="form-control" id="is_active" name="is_active">
                        <option value="1" {{ $category->getRawOriginal('is_active') ? 'selected' : ''}}>فعال</option>
                        <option value="0" {{ $category->getRawOriginal('is_active') ? '' : 'selected'}}>غیر فعال</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="icon">آیکون</label>
                    <input class="form-control" id="icon" name="icon" type="text" value="{{ $category->icon}}">
                </div>
            </div>
            <button class="btn btn-outline-primary mt-5" type="submit">ویرایش</button>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-dark mt-5 mr-3">بازگشت</a>
        </form>
    </div>
 </div>
@endsection
