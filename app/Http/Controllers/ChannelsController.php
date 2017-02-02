<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Uahnn\Transformers\ChannelTransformer;
use App\User;
use Illuminate\Http\Request;

class ChannelsController extends ApiController
{
    protected $channelTransformer;

    /**
     * ChannelController constructor.
     * @param $channelTransformer
     */
    public function __construct(ChannelTransformer $channelTransformer)
    {
        $this->channelTransformer = $channelTransformer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $channels = Channel::all();

        return $this->respond($this->channelTransformer->transformCollection($channels->all()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->input('title') or !$request->input('description')) {
            return $this->respondBadInput('Parameter failed validation for a channel.');
        }

        $user = User::find(1);

        $channel = $user->channels()->create([
            'title' => $request->input('title'),
            'description' => $request->input('description')
        ]);

        return $this->respondCreated($this->channelTransformer->transform($channel), 'Channel successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $channel = Channel::find($id);

        if (is_null($channel)) {
            return $this->respondNotFound();
        }

        return $this->respond($this->channelTransformer->transform($channel));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if (!$request->input('title') or !$request->input('markup')) {
            return $this->respondBadInput('Parameter failed validation for a template.');
        }

        $channel = Channel::find($id);

        if (is_null($channel)) {
            return $this->respondNotFound();
        }

        $channel->title = $request->input('title');
        $channel->description = $request->input('markup');

        $channel->save();

        return $this->respondUpdated($this->channelTransformer->transform($channel), 'Channel successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $channel = Channel::find($id);
            $channel->delete();
        } catch (\Error $e) {
            return $this->respondBadInput('Channel could not be deleted.');
        }

        return $this->respondDeleted();
    }

    /**
     * Add the specified presentation to the specified channel.
     *
     * @param int $channelId
     * @param int $presentationId
     */
    public function add($cid, $pid)
    {
        $channel = Channel::find($cid);

        $channel->presentations()->attach($pid, [
            'presentation_prev' => null,
            'presentation_next' => null
        ]);

        return $this->respondCreated($this->channelTransformer->transform($channel));
    }
}
