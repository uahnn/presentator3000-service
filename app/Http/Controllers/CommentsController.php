<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Slide;
use App\Uahnn\Transformers\CommentTransformer;
use App\User;
use Illuminate\Http\Request;
use League\Flysystem\Exception;

class CommentsController extends ApiController
{
    protected $commentTransformer;

    public function __construct(CommentTransformer $commentTransformer)
    {
        $this->commentTransformer = $commentTransformer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slideId = null)
    {
        $comments = $this->getComments($slideId);

        return $this->respond($this->commentTransformer->transformCollection($comments->all()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $slideId = null)
    {
        if (!$request->input('content') or !$slideId) {
            return $this->respondBadInput('Parameter failed validation for a comment.');
        }

        $slide = Slide::findOrFail($slideId);

        $comment = $slide->comments()->create([
            'content'     =>  $request->input('content'),
        ]);

        $comment->user()->associate(User::findOrFail(1))->save();

        return $this->respondCreated($this->commentTransformer->transform($comment), 'Comment successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comment = Comment::find($id);

        if (is_null($comment)) {
            return $this->respondNotFound();
        }

        return $this->respond($this->commentTransformer->transform($comment));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!$request->input('content')) {
            return $this->respondBadInput('Parameter failed validation for a comment.');
        }

        $comment = Comment::find($id);

        $comment->content = $request->input('content');

        $comment->save();

        return $this->respondUpdated($this->commentTransformer->transform($comment), 'Comment successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $comment = Comment::find($id);
            $comment->delete();
        }catch(\Error $e) {
            return $this->respondBadInput('Comment could not be deleted.');
        }

        return $this->respondDeleted();
    }

    private function getComments($slideId)
    {
        $comments = $slideId ? Slide::findOrFail($slideId)->comments : Comment::all();

        return $comments;
    }
}
