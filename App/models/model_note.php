<?php

class Model_Note extends Model
{
    private static $inst=NULL;
    public static function instance(){
        return self::$inst ? self::$inst : self::$inst=new self();
    }

    public function getAll(){
        return $this->DB->note->getAllNoteWithCountComment();
    }

    public function getAllNoteWithCountComment(){
        return $this->DB->note->getAllNoteWithCountComment();
    }

    public function getNoteById($id){
        return $this->DB->note->getAll("id=?",[$id]);
    }
    public function getAllCommentByNoteId($id){
        return $this->DB->comment->getAll("note_id=?",[$id]);
    }

    /**
     * @param $title
     * @param $description
     * @param $author
     * @return mixed
     */
    public function addNewNote($title, $description, $author){
        $this->DB->note->insert(["title"=>$title,"description"=>$description,"author"=>$author]);
    }
    public function addNewComment($comment_text, $author, $note_id){
        $this->DB->comment->insert(["comment_text"=>$comment_text,"author"=>$author, "note_id"=>$note_id]);
    }
}
