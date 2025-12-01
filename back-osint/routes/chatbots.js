const express = require('express');
const router = express.Router();

// GET /api/chatbots/usuario/:idUsuario
router.get('/usuario/:idUsuario', async (req, res) => {
  const result = await req.db.query(
    `SELECT 'Alexa' AS plataforma, alexa_user_id AS id_plataforma FROM chatbot_alexa WHERE user_id = $1
     UNION
     SELECT 'Telegram', telegram_user_id FROM chatbot_telegram WHERE user_id = $1
     UNION
     SELECT 'WhatsApp', whatsapp_id FROM chatbot_whatsapp WHERE user_id = $1;`, [req.params.idUsuario]);
  res.json(result.rows);
});

module.exports = router;
