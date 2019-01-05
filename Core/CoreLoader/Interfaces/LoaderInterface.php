<?php
namespace App\Core\CoreLoader\Interfaces;

interface LoaderInterface{
    public function __construct();

    public function load();
}