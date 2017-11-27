<div class="content">
    <div class="detail">
        <h2><?= $note["title"] ?></h2>
        <p><?= $note["description"] ?></p>
        <div class="details">
            <span class="author">Автор: <?= $note["author"] ?></span>
            <span class="publication_date">Дата публикации: <?= $note["created_time"] ?></span>
        </div>
    </div>
    <p class="add_comment">Добавить комментарий:</p>
    <form id="add_new_comment">
        <label for="name">Имя</label>
        <input id="name" type="text" name="name">
        <label for="description">Текст публикации</label>
        <textarea id="description" maxlength="10000" name="description"></textarea>
        <button type="submit">Отправить</button>
    </form>
    <p class="add_comment">Комментарии:</p>
    <div class="all_notes comments">
        <?php
        if(!empty($comments)):
        foreach ($comments as $comment): ?>
            <li>
                <p><?=$comment["comment_text"]?></p>
                <div class="details">
                    <span class="author">Автор: <?=$comment["author"]?></span>
                    <span class="publication_date">Дата публикации: <?=$comment["created_time"]?></span>
                </div>
            </li>
        <?php endforeach; else: ?>
            <li><h2>Для этой записи нет комментариев</h2></li> 
        <?php endif;?>
    </div>
</div>
<script type="text/javascript">

    $.validator.addMethod("regx", function(value, element, regexpr) {          
        return regexpr.test(value);
    }, "Пожалуйста проверьте");


    $('#add_new_comment').validate({
        rules: {
            name: {
                required: true,
                regx: /^[а-яА-ЯёЁa-zA-Z0-9-]+?$/
            },
            description: {
                required: true,
                regx: /^[а-яА-ЯёЁa-zA-Z0-9,.:;'"`()?!=-@#$%*&~{}]+?$/
            }
        },
        submitHandler: function () {
            $.ajax({
                type: "POST",
                url: "detail/add_new_comment",
                data: {name: $('#add_new_comment').find("#name").val(), description: $('#add_new_comment').find("#description").val(), id: <?=$note["id"]?>},
                success: function () {
                    location.reload(true);
                }
            })
        }
    });
</script>