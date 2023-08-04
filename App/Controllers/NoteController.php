<?php

namespace app\Controllers;

use App\Models\Note;
use App\Core\Controller;

class NoteController extends Controller
{
    protected $noteModel = '';

    public function __construct()
    {
        $this->noteModel = new Note('notes');
    }

    public function index()
    {
        $notes = $this->noteModel->all();
        $this->view('index', $notes);
    }

    public function store()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $note = [
                'title' => trim($_POST['title']),
                'content' => trim($_POST['content']),

                'title_err' => '',
                'content_err' => ''
            ];

            if (empty($note['title'])) {
                $note['title_err'] = 'Please enter a title';
            }

            if (empty($note['content'])) {
                $note['content_err'] = 'Please enter a content';
            }

            $created_at = date('Y-m-d H:i:s');
            $note['created_at'] = $created_at;
            if (empty($note['title_err']) && empty($note['content_err'])) {
                $aa = $this->noteModel->add($note['title'], $note['content'], $note['created_at']);
                $note['id'] = $aa;
            }
        } else {
            $note = [
                'title' => '',
                'content' => '',

                'title_err' => '',
                'content_err' => ''
            ];
        }
        echo json_encode($note);
        exit();
    }

    public function show($id)
    {
        $data = $this->noteModel->show($id);
        $note = [
            'id' => $data['id'],
            'title' => $data['title'],
            'content' => $data['content'],
            'created_at' => $data['created_at']
        ];
        $this->view('show', $note);
    }

    public function find($id)
    {
        $data = $this->noteModel->show($id);
        $note = [
            'id' => $data['id'],
            'title' => $data['title'],
            'content' => $data['content'],
            'method' => 'PUT'
        ];
        echo json_encode($note);
        exit();
    }

    public function update($id)
    {
        $note = [];
        echo '<pre>';
        var_dump($_POST);
        echo '</pre>';
        if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
            if (!empty($_POST['title'])) {
                $note['title'] = trim($_POST['title']);
            }

            if (!empty($_POST['content'])) {
                $note['content'] = trim($_POST['content']);
            }

            $this->noteModel->update($note['title'], $note['content'], $id);
        }

        echo json_encode($note);
        exit();
    }

    public function delete($id)
    {
        $this->noteModel->delete($id);
        $this->view('index');
    }
}
