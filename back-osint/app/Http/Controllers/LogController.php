namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

class LogController extends Controller
{
    public function porUsuario($idUsuario)
    {
        $logs = DB::select(
            "SELECT tipo_accion, descripcion, fecha_hora FROM log_actividad WHERE id_usuario = ?", [$idUsuario]
        );
        return response()->json($logs);
    }

    public function porCaso($idCaso)
    {
        $logs = DB::select(
            "SELECT tipo_accion, descripcion, fecha_hora FROM log_actividad WHERE caso_id_relacionado = ?", [$idCaso]
        );
        return response()->json($logs);
    }
}
