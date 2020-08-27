/*文档注释
 * 控制banner图
 * author:Jack.Wang
 * date:2020/4/8
 */
    //文档就绪(屏幕执行后执行该js)
        $(function  () {
    	var t;//定时器
    	var left=-5760;//图片左移
    	var lock=true//控制动画是否执行完毕，因为在轮播的过程中，最后一张图不能实现无缝轮播
    	//将所有图片再次拼接到原有图片后面
    	//再次来到第一张图时，直接将left跳转为0
    	var img_div=$('.wrapper').html()//提取'.wrapper'的内容
    	var a=$('.wrapper').html(img_div+img_div+img_div)//此时'.wrapper'里有九张图
    	var index =0
    	//图片左移
    	
    	function moveLeftDiv(i = 1) {
    		if (lock) {//加了把锁，在动画未执行完就关闭锁
    			left-=1920*i
    			$('.wrapper').animate({//animate里的内容分别是，左移，移速，动画方式
    				
    				left:left+'px',
    			},800,'linear',function() {
    				if (left<=-11520) {
    					left=-5760
    					$('.wrapper').css('left',-5760)//当left=-5760时直接修改样式
    				}
    				lock=true//动画执行完就开锁
    			})
    			$('.cycle span').removeClass('active')//清除所有span的属性
    		    if(left==-5760){index=0}
    		    if(left==-7680){index=1}
    		    if(left==-9600){index=2}
    		    if(left==-11520){index=0}
    		    $('.cycle span').eq(index).addClass('active')//赋予当前位置的span属性
    		}
    		lock=false
    	}
    	t = setInterval(moveLeftDiv, 4000)
    	
    	//图片右移
    	function  moveRightDiv(i=1) {
    		if(lock){
	            left+=1920*i//向右移动即为负的向左移动
    			$('.wrapper').animate({
    				left:left+'px',
    			},800,'linear',function  () {
    				if (left>=0) {
    					left=-5760
    					$('.wrapper').css('left',-5760)
    				}
    				lock=true
    			})
    		}
    		lock=false
    	}
    	//鼠标悬浮时的情况
    	$(".wrapper").mouseover(function  () {//当鼠标悬浮时
    		clearInterval(t)//清除移动
    	})
    	$('.wrapper').mouseout(function  () {
      		t = setInterval(moveLeftDiv, 4000)
    	})
    	
    	
    	//点击右箭头时
    	$('.arrow-right').mouseup(function  () {
    		moveLeftDiv()
    		$('.cycle span').removeClass('active')
    		if(left==-5760){index=0}
    		if(left==-7680){index=1}
    		if(left==-9600){index=2}
    		if(left==-11520){index=0}
    		$('.cycle span').eq(index).addClass('active')
      		t = setInterval(moveLeftDiv, 4000)
    	})
    	$('.arrow-right').mousedown(function  () {
    		clearInterval(t)
    	})
    	//点击左箭头时
    	$('.arrow-left').mouseup(function(){
    		moveRightDiv()
    		$('.cycle span').removeClass('active')
    		if(left==-7680){index=1}
    		if(left==-5760){index=0}
    		if(left==-1920){index=1}
    		if(left==-3840){index=2}
    		if(left==0){index=0}
    		$('.cycle span').eq(index).addClass('active')
      		t = setInterval(moveLeftDiv, 4000)
    	})
    	$('.arrow-left').mousedown(function(){
    		clearInterval(t)
    	})
    	
    	
    	//小黑点的移动
    	
    	$('.cycle span').mouseup(function  () {
    		var sp_ac_index=$('.cycle span.active').index()//找到具有active属性的的那个span标签
    		var span_index=$(this).index()//找到当前点击的那个span
    		if (span_index > sp_ac_index) {//当当前span的位置大于带active属性的span的位置时
    			moveLeftDiv(span_index - sp_ac_index)//左移(当前span的位置减去带active属性的span的位置得到距离)
    		}
    		else if(span_index < sp_ac_index){
    			moveRightDiv(sp_ac_index-span_index)
    		}
    		//小黑点和轮播图同步
    		$('.cycle span').removeClass('active')//去除所有span的active属性
    		
    		if(left==-5760){index=0}
    		if(left==-7680){index=1}
    		if(left==-9600){index=2}
    		if(left==-11520){index=0}
    		$('.cycle span').eq(index).addClass('active')
    	})
    	$('.pagination span').mousedown(function(){
		     clearInterval(t)
	    })
    	
    	
    	
    	
    	//设置导航栏的样式
    	
    	
    })
//window.onload=function () {
//	//找到all属性 
//	var oAll=document.getElementsByClassName('wrapper')[0];
//	console.log(oAll)
//	//循环移动
//	var i=0;
//	var t;
//	function bnrMove () {
//		oAll.style.left =i+'px'
//		i-=1920
//		if (i<-3840) {
//			i=0
//		}
//		//找到装三个小点的div
//	    var oCycle=document.querySelector('.cycle')
//	    //找到属性为.cycle的div里面的span
//	    var oSpan=oCycle.querySelectorAll('span')
//		oSpan[0].removeAttribute('class')//清除span的class属性
//		oSpan[1].removeAttribute('class')
//		oSpan[2].removeAttribute('class')
//		//添加同步移动
//	    if (i=='0') {
//			oSpan[2].setAttribute('class','active')
//		}
//		if (i=='-1920') {
//			oSpan[0].setAttribute('class','active')
//		}
//		if (i=='-3840') {
//			oSpan[1].setAttribute('class','active')
//		}
//	}
//	//设置定时器，实现自动移动，每三秒移动一次
////	t=setInterval(bnrMove,3000)
//	//鼠标放置停止移动
//	oAll.onmouseover=function(){
//		clearInterval(t)
//	}
//	//鼠标离开开始移动
//	oAll.onmouseout=function  () {
//		t=setInterval(bnrMove,3000)
//	}
//	//找到左箭头
//	var oArrL=document.querySelector('.arrow-left')
//	//鼠标点下停止移动
//	oArrL.onmousedown=function(){
//		clearInterval(t)
//	}
//	//鼠标放开进行左移
//	oArrL.onmouseup=function(){
//		i+=1920;
//		if(i>0){
//			i=-3840
//		}
//		oAll.style.left =i+'px'
//	    t=setInterval(bnrMove,3000)
//	    		//找到装三个小点的div
//	    var oCycle=document.querySelector('.cycle')
//	    //找到属性为.cycle的div里面的span
//	    var oSpan=oCycle.querySelectorAll('span')
//		oSpan[0].removeAttribute('class')//清除span的class属性
//		oSpan[1].removeAttribute('class')
//		oSpan[2].removeAttribute('class')
//		//添加同步移动
//	    if (i=='0') {
//			oSpan[0].setAttribute('class','active')
//		}
//		if (i=='-1920') {
//			oSpan[1].setAttribute('class','active')
//		}
//		if (i=='-3840') {
//			oSpan[2].setAttribute('class','active')
//		}
//	}
//	//找到右箭头
//	var oArrR=document.querySelector('.arrow-right')
//	//鼠标点下停止移动
//	oArrR.onmousedown=function () {
//		clearInterval(t)
//	}
//	//鼠标放开进行右移
//	oArrR.onmouseup=function(){
//		bnrMove()
//				//找到装三个小点的div
//	    var oCycle=document.querySelector('.cycle')
//	    //找到属性为.cycle的div里面的span
//	    var oSpan=oCycle.querySelectorAll('span')
//		oSpan[0].removeAttribute('class')//清除span的class属性
//		oSpan[1].removeAttribute('class')
//		oSpan[2].removeAttribute('class')
//		//添加同步移动
//	    if (i=='0') {
//			oSpan[2].setAttribute('class','active')
//		}
//		if (i=='-1920') {
//			oSpan[0].setAttribute('class','active')
//		}
//		if (i=='-3840') {
//			oSpan[1].setAttribute('class','active')
//		}
//	}
//	//找到装三个小点的div
//	var oCycle=document.querySelector('.cycle')
//	//找到属性为.cycle的div里面的span
//	var oSpan=oCycle.querySelectorAll('span')
//	console.log(oSpan)//在控制台查看有多少个span
//	//找到多少个span就去循环多少次
//	//程序在循环中给每个span绑定点击事件的过程中
//	//点了某个span，程序不知道点的时哪个，所以oSpan.index=j把位置交给标签
//	for (var j=0;j<oSpan.length;j++) {
//		//点了一之后，在下面的点击事件[onlick后面的函数，知道点了谁]
//		oSpan[j].index=j//将当前的位置添加给标签，找到这个标签对象，追加了一个属性[自己起名]
//		oSpan[j].onclick=function  (){
////			console.log(this.index)//this  当前点击的那个标签
//			//表示oSpan[0]，oSpan[1]，oSpan[2]
//			oSpan[0].removeAttribute('class')//清除span的class属性
//			oSpan[1].removeAttribute('class')
//			oSpan[2].removeAttribute('class')
//			switch (this.index){//判断当前点击的按钮[位置]是几
//				case 0://当时第1个span时
//				    oAll.style.left ='0px'//滚动图向左移动'0px'
//					break;
//				case 1://当时第2个span时
//				    oAll.style.left ='-1920px'//滚动图向左移动'-1920px'
//					break;
//				case 2://当时第3个span时
//				    oAll.style.left ='-3840px'//滚动图向左移动'-3840px'
//					break;
//			}
//			this.setAttribute('class','active')//给当前的span标签添加一个class属性，该属性的值时active
//
//	    }	
//  }	
////  
////  <div class="banner">外框
////			<div class="all_img">所有内容
////				<div class="wrapper">所有图片
////					<div class="container">图片
//  
    
    

//}
