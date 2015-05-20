<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AjaxController extends Controller
{

  /**
   * @param $count
   * @return \Illuminate\View\View
   * @author Andrew Haswell
   */
  public function band_drop_downs($count)
  {
    return view('ajax.bands', ['count' => $count]);
  }
}
