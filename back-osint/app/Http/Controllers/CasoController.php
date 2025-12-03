namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

class CasoController extends Controller
{
    public function index()
    {
        $casos = DB::select("SELECT * FROM casos;");
        return response()->json($casos);
    }

    public function show($id)
    {
        $caso = DB::select(
            "SELECT c.id_caso, c.nombre, c.tipo_caso, u.nombre AS creador
             FROM casos c
             JOIN usuarios u ON c.id_creador = u.id_usuario
             WHERE c.id_caso = ?", [$id]
        );
        return response()->json($caso ? $caso[0] : []);
    }
}
