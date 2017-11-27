<?php
class Controller_Detail extends Controller
{
    public function action_index(){
        $v = new View("detail");
        $v->title = "detail";
        if(!empty($_GET["id"])&&isset($_GET["id"])){
            $note = Model_Note::instance()->getNoteById($_GET["id"])[0];
            if(empty($note)) $this->redirect("/");
            $v->note = $note;
            $v->comments = Model_Note::instance()->getAllCommentByNoteId($_GET["id"]);
        } else {
            $this->redirect("/");die();
        }
        $v->addCss("main");
        $v->useTemplate();
        $this->responseGZ($v->render());
    }

    public function action_add_new_comment(){
        if(isset($_POST['name']) && !empty($_POST['name'])
            && isset($_POST['description']) && !empty($_POST['description'])
            && isset($_POST['id']) && !empty($_POST['id'])) {
            Model_Note::instance()->addNewComment($_POST['description'], $_POST['name'], $_POST['id']);
        }
        return json_encode("fdsfsd");
    }
}