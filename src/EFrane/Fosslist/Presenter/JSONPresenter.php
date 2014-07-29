<?php namespace EFrane\Fosslist\Presenter;

use EFrane\Fosslist\DependencyStore;

class JSONPresenter extends BasePresenter
{
  protected $store = null;

  public function __construct(DependencyStore $store)
  {
    $this->store = $store;
  }

  public function render()
  {
    $dependencies = $this->filter($this->store);
    return json_encode($dependencies, JSON_PRETTY_PRINT);
  }
}
