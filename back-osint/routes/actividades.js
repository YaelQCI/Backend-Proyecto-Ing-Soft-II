const express = require('express');
const router = express.Router();

// GET /api/actividades/caso/:idCaso
router.get('/caso/:idCaso', async (req, res) => {
  const result = await req.db.query(
    "SELECT actividad, fecha FROM actividades_caso WHERE id_caso = $1;", [req.params.idCaso]);
  res.json(result.rows);
});

module.exports = router;
