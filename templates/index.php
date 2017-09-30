<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>{{ title }}</title>
</head>
<body>
    <a href="/admin/">Enter to admin-panel</a></small>

    {% for row in news %}

        <h3><a href="/index/one/{{ row.id }}"> {{ row.title }} </a></h3>
        <p> {{ row.text }} </p>

        <hr>

    {% endfor %}

</body>
</html>
