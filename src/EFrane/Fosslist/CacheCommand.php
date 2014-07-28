<?php namespace EFrane\Fosslist;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;

class CacheCommand extends Command
{
  protected $store = null;

  protected $name        = 'fosslist:cache';
  protected $description = 'Create the FOSS dependency cache';

  public function __construct(DependencyStore $store)
  {
    $this->store = $store;
    parent::__construct();
  }

  public function fire()
  {
    $this->line('Creating FOSS dependency cache...');

    if ($this->option('reset'))
      $this->store->reset();

    $reader = new ComposerReader($this->store);
    $reader->read();

    $this->line('Done.');
  }

  public function getOptions()
  {
    return array([
      'reset',
      '',
      InputOption::VALUE_NONE,
      'Reset the cache before reading the package lists.'
    ]);
  }
}
