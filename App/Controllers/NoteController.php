<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Note;
use App\Utils\Utils;

class NoteController extends Controller
{
    protected $noteModel = '';
    protected $notePerPage = 10;

    public function __construct()
    {
        $this->noteModel = new Note();
        $this->utils = new Utils();
    }

    public function index()
    {
        $all = $this->noteModel->all();

        $notesCount = count($all);
        $totalPages = ceil($notesCount / $this->notePerPage);
     
        $this->makeNotePager($notesCount, $totalPages);

        $pagination = $this->utils->drawPager($notesCount, $this->notePerPage);

        $this->$data['pagination'] = $pagination;
        $this->$data['notes'] = $all;

        $this->view('index', $this->$data);
    }

    public function store()
    {
        $note = $this->noteModel;
        $note->title = trim($_POST['title']);
        $note->content = trim($_POST['content']); 
        $note->created_at = date('Y-m-d H:i:s');

        $note->save();
        echo json_encode($note);
        exit();
    }

    public function show($id)
    {
        $data = $this->noteModel->findById($id);
        $this->view('show', $data);
    }

    public function find($id)
    {
        $data = $this->noteModel->findById($id);
        echo json_encode($data);
        exit();
    }

    public function update($id)
    {
        $note = $this->noteModel;
        $note->id = trim($_POST['id']);
        $note->title = trim($_POST['title']);
        $note->content = trim($_POST['content']); 
        unset($note->created_at);

        $note->save();
        echo json_encode($note);
        exit();
       
    }

    public function delete($id)
    {
        $this->noteModel->delete($id);
        echo $id;
        exit();
    }

    public function makeNotePager($notesCount, $totalPages) {
        if(!isset($_GET['page']) || (int)($_GET['page']) == 0 || (int)($_GET['page']) == 1 || (int)($_GET['page']) < 0) {
            $pageNumber = 1;
            $leftLimit = 0;
            $rightLimit = $this->notePerPage;
        }elseif((int)($_GET['page']) >= $totalPages) {
            $pageNumber = $totalPages;
            $leftLimit = $this->notePerPage * ($pageNumber - 1);
            $rightLimit = $notesCount;
        }else {
            $pageNumber = (int)$_GET['page'];
            $leftLimit = $this->notePerPage * ($pageNumber - 1);
            $rightLimit = $this->notePerPage;
        }
        $this->$data['notesOnPage'] = $this->noteModel->getLimitedNotes($leftLimit, $rightLimit);
    }
}
