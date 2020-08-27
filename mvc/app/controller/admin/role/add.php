<?php

/*
后台角色修改控制器
*/

if($_POST){
	$name = $_POST['title'];
	$permission_id = implode(',', $_POST['check']);
	// print_r($permission_id);die;
	$res=insert("insert into role values(0,'$name','$permission_id')");
    if (!$res) {
    	echo '<script>alert("失败");window.location.href="index.php?m=1&c='.C.'&a='.A.'&id='.$id.'"</script>';
    	exit;
    
    }

    echo '<script>alert("成功");window.location.href="index.php?m=1&c='.C.'&a=index"</script>';
}

// 1.查询1级数据
$menu_data=select("select * from menu where module='admin' and pid=0");

// 2.循环一级数据：目的 根据一级id产训二级
foreach ($menu_data as $k => $v) {
	$id =$v['id'];
// 3.查询对应得的二级数据
	$data=select("select * from menu where pid=$id");
// 4.将二级数据放到对应以及数据内
	$menu_data[$k]['child']=$data;
	//var_dump($menu_data[$k]['child']);die;
}

// print_r(
//   ['name'=>'新闻管理',
//     'c'=>[
//        '列表',
//        '添加'
//     ]
//   ],
//   ['name'=>'新闻管理',
//     'c'=>[
//        '列表',
//        '添加'
//     ]
//   ]


// );die;



require'app/view/admin/public/header.html';
require 'app/view/admin/role/add.html';
require'app/view/admin/public/footer.html';

