<?php
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Silber\Bouncer\Database\HasRolesAndAbilities;
use Hash;

/**
 * Class Centrosmedicos
 *
 * @package App
 * @property string $nombre
 * @property string $descripcion
 * @property string $responsable
 * @property string $capacidad
  * @property string $usuario
    * @property string $fecha

*/
class Eventos extends Authenticatable
{
    use Notifiable;
    use HasRolesAndAbilities;

    protected $fillable = ['nombre', 'descripcion', 'responsable','capacidad','fecha','usuario'];
    
    
   
    
    
}
