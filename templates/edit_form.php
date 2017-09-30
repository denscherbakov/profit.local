<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Php 2.</title>
</head>
<body>
    <hr>
    <?php if (null !== $this->data['article']): ?>
        <form action="/admin/update/<?php echo $this->data['article']->id ?>" method="post">
            <p><input type="text" name="title" value="<?php echo $this->data['article']->title ?>" required></p>
            <p><input type="text" name="text" value="<?php echo $this->data['article']->text ?>" required></p>
            <p><input type="text" name="author" value="<?php echo $this->data['article']->author_id ?>" required></p>
            <p><input type="submit" value="Сохранить"></p>
        </form>
    <?php else: ?>
        <form action="/admin/save/" method="post">
            <p><input type="text" name="title" placeholder="Введите заголовок" required></p>
            <p><input type="text" name="text" placeholder="Введите текст" required></p>
            <p><input type="text" name="author" placeholder="Введите Ваше имя" required></p>
            <p><input type="submit" value="Отправить"></p>
        </form>
    <?php endif; ?>
</body>
</html>