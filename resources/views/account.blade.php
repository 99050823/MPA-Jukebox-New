<style>
    h3 {
        margin-left: 2cm;
    }

    ul {
        list-style-type: none;
        margin-right: 15cm; 
    }

    li {
        background-color: orange;
        padding-left: 1.5cm;
        margin-bottom: 0.2cm;
        border-radius: 10px;
    }

    a {
        text-decoration: none;
        font-size: larger;
        color: black;
    }

    li:hover {
        background-color: black;
        color: white;
    }
</style>

<div class="account-container">
    <h1>Account</h1>
    <hr>

    <!-- Check if user is logged in -->
    <h3>{{$accountText}}</h3>

    <ul>
        <a href="{{$link}}"><li>{{$linkText}}</li></a>
        {!!$registerLink!!}
        <a href="/"><li>Home</li></a>
    </ul>
</div>