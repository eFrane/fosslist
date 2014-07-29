<?php namespace EFrane\Fosslist\Commands;

use Config;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;

use EFrane\Fosslist\DependencyStore;
use EFrane\Fosslist\Reader\Factory as ReaderFactory;

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

    $readers = (count($this->option('readers')) > 0) ? explode(',', $this->option('readers'))
                                                     : Config::get('fosslist::readers');

    foreach ($readers as $readerIdentifier)
    {
      $reader = ReaderFactory::createWithIdentifier($readerIdentifier, $this->store);
      $this->line('Running for '.$reader->packagerName());
      $reader->read();
    }

    $this->info('Done.');
  }

  public function getOptions()
  {
    return array([
      'reset',
      '',
      InputOption::VALUE_NONE,
      'Reset the cache before reading the package lists.'
    ], [
      'readers',
      'r',
      InputOption::VALUE_OPTIONAL,
      'Overwrite the list of used package readers.',
      []
    ]);
  }
}
