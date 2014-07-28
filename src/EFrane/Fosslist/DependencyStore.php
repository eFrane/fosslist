<?php namespace EFrane\Fosslist;

use \Iterator;

class DependencyStore implements Iterator
{
  private $storeCacheFile;

  protected $dependencies = array();
  private   $iteratorKey  = 0;

  public function __construct()
  {
    $this->storeCacheFile = storage_path().'/meta/fosslist.json';

    if (file_exists($this->storeCacheFile))
    {
      $storeCache = json_decode(file_get_contents($this->storeCacheFile));
      foreach ($storeCache as $dependencyJSON)
      {
        $dependency = Dependency::fromJSON($dependencyJSON);
        $this->addDependency($dependency);
      }
    }
  }

  public function __destruct()
  {
    $cache = json_encode($this->dependencies);
    file_put_contents($this->storeCacheFile, $cache);
  }

  public function reset()
  {
    $this->dependencies = array();
  }

  public function getDependencies()
  {
    return $this->dependencies;
  }

  public function addDependency(Dependency $dependency)
  {
    if (!in_array($dependency, $this->dependencies))
      array_push($this->dependencies, $dependency);
  }

  /* Iterator Interface */
  public function  current()
  {
    return $this->dependencies[$this->iteratorKey];
  }

  public function key()
  {
    return $this->iteratorKey;
  }

  public function next()
  {
    ++$this->iteratorKey;
  }

  public function rewind()
  {
    $this->iteratorKey = 0;
  }

  public function valid()
  {
    return isset($this->dependencies[$this->iteratorKey]);
  }
}
