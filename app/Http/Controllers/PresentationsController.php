<?php

namespace App\Http\Controllers;

use App\Presentation;
use App\Uahnn\Transformers\PresentationTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class PresentationsController extends ApiController
{

    protected $presentationTransformer;

    /**
     * PresentationsController constructor.
     * @param $presentationTransformer
     */
    public function __construct(PresentationTransformer $presentationTransformer)
    {
        $this->presentationTransformer = $presentationTransformer;
    }


    public function index()
    {

        $limit = Input::get('limit') ?: 15;

        $presentations = Presentation::paginate($limit);

        return $this->respondWithPagination($presentations, [
            'data' => $this->presentationTransformer->transformCollection($presentations->all())
        ]);
    }


    public function create()
    {

    }


    public function store(Request $request)
    {
        if (!$request->input('title') or !$request->input('description')) {
            return $this->respondBadInput('Parameter failed validation for a slide.');
        }

        Presentation::create([
            'user_id'   =>  1,                          //TODO set to current user
            'title'     =>  $request->input('title'),
            'description'   =>  $request->input('description')
        ]);

        return $this->respondCreated('Slide successfully created.');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
