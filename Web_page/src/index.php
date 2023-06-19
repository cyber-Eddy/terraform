<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practica</title>
</head>
<body>
    <!-- Listado de usuarios -->

    <?php
        $host = "db";
        $user = "1-17-0170";
        $password = "1-17-0170";
        $dbname = "prueba";

        try {
            $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Crear la tabla si no existe
            $query = "CREATE TABLE IF NOT EXISTS usuarios (codigo INT AUTO_INCREMENT PRIMARY KEY, nombre varchar(50) NOT NULL)";
            $conn->exec($query);

            // Insertar datos si no existen
            $query = "SELECT * FROM usuarios";
            $result = $conn->query($query);
            if ($result->rowCount() == 0) {
                $query = "INSERT INTO usuarios (nombre) VALUES ('Juan'), ('Pedro'), ('Maria'), ('Jose'), ('Luis'), ('eddy')";
                $conn->exec($query);
            }

            // Obtener los resultados de la consulta
            $query = "SELECT * FROM usuarios";
            $result = $conn->query($query);

            // Cerrar la conexión
            $conn = null;
        } catch(PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
        }
    ?>

    <table id="usuarios">
        <tr>
            <th>Id</th>
            <th>Nombre</th>
        </tr>
        <?php
            if ($result) {
                foreach ($result as $row) {
                    echo "<tr>";
                    echo "<td>" . $row["codigo"] . "</td>";
                    echo "<td>" . $row["nombre"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='2'>No se encontraron registros</td></tr>";
            }
        ?>
    </table>

    <style>
        #usuarios {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
        }

        #usuarios td, #usuarios th {
        border: 1px solid #ddd;
        padding: 8px;
        }

        #usuarios tr:nth-child(even){background-color: #f2f2f2;}

        #usuarios tr:hover {background-color: #ddd;}

        #usuarios th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA9D;
            color: white;
        }
    </style>
</body>
</html>