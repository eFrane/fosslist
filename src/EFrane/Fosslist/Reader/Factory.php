<?php namespace EFrane\Fosslist\Reader;

use Log;

use EFrane\Fosslist\DependencyStore;

class Factory
{
  public static function createWithIdentifier($identifier, DependencyStore $store)
  {
    $reader = null;
    try
    {
      $className = sprintf("EFrane\Fosslist\Reader\%sReader", ucfirst(strtolower($identifier)));
      $instance = new $className($store);
    } catch (Exception $e)
    {
      Log::warning("Tried to create invalid reader: '{$className}'");
    }

    return $instance;
  }
}
