namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = DB::select("SELECT id_usuario, nombre, usuario, mail, rol FROM usuarios WHERE activo = true;");
        return response()->json($usuarios);
    }

    public function show($id)
    {
        $usuario = DB::select("SELECT * FROM usuarios WHERE id_usuario = ?", [$id]);
        return response()->json($usuario ? $usuario[0] : []);
    }
}
