<?php namespace App\Http\Controllers;

use App\Gig;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Band;

use App\Venue;
use Request;

class GigAdminController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    //
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    $bands = Band::all()->toArray();
    $venues = Venue::all(['id', 'venue_name'])->keyBy('id');

    dd($venues);

    return $venues;

    return view('admin.gig.create', compact('bands', 'venues'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store()
  {

    $data = Request::all();

    return $data;
  }

  public function confirm()
  {
    $input = Request::all();

    return $input;
  }

  /**
   * Display the specified resource.
   *
   * @param  int $id
   * @return Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int $id
   * @return Response
   */
  public function edit($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int $id
   * @return Response
   */
  public function update($id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int $id
   * @return Response
   */
  public function destroy($id)
  {
    //
  }
}
