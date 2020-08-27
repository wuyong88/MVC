<?php
/**
*文档说明：
*数据库操作文件：

*author：zero
*date：2020/2/12
*/

//连接数据库
//CRUD


// function xxx(){}
// function xxx(){}
// function xxx(){}
// function xxx(){}


//连接数据库：   $link = @mysqli_connect('主机地址','用户名','密码','数据库名') or die('数据库连接错误');
$link = @mysqli_connect('localhost','root','root','mvc44') or die('数据库连接错误');

function query($link,$sql){
	$res = mysqli_query($link, $sql);
	if(!$res){
	echo mysqli_error($link).'sql语句是:'.$sql;  //输出报警信息
 	exit;

}
     return $res;
}
// /**
// * 数据添加
// */
 function insert($sql){
    global $link;
 
   // $GLOBALS['LINK']
    // var_dump($link)
//$sql = "insert into suer($a)values($b)";
$res = query($link,$sql);
 	/* $res = mysqli_query($link,"insert into suer(name)values('123')");*/
//  $res = mysqli_query($link,"insert into 表名(字段)values('值')");
//  if(!$res){
//  echo"添加错误".mysqli_error($link);
//  exit;
	
 	// 成功或失败
 	return $res;
 
}
// insert("insert into 表名(字段)values('值');");
// $data = insert("insert into suer(name)values('wda')") ;
// var_dump($data);


/**
* 数据删除
*/
 function delete($sql){
 	global $link;  //全局
//  	$sql = "delete into 表名(字段)values('值')";

   return query($link, $sql);
}
// $data = delete("delete from suer where name='88888'") ;

// var_dump($data);

// 修改
 function update($sql){

	global $link;
  
   return query($link, $sql);
 }

// // $data = update("update suer set name='ccc' where name='啦啦啦'") ;

// // var_dump($data);

// // 查看
// //  function select($file = '*',$table= 'suer',$where = ''){
function select($sql){
global $link;
	//$sql = "select * from 表名 where 条件";
	$res = query($link, $sql);
	$arr = [];
	while($row = mysqli_fetch_assoc($res)){
		$arr[] = $row;
	}
	mysqli_free_result($res);
	return $arr;
}

// $data = select("select * from admin ") ;

// var_dump($data);



