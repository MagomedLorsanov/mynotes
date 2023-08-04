<?php require_once  __DIR__ . '/../includes/header.php'; ?>
<div class="container">
    <div class="note">
        <div class="date">Created_at: <span class="created_at"></span></div>
        <div class="title">
            <label class="add-title" for="title">Title:
            </label> <span id="title-err" class="form-invalid"></span>
            <input type="text" id="title" name="title" placeholder="title..." required autofocus value="<?php echo $note['title']; ?>" />
        </div>
        <div class="content">
            <label class="add-title" for="content">Content:
            </label> <span id="content-err" class="form-invalid"></span>
            <textarea id="content" name="content" placeholder="content..." required value="<?php echo $note['content']; ?>"></textarea>
        </div>
        <div class="action"><button id="update" class="add form-btn" type="submit">Обновить</button></div>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>