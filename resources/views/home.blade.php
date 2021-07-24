<html>
<head>
    <link rel="stylesheet" href="https://unpkg.com/purecss@2.0.6/build/pure-min.css" integrity="sha384-Uu6IeWbM+gzNVXJcM9XV3SohHtmWE+3VGi496jvgX1jyvDTXfdK+rfZc8C1Aehk5" crossorigin="anonymous">
</head>
<body>
<table class="pure-table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Link</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($articles as $article)
        <tr>
            <td>{{ $article->id }}</td>
            <td>{{ $article->title }}</td>
            <td><a href="{{ $article->url }}">{{ $article->url }}</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
<a class="pure-button pure-button-primary" href="/logout">Logout</a>
</body>
</html>