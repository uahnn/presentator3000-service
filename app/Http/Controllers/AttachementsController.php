<?php

namespace App\Http\Controllers;

use App\Attachement;
use App\Presentation;
use App\Uahnn\Transformers\attachementTransformer;
use App\User;
use Illuminate\Http\Request;

class AttachementsController extends ApiController
{
    protected $attachementTransformer;

    public function __construct(AttachementTransformer $attachementTransformer)
    {
        $this->attachementTransformer = $attachementTransformer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($presentationId = null)
    {
        $attachements = $this->getAttachements($presentationId);

        return $this->respond($this->attachementTransformer->transformCollection($attachements->all()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $presentationId = null)
    {
        if (!$request->input('filename') or !$presentationId) {
            return $this->respondBadInput('Parameter failed validation for an attachement.');
        }

        $presentation = Presentation::findOrFail($presentationId);

        $attachement = $presentation->Attachements()->create([
            'filename'     =>  $request->input('filename'),
        ]);

        $attachement->user()->associate(User::findOrFail(1))->save();

        return $this->respondCreated($this->attachementTransformer->transform($attachement), 'Attachement successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $attachement = Attachement::find($id);

        if (is_null($attachement)) {
            return $this->respondNotFound();
        }

        return $this->respond($this->attachementTransformer->transform($attachement));
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
        if (!$request->input('filename')) {
            return $this->respondBadInput('Parameter failed validation for an attachement.');
        }

        $attachement = Attachement::find($id);

        $attachement->filename = $request->input('filename');

        $attachement->save();

        return $this->respondUpdated($this->attachementTransformer->transform($attachement), 'Attachement successfully updated.');
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
            $attachement = Attachement::find($id);
            $attachement->delete();
        }catch(\Error $e) {
            return $this->respondBadInput('Attachement could not be deleted.');
        }

        return $this->respondDeleted();
    }

    private function getAttachements($presentationId)
    {
        $attachements = $presentationId ? Presentation::findOrFail($presentationId)->Attachements : Attachement::all();

        return $attachements;
    }
}
