<form id="add-form" action="" method="put" enctype="multipart/form-data">
    <div class="form-title">
        <h3>Добавить заметку</h3>
    </div>

    <label class="add-title" for="title">Title:
    </label> <span id="title-err" class="form-invalid"></span>
    <input type="text" id="title" name="title" placeholder="title..." required autofocus value="<?php echo $note['title']; ?>" />


    <label class="add-title" for="content">Content:
    </label> <span id="content-err" class="form-invalid"></span>
    <textarea id="content" name="content" placeholder="content..." required value="<?php echo $note['content']; ?>"></textarea>


    <button id="update" class="add" type="submit">Update</button>
</form>