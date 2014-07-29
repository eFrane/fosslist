<?php namespace EFrane\Fosslist\Reader;

use \RecursiveDirectoryIterator;
use \RecursiveIteratorIterator;

use \Config;

use EFrane\Fosslist\DependencyStore;
use EFrane\Fosslist\Dependency;

class ComposerReader implements Reader
{
  protected $rootPath   = '';
  protected $vendorPath = '';

  protected $store = null;

  public function __construct(DependencyStore $store)
  {
    $this->store = $store;
  }

  public function packagerName()
  {
    return "Composer";
  }

  public function read()
  {
    $this->rootPath   = base_path();
    $this->vendorPath = base_path().'/vendor';

    $this->getDependencies();
  }

  public function checkAvailability()
  {
    // this is a composer package, at least one composer.json is by definition always available
    // but let's just be sure
    return file_exists(base_path().'/composer.json');
  }

  protected function getDependencies()
  {
    if (Config::get('fosslist::includeSelf')) $this->addDependency($this->rootPath.'/composer.json');

    $di = new RecursiveDirectoryIterator($this->vendorPath);
    $it = new RecursiveIteratorIterator($di);

    foreach ($it as $name => $object)
    {
      if (strpos($name, 'composer.json') > 0)
      {
        $this->addDependency($name);
      }
    }
  }

  protected function addDependency($composerJSON)
  {
    $json = json_decode(file_get_contents($composerJSON));
    
    
    $name        = $json->name;
    $version     = (isset($json->version)) ? $json->version : 'unknown';
    $license     = (isset($json->license)) ? $json->license : 'unknown';
    $description = (isset($json->description)) ? $json->description : null;

    // composer seems to add brackets if multiple licenses are set, that might cause problems
    $license = str_replace(['(', ')'], '', $license);

    $dep = new Dependency($name, $version, $license, $description);
    $this->store->addDependency($dep);
  }
}
