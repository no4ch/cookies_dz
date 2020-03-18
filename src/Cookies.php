<?php

  namespace Academy;

  class Cookies
  {
    public function addValue($name, $value, $expire = 0, $path = "", $domain = "", $secure = false) {
      setcookie($name, $value, $expire, $path, $domain, $secure);
    }

    public function deleteValue($name) {
      setcookie($name, "", - 1);
    }

    public function editValue($name, $value) {
      setcookie($name, $value);
    }
  }