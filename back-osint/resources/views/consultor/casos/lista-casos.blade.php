<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Casos - Consultor</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
        }

        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .navbar h1 {
            font-size: 22px;
        }

        .container {
            max-width: 1100px;
            margin: 30px auto;
            padding: 0 20px;
        }

        /* === Tarjeta de búsqueda añadida === */
        .search-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 25px;
        }
        /*== Titulo de la tarjeta de busqueda*/ 
        .search-card h2 {
            color: #333;
            margin-bottom: 15px;
            font-size: 20px;
        }
        /* == Search Box */
        .search-box {
            display: flex;
            gap: 15px;
            align-items: center;
        }
        /* == Search Box  Input*/
        .search-box input {
            flex: 1;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 15px;
        }
        /* == Search Box  Button*/
        .search-box button {
            padding: 12px 25px;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.25s ease;
            font-size: 15px;
        }
        /* == Search Box  Button hover*/
        .search-box button:hover {
            background: #5567d9;
        }


        table {
            width: 100%;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        thead {
            background: #667eea;
            color: white;
        }

        th, td {
            padding: 14px 16px;
            text-align: left;
            font-size: 15px;
        }

        tbody tr {
            border-bottom: 1px solid #eee;
            cursor: pointer;
            transition: background 0.2s;
        }

        tbody tr:hover {
            background: #f0f0ff;
        }

        .btn-back {
            display: inline-block;
            margin-top: 25px;
            padding: 10px 20px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            transition: background .3s;
        }

        .btn-back:hover {
            background: #5567d9;
        }

        /* ======= ESTILOS DE ALERTA ======*/
        /* Fondo oscuro transparente */
        .alerta-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.35);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        /* Caja de alerta */
        .alerta-box {
            background: white;
            padding: 25px 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            width: 350px;
            text-align: center;
            animation: fadeIn .2s ease-out;
        }

        .alerta-box h3 {
            margin-bottom: 15px;
            color: #667eea;
            font-size: 20px;
        }

        .alerta-box p {
            color: #444;
            margin-bottom: 20px;
            font-size: 15px;
        }

        .alerta-btn {
            padding: 10px 25px;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 15px;
            transition: background .2s;
        }

        .alerta-btn:hover {
            background: #5567d9;
        }

        /* Animación de entrada */
        @keyframes fadeIn {
            from { transform: scale(0.9); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }

    </style>
</head>

<body>
    <!-- ALERTA PERSONALIZADA -->
    <div id="alertaCustom" class="alerta-overlay" style="display:none;">
        <div class="alerta-box">
            <h3 id="alertaTitulo">Aviso</h3>
            <p id="alertaMensaje"></p>
            <button onclick="cerrarAlerta()" class="alerta-btn">Aceptar</button>
        </div>
    </div>


    <nav class="navbar">
        <h1>Lista de Casos</h1>
        <span id="userSession">{{ Auth::user()->nombre }}</span>
    </nav>

    <div class="container">

        <!-- ==========================
             TARJETA DE BÚSQUEDA
        =========================== -->
        <div class="search-card">
            <h2>Buscar un caso por número</h2>

            <div class="search-box">
                <input type="text" id="searchInput" placeholder="Ingrese número de caso">
                <button onclick="buscarCaso()">Buscar</button>
            </div>
            <a href="{{ route('consultor.inicio') }}" class="btn-back">← Volver al Panel</a>

        </div>

        <div class = "search-card">
            <table>
                <h2>Casos es plataforma</h2>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre del Caso</th>
                        <th>Tipo</th>
                        <th>Estado</th>
                        <th>Creador</th>
                    </tr>
                </thead>
                <tbody id="tablaCasos">
                    @foreach($casos as $caso)
                    <tr onclick="window.location.href='{{ route('consultor.casos.show', $caso->id_caso) }}'">
                        <td>{{ $caso->id_caso }}</td>
                        <td>{{ $caso->nombre }}</td>
                        <td>{{ $caso->tipo_caso }}</td>
                        <td>{{ $caso->estado }}</td>
                        <td>{{ $caso->creador ? $caso->creador->nombre : 'Desconocido' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    <script>
        function buscarCaso() {
            let id = document.getElementById('searchInput').value.trim();
            const casosDisponibles = @json($casos->pluck('id_caso'));
            if (id === "") {
                mostrarAlerta("Ingrese un número de caso");
                return;
            }else if(isNaN(id)){
                mostrarAlerta("Debe ingresar un valor numerico para buscar por número de caso");
                return;
            }else if(!casosDisponibles.includes(parseInt(id))){
                mostrarAlerta("No existe un caso con ese número.");
                return;
            }
            
            // Redirigir al detalle del caso
            window.location.href = "{{ url('consultor/casos') }}/" + id;
        }

        function mostrarAlerta(mensaje, titulo = "Aviso") {
            document.getElementById("alertaTitulo").innerText = titulo;
            document.getElementById("alertaMensaje").innerText = mensaje;
            document.getElementById("alertaCustom").style.display = "flex";
        }

        function cerrarAlerta() {
            document.getElementById("alertaCustom").style.display = "none";
        }

    </script>

</body>
</html>