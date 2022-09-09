<?php

namespace App\Support\Storage;

use App\Support\Storage\Constract\StorageInterface;
use Countable;

 class SessionStorage implements StorageInterface ,Countable
{
    private $bucket;
    public function __construct($bucket ='default')
    {
        $this->bucket;
    }
    public function get($index){

    }
    public function set($index,$value){
        return session()->put($this->bucket.'.'.$index,$value);
    }
    public function all(){

    }
    public function exist($index){

    }
    public function unset($index){

    }
    public function clear(){

    }

     public function count()
     {
         // TODO: Implement count() method.
     }
 }
