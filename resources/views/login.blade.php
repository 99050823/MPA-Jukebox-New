<div>
    <h1>Login</h1>    

    <form method="post" action="{{url('Account/Login/Auth')}}">
        @csrf
        <label for="usename">Username: </label>
        <input type="text" name="username">

        <label for="password">Password: </label>
        <input type="password" name="password">

        <input type="submit">
    </form>

    <a href="/Account/Register">Register</a>
    <a href="/">Home</a>
</div>

