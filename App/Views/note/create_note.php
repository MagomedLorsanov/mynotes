<form id="add-form" action="" method="post" enctype="multipart/form-data">
    <div class="form-title">
        <h3>Добавить заметку</h3>
    </div>
    <label class="add-title" for="title">Title:
    </label> <span id="title-err" class="form-invalid"></span>
    <input type="text" id="title" name="title" placeholder="title..." required autofocus value="" />

    <label class="add-title" for="content">Content:
    </label> <span id="content-err" class="form-invalid"></span>
    <textarea id="content" name="content" placeholder="content..." required value=""></textarea>
    <button id="store" class="add form-btn" type="submit">Добавить</button>
    <button id="update" class="add form-btn" type="submit">Обновить</button>
    <span class="successfully-saved"><i class="fa fa-thumbs-up"></i> Data successfully saved!</span>
</form>