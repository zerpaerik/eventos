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
 * @property string $id_evento
 * @property string $id_cliente
 * @property string $monto
 * @property string $tipo_pago
  * @property string $usuario

*/
class Pagos extends Authenticatable
{
    use Notifiable;
    use HasRolesAndAbilities;

    protected $fillable = ['id_evento', 'id_cliente', 'monto','tipo_pago','usuario'];
    
    
   
    
    
}
