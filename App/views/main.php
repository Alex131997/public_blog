<div class="content">
    <div class="slider slider_top_note">
        <div class="arrow arrowleft"></div>
        <div class="arrow arrowright"></div>
        <div class="mover">
            <?php if(!empty($notes)):
                foreach ($slider as $slide): ?>
                    <a href= <?="/detail?id=".$slide['id']?> >
                        <div class=slide>
                            <h2><?=$slide['title']?></h2>
                            <p><?=substr($slide["description"], 0, 100);?></p>
                        </div>
                    </a>
                <?php endforeach; 
            else: ?>
                <div class=slide><p>В этом блоге пока нет записей</p></div>
            <?php endif;?>
        </div>
    </div>
    <p class="add_comment">Добавить новую запись:</p>
    <form id="add_new_note">
        <label for="name">Имя</label>
        <input id="name" type="text" name="name">
        <label for="title">Заголовок</label>
        <input id="title" type="text" name="title">
        <label for="description">Текст публикации</label>
        <textarea id="description" maxlength="20000" name="description"></textarea>
        <button type="submit">Отправить</button>
    </form>
    <p class="add_comment">Все записи:</p>
    <ul class="all_notes">
       <?php if(!empty($notes)):
             foreach ($notes as $note): ?>
                <li>
                    <h2><?=$note["title"]?></h2>
                    <p><?=substr($note["description"], 0, 100);?></p>
                    <div class="details">
                        <span class="author">Автор: <?=$note["author"]?></span>
                        <span class="publication_date">Дата публикации: <?=$note["created_time"]?></span>
                    </div>
                    <span class="comment">Количество комментариев: <?=$note["count_comment"]?></span>
                    <a href= <?="/detail?id=".$note['id']?> ><div>Подробнее</div></a>
                </li>
            <?php endforeach; 
        else: ?>
            <li><h2>В этом блоге пока нет записей</h2></li> 
        <?php endif;?>
    </ul>
</div>

<script type="text/javascript">
        $.validator.addMethod("regx", function(value, element, regexpr) {          
            return regexpr.test(value);
        }, "Пожалуйста проверьте");


        $('#add_new_note').validate({
        rules: {
            name: {
                required: true,
                regx: /^[а-яА-ЯёЁa-zA-Z0-9-]+?$/
            },
            title: {
                required: true,
                regx: /^[а-яА-ЯёЁa-zA-Z0-9,.:;'"`()?!=-@#$%*&~{}]+?$/
            },
            description: {
                required: true,
                regx: /^[а-яА-ЯёЁa-zA-Z0-9,.:;'"`()?!=-@#$%*&~{}]+?$/
            }
        },
        submitHandler: function () {
            $.ajax({
                type: "POST",
                url: "main/add_new_note",
                data: $('#add_new_note').serializeArray(),
                 success: function () {
                    location.reload(true);
                }
            })
        }
    });


</script>