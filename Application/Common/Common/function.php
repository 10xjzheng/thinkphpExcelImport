<?php
/**
 * 打印数据，用于调试
 * @param var 打印对象
 */
function p($var){
    echo "<pre>";
    var_dump($var);
    echo "</pre>";

}

/** 
 * author:10xjzheng
 * Excel导入
 * @param title 导入表格的字段
 * @param tableName 导入表格的名字
 * @param savePath 文件保存的路径，默认在Public/Excel/
 */
function importExcel($tableName,$title,$savePath="Public/Excel/")
{   
    import('ORG.Util.ExcelToArrary');//导入excelToArray类
    $tmp_file = $_FILES ['excel'] ['tmp_name'];
    $file_types = explode ( ".", $_FILES ['excel'] ['name'] );
    $file_type = $file_types [count ( $file_types ) - 1];
     /*判别是不是.xls文件，判别是不是excel文件*/
    if (strtolower ( $file_type ) != "xlsx" && strtolower ( $file_type ) != "xls")              
    {
        $rs='不是Excel文件，重新上传';
        return $rs;
    }
    //检查是否有该文件夹，如果没有就创建，并给予最高权限 
    if(!file_exists($savePath)) 
    { 
        mkdir($savePath, 0700); 
    }//END IF

    /*以时间来命名上传的文件*/
    $str = date ( 'Ymdhis' ); 
    $file_name = $str . "." . $file_type;
    /*是否上传成功*/
    if (! copy ( $tmp_file, $savePath . $file_name )) 
    {
         $rs= '上传失败';
         return $rs;
    }
    $ExcelToArrary=new ExcelToArrary();//实例化
    $res=$ExcelToArrary->read($savePath.$file_name,"UTF-8",$file_type);//传参,判断office2007还是office2003
    foreach ( $res as $k => $v ) //循环excel表
    {
        if($k>1){
        $k=$k-2;//addAll方法要求数组必须有0索引
        for ($i=0; $title[$i]; $i++) { 
            $data[$k][$title[$i]] = $v [$i];//创建二维数组 
        }

        }
    }
    $model=M($tableName);//M方法
    $result=$model->addAll($data);
    if(! $result)
    {
         $rs='导入数据库失败';
    }
    else
    {
         $rs= '导入成功';    
    }
    return $rs;
}
