<?php require_once  __DIR__ . '/../includes/header.php'; ?>

<div class="container">
    <form id="add-form" class="show-form" action="" method="POST" enctype="multipart/form-data">
        <div id="store" class="note">
            <div class="date">Created_at: <span class="created_at"><?php echo $data->created_at; ?></span></div>
            <div class="title">
                <label class="add-title" for="title">Title:
                </label> <span id="title-err" class="form-invalid"></span>
                <input type="text" id="title" class="title-<?php echo $data->id ?>" name="title" placeholder="title..." autofocus value="<?php echo $data->title; ?>" />
            </div>
            <div class="content">
                <label class="add-title" for="content">Content:
                </label> <span id="content-err" class="form-invalid"></span>
                <textarea id="content" name="content" placeholder="content..." value=""><?php echo $data->content; ?></textarea>
            </div>
            <div class="action"><button id="update" class="add form-btn show-submit-btn" type="submit" data-id='<?php echo $data->id; ?>'>Обновить</button></div>
            <span class="successfully-saved"><i class="fa fa-thumbs-up"></i> Data successfully updated!</span>
        </div>
    </form>

    <div id="myModal"></div>
</div>
<script src="/Public/js/show.js"></script>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>