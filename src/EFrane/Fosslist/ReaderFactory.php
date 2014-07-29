<?php namespace EFrane\Fosslist;

use Log;

class ReaderFactory
{
  public static function createWithIdentifier($identifier, DependencyStore $store)
  {
    $reader = null;
    try
    {
      $className = sprintf("EFrane\Fosslist\%sReader", ucfirst(strtolower($identifier)));
      $instance = new $className($store);
    } catch (Exception $e)
    {
      Log::warning("Tried to create invalid reader: '{$className}'");
    }

    return $instance;
  }
}
