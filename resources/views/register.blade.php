<div>
    <h1>Register</h1>

    <form method="post" action="{{url('Account/Register/Auth')}}">
        @csrf
        <label for="usename">Username: </label>
        <input type="text" name="username">

        <label for="password">Password: </label>
        <input type="password" name="password">

        <input type="submit">
    </form>

    <a href="/Account/Login">Login</a>
    <a href="/">Home</a>
</div>