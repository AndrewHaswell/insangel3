<?php namespace App\Http\Controllers;

use App\Gig;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Band;
use App\Http\Requests\storeGigAdminRequest;
use App\Venue;

use Illuminate\Support\Facades\Input;

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
   * Save the results of the gig form
   *
   * @param storeGigAdminRequest $request
   * @return static
   *
   * @author Andrew Haswell
   */

  public function store(storeGigAdminRequest $request)
  {
    // Get the form data
    $gig_data = Input::all();

    // Get or create the venue for the gig
    $venue = Venue::firstOrCreate(['venue_name' => $gig_data['venue']]);

    // Get or create the gig based on the venue and the time
    $gig = Gig::firstOrCreate(['venue_id' => $venue->id,
                               'datetime' => $gig_data['date'],]);

    // Update the rest of the gig info
    $gig->title = $gig_data['title'];
    $gig->subtitle = $gig_data['subtitle'];
    $gig->cost = $gig_data['cost'];
    $gig->notes = $gig_data['notes'];
    $gig->save();

    // Remove any attached bands from the gig
    $gig->bands()->detach();

    // Update the band info
    foreach ($gig_data['bands'] as $band) {

      // Get or create the band
      $this_band = Band::firstOrCreate(['band_name' => ($band ? : 'TBC')]);
      // Assign the band to the gig
      $gig->bands()->save($this_band);
    }

    return $gig;
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
