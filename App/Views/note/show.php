<?php require_once  __DIR__ . '/../includes/header.php'; ?>

<div class="container">
    <form id="add-form" class="show-form" action="" method="PUT" enctype="multipart/form-data">
        <div class="note">
            <div class="date">Created_at: <span class="created_at"><?php echo $data['created_at']; ?></span></div>
            <div class="title">
                <label class="add-title" for="title">Title:
                </label> <span id="title-err" class="form-invalid"></span>
                <input type="text" id="title" name="title" placeholder="title..." autofocus value="<?php echo $data['title']; ?>" />
            </div>
            <div class="content">
                <label class="add-title" for="content">Content:
                </label> <span id="content-err" class="form-invalid"></span>
                <textarea id="content" name="content" placeholder="content..." value=""><?php echo $data['content']; ?></textarea>
            </div>
            <div class="action"><button id="update" class="add form-btn show-submit-btn" type="submit" data-id='<?php echo end(explode("/", $_SERVER['REQUEST_URI'])); ?>'>Обновить</button></div>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>