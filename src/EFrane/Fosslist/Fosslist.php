<?php namespace EFrane\Fosslist;

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
    $presenter = new HTMLPresenter($this->view, $this->store);
    return $presenter->render();   
  }
}
