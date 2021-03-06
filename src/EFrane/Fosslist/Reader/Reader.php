<?php namespace EFrane\Fosslist\Reader;

/**
 * Readers define the functionality to read information from a package provider.
 * Package providers are software tools like npm, composer or bower.
 **/
interface Reader
{
  public function packagerName();
  public function read();
  public function checkAvailability();
}
