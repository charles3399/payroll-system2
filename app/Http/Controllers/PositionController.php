<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;
use App\Http\Requests\PositionRequest;
use App\Http\Resources\PositionResource;

use App\Http\Services\PositionServices;

class PositionController extends Controller
{
    protected $positionServices;

    public function __construct(PositionServices $positionServices)
    {
        $this->positionServices = $positionServices;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = $request->searchPosition;

        $positions = $this->positionServices->search_position($query);

        return PositionResource::collection($positions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PositionRequest $request)
    {
        $position = Position::create($request->validated());

        return new PositionResource($position);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function show(Position $position)
    {
        return new PositionResource($position);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function update(PositionRequest $request, Position $position)
    {
        $position->update($request->validated());

        return new PositionResource($position);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function destroy(Position $position)
    {
        $position->delete();

        return response()->noContent();
    }

    public function showPositions()
    {
        $positions = Position::all();

        return PositionResource::collection($positions);
    }
}
