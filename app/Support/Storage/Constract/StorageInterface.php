<?php

namespace app\Support\Storage\Constract;
interface StorageInterface{

    public function get($index);
    public function set($index,$value);
    public function all();
    public function exist($index);
    public function unset($index);
    public function clear();


}
