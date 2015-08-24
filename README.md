# thinkphpExcelImport
thinkphp+phpexcel导入Excel
使用方式：

1.下载phpExcel包放到Vendor文件夹

2.调用函数（函数位于common/function.php）

/** 
 * author:10xjzheng
 * Excel导入
 * @param title 导入表格的字段
 * @param tableName 导入表格的名字
 * @param savePath 文件保存的路径，默认在Public/Excel/
 */
function importExcel($tableName,$title,$savePath="Public/Excel/")

