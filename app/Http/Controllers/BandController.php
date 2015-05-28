<?php namespace App\Http\Controllers;

use App\Band;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class BandController extends Controller
{

  /**
   * @author Andrew Haswell
   */
  public function index()
  {
    $bands = Band::AllCurrentByDate()->get();

    return $bands;

    $bands = $bands->toArray();

    foreach ($bands as $band) {
      if (count($band['gigs']) > 1) {
        usort($band['gigs'], function ($a, $b) {
          return strtotime($a['datetime']) - strtotime($b['datetime']);
        });
      }
    }

    return view('band.show', compact('bands'));
  }
}
