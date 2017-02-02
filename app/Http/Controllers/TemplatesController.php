<?php

namespace App\Http\Controllers;

use App\Template;
use App\Uahnn\Transformers\TemplateTransformer;
use App\User;
use Illuminate\Http\Request;

class TemplatesController extends ApiController
{
    protected $templateTransformer;

    /**
     * TemplatesController constructor.
     * @param $templateTransformer
     */
    public function __construct(TemplateTransformer $templateTransformer)
    {
        $this->templateTransformer = $templateTransformer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $templates = Template::all();

        return $this->respond($this->templateTransformer->transformCollection($templates->all()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->input('title') or !$request->input('markup')) {
            return $this->respondBadInput('Parameter failed validation for a template.');
        }

        $user = User::find(1);

        $template = $user->templates()->create([
            'title'     =>  $request->input('title'),
            'markup'   =>  $request->input('markup')
        ]);

        return $this->respondCreated($this->templateTransformer->transform($template), 'Template successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $template = Template::find($id);

        if (is_null($template)) {
            return $this->respondNotFound();
        }

        return $this->respond($this->templateTransformer->transform($template));
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
        if (!$request->input('title') or !$request->input('markup')) {
            return $this->respondBadInput('Parameter failed validation for a template.');
        }

        $template = Template::find($id);

        if (is_null($template)) {
            return $this->respondNotFound();
        }

        $template->title = $request->input('title');
        $template->markup = $request->input('markup');

        $template->save();

        return $this->respondUpdated($this->templateTransformer->transform($template), 'Template successfully updated.');
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
            $template = Template::find($id);
            $template->delete();
        }catch(\Error $e) {
            return $this->respondBadInput('Template could not be deleted.');
        }

        return $this->respondDeleted();
    }
}
