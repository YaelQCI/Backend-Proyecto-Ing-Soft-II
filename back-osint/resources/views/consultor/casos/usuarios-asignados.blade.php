<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios Asignados - Consultor</title>

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
            margin: 0;
        }

        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .container {
            max-width: 1000px;
            margin: 30px auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        h2 { color: #333; margin-bottom: 15px; }
        h3 { color: #555; margin-top: -10px; margin-bottom: 20px; }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            border-bottom: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background: #f0f0f0;
        }

        tr:hover { background: #f9f9f9; }

        .btn-back {
            margin-top: 25px;
            display: inline-block;
            padding: 10px 20px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <h1>Usuarios Asignados</h1>
        <span id="userSession"></span>
    </nav>

    <div class="container">

        <h2 id="tituloCaso">Usuarios Asignados</h2>
        <h3 id="descripcionCaso"></h3>

        <table>
            <thead>
                <tr>
                    <th>ID Usuario</th>
                    <th>Nombre</th>
                    <th>Usuario</th>
                    <th>Correo</th>
                    <th>Rol</th>
                </tr>
            </thead>
            <tbody id="tablaUsuarios"></tbody>
        </table>

        <a id="btnVolver" class="btn-back">← Volver al caso</a>

    </div>

<script>

    const params = new URLSearchParams(window.location.search);
    const casoId = params.get("id");

    if (!casoId) {
        alert("No se proporcionó ID del caso");
        window.location.href = "/consultor/casos/lista-casos";
    }

    document.getElementById("btnVolver").href =
        `/consultor/casos/detalle-caso?id=${casoId}`;


    // VALIDACIÓN DE SESIÓN
    window.addEventListener("load", () => {
        const usuario = JSON.parse(localStorage.getItem("usuario"));
        const token = localStorage.getItem("token");

        if (!token || !usuario) {
            return window.location.href = "/login";
        }

        if (usuario.rol !== "consultor") {
            alert("Acceso denegado");
            return window.location.href = "/login";
        }

        document.getElementById("userSession").textContent = usuario.nombre;

        cargarUsuariosAsignados();
    });


    async function cargarUsuariosAsignados() {
        try {
            const token = localStorage.getItem("token");

            const response = await fetch(
                `{{ url('/api/consultor/casos') }}/${casoId}/asignados`,
                {
                    headers: {
                        "Authorization": "Bearer " + token,
                        "Content-Type": "application/json"
                    }
                }
            );

            const data = await response.json();

            if (!data.caso) {
                alert("Error: no se encontró el caso.");
                return;
            }

            // Mostrar datos del caso
            document.getElementById("tituloCaso").textContent =
                "Usuarios asignados al caso: " + data.caso.nombre;

            document.getElementById("descripcionCaso").textContent =
                data.caso.descripcion ?? "";

            // Mostrar usuarios
            const tbody = document.getElementById("tablaUsuarios");
            tbody.innerHTML = "";

            data.asignados.forEach(u => {
                tbody.innerHTML += `
                    <tr>
                        <td>${u.id_usuario}</td>
                        <td>${u.nombre}</td>
                        <td>${u.usuario}</td>
                        <td>${u.mail}</td>
                        <td>${u.rol}</td>
                    </tr>
                `;
            });

        } catch (error) {
            console.error(error);
            alert("Error al conectar con el servidor");
        }
    }

</script>

</body>
</html>
