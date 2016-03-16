<?php namespace App\Http\Controllers;

use App\Gig;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Band;
use App\Http\Requests\storeGigAdminRequest;
use App\Venue;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Request;

class GigAdminController extends Controller
{

  public function __construct()
  {
    $authorised = Auth::check();
    if (!$authorised) {
      abort(403, 'Unauthorized action.');
    }
  }

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $gigs = Gig::AllByDate()->get();
    $delete = true;
    return view('admin.gig.show', compact('gigs', 'delete'));
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

  public function upload_gig(){
    return view('admin.band.upload');
  }

  public function upload(uploadGigAdminRequest $request)
  {
    // Get the form data
    $gig_data = Input::all();
    var_dump($gig_data);
    exit();
  }

  /**
   * Save the results of the gig form
   *
   * @param storeGigAdminRequest $request
   * @return static
   * @author Andrew Haswell
   */

  public function store(storeGigAdminRequest $request)
  {
    // Get the form data
    $gig_data = Input::all();

    // Get or create the venue for the gig
    $venue = Venue::firstOrCreate(['venue_name' => $gig_data['venue']]);

    if (!empty($gig_data['gig_id'])) {
      $gig = Gig::findOrFail($gig_data['gig_id']);
      $gig->venue_id = $venue->id;
      $gig->datetime = $gig_data['date'];
      $message = 'Gig updated';
    }

    if (!isset($gig)) {
      // Get or create the gig based on the venue and the time
      $gig = Gig::firstOrCreate(['venue_id' => $venue->id,
                                 'datetime' => $gig_data['date'],]);
      $message = 'Gig created';
    }

    // Update the rest of the gig info
    $gig->title = $gig_data['title'];
    $gig->subtitle = $gig_data['subtitle'];
    $gig->cost = $gig_data['cost'];
    $gig->notes = $gig_data['notes'];
    $gig->cover = (!empty($gig_data['cover']) ? 'Y' : 'N');
    $gig->save();

    // Remove any attached bands from the gig
    $gig->bands()->detach();

    // Update the band info
    foreach ($gig_data['bands'] as $band) {

      // Get or create the band
      $this_band = Band::firstOrCreate(['band_name' => ($band ?: 'TBC')]);
      // Assign the band to the gig
      $gig->bands()->save($this_band);
    }

    return Redirect::action('GigAdminController@index')->with('message', $message);
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
    $venues = Venue::all(['id',
                          'venue_name'])->keyBy('venue_name')->toArray();
    array_walk($venues, function (&$value) { $value = $value['venue_name']; });
    $gigs = Gig::AllByDate()->findOrfail($id);
    $submit = $title = 'Edit Gig';

    return view('admin.gig.create', compact('venues', 'gigs', 'submit', 'title'));
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
    $gig = Gig::find($id);
    $message = 'Gig deleted';
    $gig->delete();

    return Redirect::action('GigAdminController@index')->with('message', $message);
  }

  public function gig_list()
  {

    $gig_download = [];

    $gigs = Gig::AllCurrentByDate()->get();

    if (!empty($gigs)) {
      foreach ($gigs as $gig) {
        $this_gig = [];
        $this_gig[] = date('l jS F', strtotime($gig['datetime']));

        if (!empty($gig['title'])) {
          $this_gig[] = $gig['title'];
        }

        if (!empty($gig['subtitle'])) {
          $this_gig[] = $gig['subtitle'];
        }

        $band_list = array_chunk($gig->bands->lists('band_name'), 3);

        $first_row = true;

        foreach ($band_list as $bands) {
          $this_gig[] = ($first_row ? '' : '+ ') . implode(' + ', $bands);
          $first_row = false;
        }

        $venue = $gig->venue['venue_name'];

        if (!empty($gig->venue['venue_address'])) {
          $venue .= ', ' . $gig->venue['venue_address'];
        }

        if (!empty($gig['notes'])) {
          $this_gig[] = $gig['notes'];
        }

        $this_gig[] = trim($venue);

        $details = [];

        $details[] = is_numeric($gig['cost']) ? '£' . number_format($gig['cost'], 2) : $gig['cost'];
        $details[] = date('g.ia', strtotime($gig['datetime']));
        $details[] = '07901 616 185'; //TODO Un-hardcode this

        $this_gig[] = implode(' | ', $details);

        $gig_download[] = implode("\n\r\n\r", $this_gig);
      }
    }

    $cover_gigs = Venue::AllCoverVenues()->get();

    if (count($cover_gigs) > 0) {
      $gig_download[] = str_pad('-', 40, '-') . "\n\r\n\r" . 'COVER GIGS AND VENUES' . "\n\r\n\r" . str_pad('-', 40, '-');

      foreach ($cover_gigs as $cover_gig) {
        if (count($cover_gig->gigs) > 0) {
          $this_cover_gig = [];

          $venue = $cover_gig['venue_name'];

          if (!empty($cover_gig['venue_address'])) {
            $venue .= ', ' . $cover_gig['venue_address'];
          }

          $this_cover_gig[] = $venue;

          foreach ($cover_gig->gigs as $gig) {
            $bands = implode(' + ', $gig->bands->lists('band_name'));
            $this_cover_gig[] = date('j M', strtotime($gig['datetime'])) . ' - ' . $bands;
          }

          $this_cover_gig[] = "\n\r" . str_pad('-', 40, '-');
          $gig_download[] = implode("\n\r\n\r", $this_cover_gig);
        }
      }
    }

    return Response::make(implode("\n\r\n\r\n\r", $gig_download), '200', array('Content-Type'        => 'application/octet-stream',
                                                                               'Content-Disposition' => 'attachment; filename="gig_list.txt'));
  }
}
