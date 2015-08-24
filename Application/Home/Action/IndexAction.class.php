<?php
namespace Home\Action;

class IndexAction extends BaseAction {
	/**
	 * 跳到首页
	 */
    public function index(){
        $user = D('Home/Index');
        $data = $user->queryByList();
        $this->assign('data',$data);
        $this->display("/index");
    }
    /**
     * 导出
     */
    public function import(){
        $tableName="excel";
        $title=array("user_name","user_phone","user_sex","user_email");
        $result=importExcel($tableName,$title);
        $this->success($result);
    }
}