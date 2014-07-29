<?php namespace EFrane\Fosslist\Presenter;

use Illuminate\View\Factory;

use EFrane\Fosslist\DependencyStore;

interface Presenter
{
  public function filter(DependencyStore $store);
  public function render();
}
