<?php namespace App\Http\Controllers;

use App\Band;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class BandController extends Controller {

  /**
   * @author Andrew Haswell
   */
  public function index(){
    $bands = Band::AllCurrentByDate()->get();
    return view('band.show', compact('bands'));
  }
}
