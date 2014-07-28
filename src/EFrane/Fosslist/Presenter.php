<?php namespace EFrane\Fosslist;

use Illuminate\View\Factory;

interface Presenter
{
  public function filter(DependencyStore $store);
  public function render();
}
