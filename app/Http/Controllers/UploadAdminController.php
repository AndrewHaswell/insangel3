<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

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


      var_dump($gig);

      $gig_details = explode("\n", $gig);
      if (count($gig_details) < 3) {
        continue;
      } else {
        $gig_details = array_map('trim', $gig_details);
      }


      $gig_extra_details = array_map('trim', explode('|', array_pop($gig_details)));

      array_pop($gig_extra_details);// Dump the phone number

      $gig_time = $this->fix_time(array_pop($gig_extra_details));
      $gig_cost = array_pop($gig_extra_details);
      $gig_date = date('Y-m-d', strtotime(array_shift($gig_details))) . 'T' . $gig_time;

      var_dump($gig_details);
      var_dump($gig_cost);
      var_dump($gig_date);

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
