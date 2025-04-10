<!DOCTYPE html>
<html>
<head>
    <title>Verifay Your Password</title>
</head>
<body>
    <h1>Hello, {{ $name }}</h1>
    <p>Click the link below to Forget your Email Password:</p>
    <a href="{{ url('reset-password/' . $user_id) }}" target="_blank">Verify Email</a>
    <p>If you did not request this, please ignore this email.</p>
</body>
</html>
