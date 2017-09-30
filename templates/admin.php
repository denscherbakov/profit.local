<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Admin-panel</title>
</head>
<body>
<a href="/">Назад</a> /
<a href="/admin/save/">Добавить новость</a>
<?php foreach ($this->news as $row): ?>
    <h3><a href="/index/one/<?php echo $row->id; ?>"><?php echo $row->title; ?></a></h3>
    <p><?php echo mb_substr($row->text, 0, 100); ?></p>
    <p><?php echo $row->author->name; ?></p>
    <small><a href="/admin/update/<?php echo $row->id ?>">Редактировать</a></small>
    <hr>
<?php endforeach; ?>
</body>
</html>
