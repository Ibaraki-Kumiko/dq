<!DOCTYPE html>
<html>
    <head>
        <title>Письмо обратной связи</title>
    </head>
    <body>
    <h1>Новое сообщение обратной связи</h1>
        <p><strong>Имя:</strong> {{ $data['name'] }}</p>
        <p><strong>Email:</strong> {{ $data['email'] }}</p>
        <p><strong>Сообщение:</strong></p>
        <p>{{ $data['message'] }}</p>
    </body>
</html>
