namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

class ActividadController extends Controller
{
    public function porCaso($idCaso)
    {
        $actividades = DB::select(
            "SELECT actividad, fecha FROM actividades_caso WHERE id_caso = ?", [$idCaso]
        );
        return response()->json($actividades);
    }
}
