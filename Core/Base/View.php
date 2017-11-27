<?php

class View{
    private $data=[],$css=[],$js=[],$view_path,$template_path=NULL;
    public function __set($name,$value){
        $this->data[$name]=$value;
    }

    public function addCss($name){
        $this->css[]=Helper_HTML::CSS($name);
    }

    public function addJs($name){
        $this->js[] = Helper_HTML::JS($name);
    }

    public function __construct($name){
        $this->view_path = VIEW_PATH.$name.".php";
    }
    public function useTemplate($name="default"){
        $this->template_path = TEMPLATE_PATH.$name.".php";
    }
    private function renderClear(array $data=[]){
        ob_start();
        extract($data);
        include $this->view_path;
        return ob_get_clean();
    }
    private function renderWithTemplate(array $data=[]){
        ob_start();
        extract($data);
        $content = $this->renderClear($data);
        include $this->template_path;
        return ob_get_clean();
    }
    public function render(array $data=[]){
        $data["css_files"] = implode("\r\n",$this->css);
        $data["js_files"] = implode("\r\n",$this->js);
        $data = array_merge($data,$this->data);
        return ($this->template_path===NULL) ? $this->renderClear($data) : $this->renderWithTemplate($data);
    }


}

