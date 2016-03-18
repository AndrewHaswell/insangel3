<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Venue;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Monolog\Logger;

use Illuminate\Http\Request;

class UploadAdminController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    return view('admin.gig.upload');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store()
  {
    echo '<pre>';
    $gig_data = Input::all();
    $gig_data['notes'];
    $gig_data = explode("\n\r", $gig_data['notes']);
    foreach ($gig_data as $gig) {

      $gig_details = explode("\n", $gig);
      if (count($gig_details) < 3) {
        continue;
      } else {
        $gig_details = array_filter(array_map('trim', $gig_details));
      }

      $gig_extra_details = array_map('trim', explode('|', array_pop($gig_details)));

      array_pop($gig_extra_details);// Dump the phone number

      $gig_time = $this->fix_time(array_pop($gig_extra_details));
      $gig_cost = array_pop($gig_extra_details);

      $gig_cost = preg_match('/[0-9]/i', $gig_cost)
        ? '&pound;' . number_format(preg_replace('/[^0-9\.]/i', '', $gig_cost), 2) : 'FREE';
      $gig_venue = array_filter(array_map('trim', explode(',', array_pop($gig_details))));

      $venue = Venue::firstOrCreate(['venue_name' => current($gig_venue)]);
      // var_dump($venue->id);

      $gig_date = Carbon::createFromFormat('l jS F H:i:s', array_shift($gig_details) . ' ' . $gig_time);
      $gig_title = array_shift($gig_details);

      $bands = array_reverse($gig_details, true);

      $this_line = true;
      $next_line = false;

      $all_bands = [];
      $all_bands_keys = [];

      foreach ($bands as $key => $band) {

        $these_bands = array_map('trim', explode('+', $band));

        $first_band = current($these_bands);
        $last_band = end($these_bands);

        if ($this_line || empty($last_band) || $next_line) {
          $this_line = true;
        }
        if (empty($first_band)) {
          $next_line = true;
        }

        if ($this_line) {
          $all_bands[] = $these_bands;
          $all_bands_keys[] = $key;
        }
        $this_line = false;
      }

      unset($bands);

      foreach ($all_bands_keys as $key) {
        unset($gig_details[$key]);
      }

      $all_bands = array_reverse($all_bands);
      $band_list = [];

      foreach ($all_bands as $all_band) {
        $band_list = array_merge($band_list, $all_band);
      }

      $band_list = array_filter($band_list);

      var_dump($gig_details);
      echo "\n\r";
      var_dump($band_list);
      echo "\n\r";

      var_dump($gig_details);
      echo '<hr/>';
      var_dump($gig_cost);
      var_dump($gig_title);
      var_dump($gig_date);
      echo '<hr/>';

      exit();
    }
    exit;
  }

  private function fix_time($time)
  {
    $pm = strpos($time, 'pm') !== false ? true : false;
    $time = str_pad(preg_replace('/[^0-9]*/i', '', $time), 5, '0', STR_PAD_RIGHT);
    $time = $pm ? $time + 120000 : str_pad($time, 6, '0', STR_PAD_LEFT);
    return implode(':', str_split($time, 2));
  }

  /**
   * Display the specified resource.
   *
   * @param  int $id
   *
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
   *
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
   *
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
   *
   * @return Response
   */
  public function destroy($id)
  {
    //
  }
}
