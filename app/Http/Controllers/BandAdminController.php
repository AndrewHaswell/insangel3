<?php namespace App\Http\Controllers;

use App\Band;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\storeBandAdminRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Request;

class BandAdminController extends Controller
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
    //
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    $title = 'Create New Band';
    return view('admin.band.create', compact('title'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param storeBandAdminRequest $request
   * @return mixed
   * @author Andrew Haswell
   */
  public function store(storeBandAdminRequest $request)
  {
    // Get the form data
    $band_data = Request::all();

    if (!empty($band_data['name']) && Request::hasFile('logo')) {
      $logo_directory = 'downloads/band_logos';
      // Remove any old band logos that may exist
      $existing = glob($logo_directory . '/' . camel_case($band_data['name'] . '*'));
      if (!empty($existing) && is_array($existing)) {
        foreach ($existing as $old_logo) {
          unlink($old_logo);
        }
      }
      $extension = Request::file('logo')->getClientOriginalExtension();
      Request::file('logo')->move('downloads/band_logos', camel_case($band_data['name'] . '.' . $extension));
      $band_data['logo'] = camel_case($band_data['name'] . '.' . $extension);
    }

    $band = Band::where('band_name', '=', trim($band_data['name']))->first();
    if (is_null($band)) {
      $band = Band::firstOrCreate(['band_name' => trim($band_data['name'])]);
      $message = 'Band Created: ' . $band_data['name'];
    } else {
      $message = 'Band Edited: ' . $band_data['name'];
    }

    if (!empty($band_data['description'])) $band->band_description = $band_data['description'];
    if (!empty($band_data['logo'])) $band->band_logo = $band_data['logo'];

    $band->save();

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