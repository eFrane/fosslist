<?php namespace EFrane\Fosslist;

use \JSONSerializable;

class Dependency implements JSONSerializable
{
  public $name        = '';
  public $version     = '';
  public $license     = '';
  public $description = '';

  public function __construct($name, $version, $license, $description)
  {
    $this->name        = $name;
    $this->version     = $version;
    $this->license     = $license;
    $this->description = $description;
  }

  public static function create($name, $version, $filename, $description)
  {
    return new Dependency($name, $version, $filename, $description);
  }

  public static function fromJSON($serialized)
  {
    return new Dependency($serialized->name, 
                          $serialized->version, 
                          $serialized->license, 
                          $serialized->description);
  }

  public function jsonSerialize()
  {
    return array(
      'name'        => $this->name,
      'version'     => $this->version,
      'license'     => $this->license,
      'description' => $this->description
    );
  }
}
