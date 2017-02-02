<?php

namespace App\Http\Controllers;

use App\Codebase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class CodebasesController extends Controller
{
    protected $codebaseTransformer;

    /**
     * CodebaseController constructor.
     * @param $codebaseTransformer
     */
    public function __construct(CodebaseTransformer $codebaseTransformer)
    {
        $this->codebaseTransformer = $codebaseTransformer;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $limit = Input::get('limit') ?: 15;

        $codebases = Codebase::paginate($limit);

        return $this->respondWithPagination($codebases, [
            'data' => $this->codebaseTransformer->transformCollection($codebases->all())
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
