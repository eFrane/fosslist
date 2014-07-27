<?php namespace EFrane\Fosslist;

use Illuminate\Support\Facades\Cache;
use Illuminate\View\Factory;

class Fosslist
{
  protected $view;

  public function __construct(\Illuminate\View\Factory $view)
  {
    $this->view = $view;
  }

  public function getList()
  {
    $dependencies = array(['name' => 'foo', 'license' => 'MIT'], ['name' => 'bar', 'license' => '2-Clause BSD']);
    return $this->view->make('fosslist::list', compact('dependencies'))->render();
  }
}
