namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

class AsignacionController extends Controller
{
    public function porCaso($idCaso)
    {
        $asignaciones = DB::select(
            "SELECT u.nombre, u.rol, a.fecha_asignacion
             FROM asignaciones_casos a
             JOIN usuarios u ON a.id_usuario = u.id_usuario
             WHERE a.id_caso = ?", [$idCaso]
        );
        return response()->json($asignaciones);
    }
}
