<?php namespace EFrane\Fosslist;

use Illuminate\View\Factory;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;

class ListCommand extends Command
{
  protected $name        = 'fosslist:list';
  protected $description = 'Output the  found dependencies.';

  protected $view  = null;
  protected $store = null;

  public function __construct(Factory $view, DependencyStore $store)
  {
    $this->view  = $view;
    $this->store = $store;

    parent::__construct();
  }

  protected function fire()
  {
    $presenter = ($this->option('format') === 'text') ? new TextPresenter($this->view, $this->store) 
                                                      : new JSONPresenter($this->store);

    $this->line($presenter->render());
  }

  protected function getOptions()
  {
    return array([
      'format',
      'f',
      InputOption::VALUE_OPTIONAL,
      'Output format, can be either text or json',
      'text'
    ]);
  }
}
