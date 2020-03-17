<?php

function kp_get_route($name)
{
  $prefix = '/online-registration/';
  $routes = [
    "/" => ""
  ];
  if (array_key_exists($name, $routes)) {
    return $prefix . $routes[$name];
  } else {
    return $prefix . $name;
  }
}

