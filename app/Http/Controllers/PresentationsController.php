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
        $presentation = Presentation::find($id);

        if(is_null($presentation)) {
            return $this->respondNotFound();
        }

        return $this->respond($this->presentationTransformer->transform($presentation));
    }


    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        if (!$request->input('title') or !$request->input('description')) {
            return $this->respondBadInput('Parameter failed validation for a presentation.');
        }


        $presi = Presentation::find($id);

        if(is_null($presi)) {
            return $this->respondNotFound();
        }

        $presi['title'] = $request->input('title');
        $presi['description'] = $request->input('description');

        $presi->save();

        return $this->respondUpdated($this->presentationTransformer->transform($presi), 'Presentation successfully updated.');
    }


    public function destroy($id)
    {
        try {
            $presi = Presentation::find($id);
            $presi->delete();
        }catch(\Error $e) {
            return $this->respondBadInput('Presentation could not be deleted.');
        }

        return $this->respondDeleted();
    }
}
