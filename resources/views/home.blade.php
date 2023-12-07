<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @auth
    <p>Logged In</p>
    <form action="/logout" method="POST">
        @csrf
        <button type="submit">Log Out</button>
    </form>

    <div style="border: 3px solid black;">
        <h2>post</h2>
        <form action="/addpost" method="POST">
            @csrf
            <input type="text" name="title" placeholder="title">
            <textarea name="body" placeholder="post in here"></textarea>
            <button type="submit">Post</button>
        </form>
    </div>

    <div style="border: 3px solid black;">
        <h2>Posts</h2>
        @foreach($posts as $post)
        <div style="background-color: gray; padding:10px; margin:10px">
            <h3>{{ $post->title }} by {{ $post->user->name }}</h3>
            {{ $post->body }}
            <p><a href="/edit-post/{{ $post->id }}">edit</a></p>
            <form action="/delete-post/{{ $post->id }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </div>
        @endforeach
    </div>

    @else
    <div style="border: 3px solid black;">
        <h2>Register</h2>
        <form action="/register" method="POST">
            @csrf
            <input name="name" type="text" placeholder="name">
            <input name="email" type="text" placeholder="email">
            <input name="password" type="password" placeholder="password">
            <button type="submit">Register</button>
        </form>
    </div>

    <div style="border: 3px solid black;">
        <h2>Login</h2>
        <form action="/login" method="POST">
            @csrf
            <input name="loginname" type="text" placeholder="login name">
            <input name="loginpassword" type="password" placeholder="password">
            <button type="submit">Login</button>
        </form>
    </div>
    @endauth
    
</body>
</html>
