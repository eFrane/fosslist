<?php namespace EFrane\Fosslist;

use Illuminate\View\Factory;

class HTMLPresenter extends BasePresenter
{
  protected $view  = null;
  protected $store = null;

  public function __construct(Factory $view, DependencyStore $store)
  {
    $this->view  = $view;
    $this->store = $store;
  }

  public function render()
  {
    $dependencies = $this->filter($this->store);

    return $this->view->make('fosslist::list', compact('dependencies'))->render();
  }
}
