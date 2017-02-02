<?php

namespace App\Http\Controllers;


use App\Presentation;
use App\Slide;
use App\Uahnn\Transformers\SlideTransformer;
use Illuminate\Http\Request;


class SlidesController extends ApiController
{
    protected $slideTransformer;

    public function __construct(SlideTransformer $slideTransformer)
    {
        //$this->middleware('auth.basic')->only('post');
        $this->slideTransformer = $slideTransformer;
    }


    public function index($presentationId = null)
    {
        $slides = $this->getSlides($presentationId);

        return $this->respond($this->slideTransformer->transformCollection($slides->all()));
    }

    public function show($id)
    {
        $slide = Slide::find($id);

        if (is_null($slide)) {
            return $this->respondNotFound();
        }

        return $this->respond($this->slideTransformer->transform($slide));
    }

    public function store(Request $request, $presentationId = null)
    {
        if (!$request->input('content')) {
            return $this->respondBadInput('Parameter failed validation for a slide.');
        }

        $slide = Slide::create($request->all());

        if($presentationId) {
            $presentation = Presentation::findOrFail($presentationId);

            $prev_slide = $presentation->slides()->where('slide_next', null)->first();

            $presentation->slides()->updateExistingPivot($prev_slide->id, [
                'slide_next'    =>  $slide->id
            ]);

            $presentation->slides()->attach($slide->id, [
                'slide_prev'    =>  $prev_slide->id,
                'slide_next'    =>  null
            ]);
        }

        return $this->respondCreated($this->slideTransformer->transform($slide), 'Slide successfully created.');
    }

    public function update(Request $request, $id)
    {
        if (!$request->input('content') or is_null($request->input('shared'))) {
            return $this->respondBadInput('Parameter failed validation for a slide.');
        }

        $slide = Slide::find($id);

        if (is_null($slide)) {
            return $this->respondNotFound();
        }

        $slide['content'] = $request->input('content');
        $slide['shared'] = $request->input('shared');

        $slide->save();

        return $this->respondUpdated($this->slideTransformer->transform($slide), 'Slide successfully updated.');
    }

    public function destroy($id)
    {
        try {
            $slide = Slide::find($id);
            $slide->delete();
        } catch (\Error $e) {
            return $this->respondBadInput('Slide could not be deleted.');
        }

        return $this->respondDeleted();
    }

    private function getSlides($presentationId)
    {
        $slides = $presentationId ? Presentation::findOrFail($presentationId)->slides : Slide::all();

        return $slides;
    }

}
