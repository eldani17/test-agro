<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Enviar Email</title>
</head>
<body>
  <p>Fecha de carga: {{$msg['date']}}</p>
  <p>Nombre: {{$msg['fromName']}}</p>
  <p>Email: {{$msg['fromEmail']}}</p>
  <p>Asunto: {{$msg['subjectId']}}</p>
  <p>Mensaje: {{$msg['body']}}</p>
</body>
</html>
