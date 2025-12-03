namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

class HerramientaController extends Controller
{
    public function index()
    {
        $herramientas = DB::select("SELECT * FROM herramientas;");
        return response()->json($herramientas);
    }

    public function porCategoria($id)
    {
        $herramientas = DB::select(
            "SELECT h.nombre AS herramienta, c.nombre AS categoria
             FROM rel_herramientas_categorias r
             JOIN herramientas h ON r.id_herramienta = h.id_herramienta
             JOIN categorias_herramientas c ON r.id_categoria = c.id_categoria
             WHERE c.id_categoria = ?", [$id]
        );
        return response()->json($herramientas);
    }
}
