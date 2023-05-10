<?php

namespace App\Http\Controllers\Admin;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Comment::latest()->paginate(5);
        return view('admin.comments.index' , compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        return view('admin.comments.show' , compact('comment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        alert()->success('با تشکر','کامنت با موفقیت حذف شد');
        return redirect()->route('admin.comments.index');
    }

    public function changeApprove(Comment $comment)
    {
        if($comment->getRawOriginal('approved')){
            $comment->update([
                'approved' => 0
            ]);
        }else{
            $comment->update([
                'approved' => 1
            ]);
        }

        alert()->success('با موفقیت انجام شد','کامنت با موفقیت ارسال شد');
        return redirect()->route('admin.comments.index');
    }
}
