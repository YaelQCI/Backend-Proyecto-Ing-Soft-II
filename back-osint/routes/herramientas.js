const express = require('express');
const router = express.Router();

// GET /api/herramientas
router.get('/', async (req, res) => {
  const result = await req.db.query("SELECT * FROM herramientas;");
  res.json(result.rows);
});

// GET /api/categorias/:id/herramientas
router.get('/categorias/:id/herramientas', async (req, res) => {
  const result = await req.db.query(
    `SELECT h.nombre AS herramienta, c.nombre AS categoria
     FROM rel_herramientas_categorias r
     JOIN herramientas h ON r.id_herramienta = h.id_herramienta
     JOIN categorias_herramientas c ON r.id_categoria = c.id_categoria
     WHERE c.id_categoria = $1;`, [req.params.id]);
  res.json(result.rows);
});

module.exports = router;
