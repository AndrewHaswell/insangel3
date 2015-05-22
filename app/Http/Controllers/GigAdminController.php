<?php namespace App\Http\Controllers;

use App\Gig;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Band;
use App\Venue;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;

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
    $venues = Venue::all(['id',
                          'venue_name'])->keyBy('venue_name')->toArray();
    array_walk($venues, function (&$value) { $value = $value['venue_name']; });

    return view('admin.gig.create', compact('venues'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store()
  {
    $gig_data = Input::all();

    $venue = Venue::firstOrCreate(['venue_name' => $gig_data['venue']]);

    $gig = Gig::firstOrCreate(['venue_id' => $venue->id,
                               'datetime' => $gig_data['date'],]);

    $gig->title = $gig_data['title'];
    $gig->subtitle = $gig_data['subtitle'];
    $gig->cost = $gig_data['cost'];
    $gig->save();

    $bands = $gig_data['bands'];

    foreach ($bands as $band) {
      $this_band = Band::firstOrCreate(['band_name' => $band]);
      $gig->bands()->attach($this_band);
    }

    return $gig;
  }

  public function confirm()
  {
    $input = Request::all()->toArray();

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
