const express = require('express');
const router = express.Router();

// GET /api/asignaciones/caso/:idCaso
router.get('/caso/:idCaso', async (req, res) => {
  const result = await req.db.query(
    `SELECT u.nombre, u.rol, a.fecha_asignacion
     FROM asignaciones_casos a
     JOIN usuarios u ON a.id_usuario = u.id_usuario
     WHERE a.id_caso = $1;`, [req.params.idCaso]);
  res.json(result.rows);
});

module.exports = router;
