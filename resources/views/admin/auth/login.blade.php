<!DOCTYPE html>
<html>
<head>
    <title>Admin Login - SIHUNLAY</title>
</head>
<body>
    <h2>Login Admin</h2>
    <form method="POST" action="#">
        @csrf
        <label>Email:</label>
        <input type="email" name="email">
        <br>
        <label>Password:</label>
        <input type="password" name="password">
        <br>
        <button type="submit">Login</button>
    </form>
</body>
</html>
