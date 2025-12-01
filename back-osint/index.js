const express = require('express');
const { Pool } = require('pg');

const app = express();
app.use(express.json());

// Pool de conexión (ajustar connection string)
const pool = new Pool({
  user: 'postgres',
  host: 'localhost',
  database: 'tu_base',
  password: 'tu_password',
  port: 5432,
});

// Middleware para inyectar pool en req
app.use((req, res, next) => {
  req.db = pool;
  next();
});

// Importar rutas
app.use('/api/usuarios', require('./routes/usuarios'));
app.use('/api/casos', require('./routes/casos'));
app.use('/api/asignaciones', require('./routes/asignaciones'));
app.use('/api/evidencias', require('./routes/evidencias'));
app.use('/api/actividades', require('./routes/actividades'));
app.use('/api/herramientas', require('./routes/herramientas'));
app.use('/api/logs', require('./routes/logs'));
app.use('/api/chatbots', require('./routes/chatbots'));

app.listen(3000, () => console.log('API corriendo en http://localhost:3000'));
