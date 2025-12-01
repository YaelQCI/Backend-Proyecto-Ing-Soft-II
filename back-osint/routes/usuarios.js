const express = require('express');
const router = express.Router();

// GET /api/usuarios
router.get('/', async (req, res) => {
  const result = await req.db.query("SELECT id_usuario, nombre, usuario, mail, rol FROM usuarios WHERE activo = true;");
  res.json(result.rows);
});

// GET /api/usuarios/:id
router.get('/:id', async (req, res) => {
  const result = await req.db.query("SELECT * FROM usuarios WHERE id_usuario = $1;", [req.params.id]);
  res.json(result.rows[0] || {});
});

module.exports = router;
