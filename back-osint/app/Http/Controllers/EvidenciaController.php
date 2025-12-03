namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

class EvidenciaController extends Controller
{
    public function porCaso($idCaso)
    {
        $evidencias = DB::select(
            "SELECT tipo, descripcion, fecha_creacion FROM evidencias WHERE id_caso = ?", [$idCaso]
        );
        return response()->json($evidencias);
    }
}
