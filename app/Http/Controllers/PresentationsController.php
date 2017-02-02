<?php

namespace App\Http\Controllers;

use App\Presentation;
use App\Uahnn\Transformers\PresentationTransformer;
use App\User;
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
            return $this->respondBadInput('Parameter failed validation for a presentation.');
        }

        $user = User::find(1);

        $presi = $user->presentations()->create([
            'title'     =>  $request->input('title'),
            'description'   =>  $request->input('description')
        ]);

        return $this->respondCreated($this->presentationTransformer->transform($presi), 'Presentation successfully created.');
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
