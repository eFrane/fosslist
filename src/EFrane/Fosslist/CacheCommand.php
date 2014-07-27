<?php namespace EFrane\Fosslist;

use Illuminate\Console\Command;

class CacheCommand extends Command
{
  public function fire()
  {
    $this->line('Creating FOSS dependency cache...');
  }
}
