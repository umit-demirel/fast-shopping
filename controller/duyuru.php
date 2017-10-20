<?php
class duyuru extends Controller{
	public function __construct() {
        parent::__construct();
    }
	public function oku($id=false){
		if(empty($id))
		{
			header("Location:".SITE_URL);
		}else
		{
			$model = $this->load->model("index");
			$data["duyuru"] = $model->sorgula("select * from duyurular where id=".$id);
			$this->load->view("duyuru",$data);
		}
		
	}
}
?>