<?php

namespace App\Models;

use App\Model;
 
class Note extends Model
{
    public static $table = 'notes';
    public $id;
    public $title;
    public $content;
    public $created_at;
}
?>