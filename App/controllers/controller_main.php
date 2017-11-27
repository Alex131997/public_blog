<?php

class Controller_Main extends Controller{
    public function action_index(){
        $v = new View("main");
        $v->title = "mainpage";
        $notes = Model_Note::instance()->getAll();
        if(!empty($notes)){
            $topNotes = [];
            $slider=[];
            foreach ($notes as $note) {
                $topNotes[$note['id']] = (int)$note['count_comment'];
            }
            arsort($topNotes);
            $i=0;
            foreach ($topNotes as $key => $value) {
                if($i>=5) break;
                $i++;
                foreach ($notes as $note) {
                    if($note['id'] == $key){
                        $slider[] = $note;
                    }
                }
             } 
             $v->slider = $slider;
        }
        $v->notes = $notes;
        $v->addCss("main");
        $v->addJs("slider");
        $v->useTemplate();
        $this->responseGZ($v->render());
    }

    public function action_add_new_note(){
        if(isset($_POST['name']) && !empty($_POST['name'])
            && isset($_POST['title']) && !empty($_POST['title'])
            && isset($_POST['description']) && !empty($_POST['description'])) {
            Model_Note::instance()->addNewNote($_POST['title'],$_POST['description'],$_POST['name']);
        }
    }
}