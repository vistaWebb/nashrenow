@extends('admin.layouts.admin')

@section('title')
    show comments
@endsection

@section('content')

 <!-- Content Row -->
 <div class="row">
    <div class="col-xl-12 col-md-12 mb-4 bg-white">

        <div class="mb-4">
            <h5 class="font-weight-bold mt-4">کامنت</h5>
        </div>

        <hr>

        <div class="row">

            <div class="form-group col-md-3">
                <label>نام کاربر</label>
                <input class="form-control" type="text" value="{{ $comment->user->name ==null ? $comment->user->cellphone : $comment->user->name}}" disabled >
            </div>
            <div class="form-group col-md-3">
                <label>نام محصول</label>
                <input class="form-control" type="text" value="{{ $comment->product->name }}" disabled >
            </div>
            <div class="form-group col-md-3">
                <label>وضعیت </label>
                <input class="form-control" type="text" value="{{ $comment->approved }}" disabled >
            </div>
            <div class="form-group col-md-3">
                <label>تاریخ ایجاد</label>
                <input class="form-control" type="text" value="{{ verta($comment->created_at) }}" disabled >
            </div>
            <div class="form-group col-md-12">
                <label>متن </label>
                <textarea class="form-control" disabled >{{ $comment->text}}</textarea>
            </div>

            <a href="{{ route('admin.comments.index') }}" class="btn btn-dark mt-0 mb-2 mr-3">بازگشت</a>
            @if($comment->getRawOriginal('approved'))
            <a href="{{ route('admin.comments.change_approve', ['comment'=>$comment->id]) }}" class="btn btn-danger mt-0 mb-2 mr-3">عدم تایید</a>
            @else
            <a href="{{ route('admin.comments.change_approve' , ['comment'=>$comment->id]) }}" class="btn btn-success mt-0 mb-2 mr-3">تایید</a>
            @endif
        </div>
    </div>
 </div>
@endsection
