<?php
class anasayfa extends Controller{
	public function __construct() {
        parent::__construct();
    }
	public function index(){
		$model=$this->load->model("index");
		$data["duyurular"] = $model->sorgula("select * from duyurular");
		$this->load->view("index",$data);
	}
}
?>