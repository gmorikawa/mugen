<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase;

    // protected $base_route = null;
    // protected $base_model = null;

    // protected function setBaseRoute($route)
    // {
    //     $this->base_route = $route;
    // }

    // protected function setBaseModel($model)
    // {
    //     $this->base_model = $model;
    // }
}
