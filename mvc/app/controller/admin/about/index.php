<?php

/*
后台管理员控制器
*/

// $data=select("select * from about");
$data = select("select n.*,c.name from about as n left join about_cates as c on n.cat_id=c.id ");

//截取内容
foreach ($data as $k => $v) {
 	
	if (mb_strlen($v['content'],'utf-8')>12) {
		$data[$k]['content'] = mb_substr($v['content'], 0,12,'utf-8').'...';
	}//内容
}

require'app/view/admin/public/header.html';
require 'app/view/admin/about/index.html';
require'app/view/admin/public/footer.html';
