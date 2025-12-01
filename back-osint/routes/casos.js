const express = require('express');
const router = express.Router();

// GET /api/casos
router.get('/', async (req, res) => {
  const result = await req.db.query("SELECT * FROM casos;");
  res.json(result.rows);
});

// GET /api/casos/:id
router.get('/:id', async (req, res) => {
  const result = await req.db.query(
    `SELECT c.id_caso, c.nombre, c.tipo_caso, u.nombre AS creador
     FROM casos c
     JOIN usuarios u ON c.id_creador = u.id_usuario
     WHERE c.id_caso = $1;`, [req.params.id]);
  res.json(result.rows[0] || {});
});

module.exports = router;
