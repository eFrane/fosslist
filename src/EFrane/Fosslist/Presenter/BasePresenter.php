<?php namespace EFrane\Fosslist\Presenter;

use EFrane\Fosslist\DependencyStore;

abstract class BasePresenter
{
  public function filter(DependencyStore $store)
  {
    $dependencies = array();
    
    // filter based on display config
    $displayConfig = \Config::get('fosslist::display');

    foreach ($this->store as $dependency)
    {
      if ($dependency->license === 'unknown' && !$displayConfig['showUnknownLicense']) continue;
      if ($dependency->version === 'unknown' && !$displayConfig['showUnknownVersion']) continue;

      array_push($dependencies, $dependency);
    }

    return $dependencies;
  }
}
