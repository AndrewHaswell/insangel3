<?php namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;

class InsangelComposer
{
  /**
   * Bind data to the view.
   *
   * @param  View $view
   * @return void
   */
  public function compose(View $view)
  {

    $navigation = ['One'  => '1',
                   'Two'  => '2',
                   'List' => ['Three' => '3',
                              'Four'  => '4']];

    $view->with('navigation', $navigation);
  }
}