<?php namespace EFrane\Fosslist;

use Illuminate\Support\Facades\Cache;
use Illuminate\View\Factory;

class Fosslist
{
  protected $view;
  protected $store;

  public function __construct(\Illuminate\View\Factory $view, DependencyStore $store)
  {
    $this->view  = $view;
    $this->store = $store;
  }

  public function getList()
  {
    return $this->view->make('fosslist::list', ['dependencies' => $this->store])->render();
  }
}
