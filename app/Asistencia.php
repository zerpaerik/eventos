<?php
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Silber\Bouncer\Database\HasRolesAndAbilities;
use Hash;

/**
 * Class Asistencia
 *
 * @package App
 * @property string $id_evento
 * @property string $id_cliente
  * @property string $usuario


  * @property string $usuario

*/
class Asistencia extends Authenticatable
{
    use Notifiable;
    use HasRolesAndAbilities;

    protected $fillable = ['id_evento', 'id_cliente','usuario'];
    
    
   
    
    
}
