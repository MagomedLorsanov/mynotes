<?php require_once  __DIR__ . '/../includes/header.php'; ?>
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
                foreach ($data as $key => $value) {
                    echo "<tr>
                    <td>" . $value['title'] . "</td>
                    <td>" . $value['created_at'] . "</td>
                    <td>
                    <a href='/note/show/" . $value['id'] . "'><button class='button show'>Show</button></a>
                        <button id='modalBtn_" . $value['id'] . "' class='button edit' onclick ='getNote(" . $value['id'] . ")'>Edit</button>
                        <button id = '" . $value['id'] . "' class='button delete' onclick ='deleteNote(" . $value['id'] . ")'>Delete</button>
                    </td>
                </tr>";
                }
            }
            ?>
        </tbody>
    </table>

</div>
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <?php require __DIR__ . '/create_note.php'; ?>
    </div>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>