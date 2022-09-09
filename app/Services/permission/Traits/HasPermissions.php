<?php
namespace App\Services\permission\traits;
use App\Permission;
trait HasPermissions
{


  public function permission()
  {
     return $this->belongsToMany(Permission::class);

  }


  public function givePermissionTo( ... $permission)
  {
    $permission=$this->getAllPermisstions($permission);
    dd($permission);
  }
  protected function getAllPermisstions(array $permission)
  {
      return Permission::whereIn('name',$permission)->get();

  }

 }


