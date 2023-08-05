<?php require_once  __DIR__ . '/../includes/header.php';
?>
<div class="container">
    <div class="btn_container">
        <button id="addNodeBtn" class="add">Add Note</button>
    </div>
    <table id="notes">
        <thead>
            <tr>
                <th>Title</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($data)) {
                foreach ($data['notesOnPage'] as $key => $value) {
                    echo "<tr>
                    <td class='title-" . $value->id . "'>" . $value->title . "</td>
                    <td>" . $value->created_at . "</td>
                    <td>
                    <a href='/note/show/" . $value->id . "'><button class='button show'>Show</button></a>
                        <button class='button edit' onclick ='getNote(" . $value->id . ")'>Edit</button>
                        <button class='button delete' onclick ='deleteNote(" . $value->id . ")'>Delete</button>
                    </td>
                </tr>";
                }
            }
            ?>
        </tbody>
    </table>

    <div class="row">
        <div class="pagination">
            <?php echo $data['pagination']; ?>
        </div>
    </div>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <?php require __DIR__ . '/create_note.php'; ?>
        </div>
    </div>

    <div id="delModal" class="modal-del">
        <span onclick="document.getElementById('delModal').style.display='none'" class="close" title="Close Modal">×</span>
        <div class="modal-content-del">
            <div class="container">
                <h1>Delete Note</h1>
                <p>Are you sure you want to delete the note?</p>
                <div class="clearfix">
                    <button type="button" onclick="document.getElementById('delModal').style.display='none'" class="cancelbtn">Cancel</button>
                    <button type="button" class="deletebtn">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/Public/js/modal.js"></script>
<script src="/Public/js/main.js"></script>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>