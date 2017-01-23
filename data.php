<?php
header("content-type:text/html;charset=utf-8");
//实现传统分页效果
//连接数据库、获得数据、分页显示
$link = mysql_connect('localhost','root','123456');
mysql_select_db('shop0811', $link);
mysql_query('set names utf8');

//数据分页实现
//① 引入分页工具类
include("./page.class.php");

//② 获得记录总条数/每页显示条数设置
$sql = "select * from sw_goods";
$qry = mysql_query($sql);
$cnt = mysql_num_rows($qry); //数据总条数
$per = 7;//每页显示7条

//③ 实例化分页类对象
$page_obj = new Page($cnt, $per);

//④ 拼装sql语句，获得每页信息
$sql3 = "select goods_name,goods_price,goods_number,goods_weight from sw_goods ".$page_obj->limit;
$qry3 = mysql_query($sql3);

//⑤ 获得页码列表
$pagelist = $page_obj -> fpage(array(3,4,5,6,7,8));

//通过table表格显示数据
echo <<<eof
<style type="text/css">
    table {width:700px; margin:auto;border:1px solid black; border-collapse:collapse;}
    td {border:1px solid black;}
</style>
<table>
<tr><td>序号</td><td>名称</td><td>价格</td><td>数量</td><td>重量</td></tr>
eof;

$p = isset($_GET['page'])?$_GET['page']:1;
$i = ($p-1)*$per+1; //(页码-1)*每页条数+1
while($rst3 = mysql_fetch_assoc($qry3)){
    echo "<tr>";
    echo "<td>".$i++."</td>";
    echo "<td>".$rst3['goods_name']."</td>";
    echo "<td>".$rst3['goods_price']."</td>";
    echo "<td>".$rst3['goods_number']."</td>";
    echo "<td>".$rst3['goods_weight']."</td>";
    echo "</tr>";
}
echo "<tr><td colspan='5'>$pagelist</td></tr>";
echo "</table>";