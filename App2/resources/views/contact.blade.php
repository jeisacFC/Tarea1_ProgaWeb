<!DOCTYPE html>
<html>

<head>
    <title>Formulario de Contacto</title>
</head>

<body>
    <h1>Formulario de Contacto</h1>
    <form action="/contacto" method="POST">
        @csrf
        <label for="name">Nombre:</label><br>
        <input type="text" id="name" name="name"><br><br>

        <label for="phone">Teléfono:</label><br>
        <input type="text" id="phone" name="phone"><br><br>

        <label for="address">Dirección:</label><br>
        <input type="text" id="address" name="address"><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email"><br><br>

        <label for="marital_status">Estado Civil:</label><br>
        <select id="marital_status" name="marital_status">
            <option value="soltero">Soltero(a)</option>
            <option value="casado">Casado(a)</option>
            <option value="otro">Otro</option>
        </select><br><br>

        <button type="submit">Enviar</button>
    </form>
</body>

</html>
