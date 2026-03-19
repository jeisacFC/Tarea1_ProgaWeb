<!DOCTYPE html>
<html>

<head>
    <title>Información de Contacto</title>
</head>

<body>
    <h1>Información de Contacto Recibida</h1>
    <p><strong>Nombre:</strong> {{ $data['name'] }}</p>
    <p><strong>Teléfono:</strong> {{ $data['phone'] }}</p>
    <p><strong>Dirección:</strong> {{ $data['address'] }}</p>
    <p><strong>Email:</strong> {{ $data['email'] }}</p>
    <p><strong>Estado Civil:</strong> {{ $data['marital_status'] }}</p>
    <br>
    <a href="/">Volver al formulario</a>
</body>

</html>
