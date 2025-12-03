namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

class ChatbotController extends Controller
{
    public function porUsuario($idUsuario)
    {
        $chatbots = DB::select(
            "SELECT 'Alexa' AS plataforma, alexa_user_id AS id_plataforma FROM chatbot_alexa WHERE user_id = ?
             UNION
             SELECT 'Telegram', telegram_user_id FROM chatbot_telegram WHERE user_id = ?
             UNION
             SELECT 'WhatsApp', whatsapp_id FROM chatbot_whatsapp WHERE user_id = ?", 
             [$idUsuario, $idUsuario, $idUsuario]
        );
        return response()->json($chatbots);
    }
}
