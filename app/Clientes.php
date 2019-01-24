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
 * @property string $apellido
 * @property string $telefono
 * @property string $email
  * @property string $usuario
*/
class Clientes extends Authenticatable
{
    use Notifiable;
    use HasRolesAndAbilities;

    protected $fillable = ['nombre', 'apellido', 'telefono','email','usuario'];
    
    
   
    
    
}
