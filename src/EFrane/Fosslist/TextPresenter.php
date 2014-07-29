<?php namespace EFrane\Fosslist;

use Illuminate\View\Factory;

class TextPresenter extends BasePresenter
{
  protected $store = null;
  protected $view  = null;

  public function __construct(Factory $view, DependencyStore $store)
  {
    $this->view  = $view;
    $this->store = $store;
  }

  public function render()
  {
    $dependencies = $this->filter($this->store);
    return $this->view->make('fosslist::textlist', compact('dependencies'))->render();
  }
}
