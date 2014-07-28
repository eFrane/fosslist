<?php namespace EFrane\Fosslist;

/**
 * Readers define the functionality to read information from a package provider.
 * Package providers are software tools like npm, composer or bower.
 **/
interface Reader
{
  public function read();
  public function checkAvailability();
}
