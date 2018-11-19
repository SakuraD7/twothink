<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:85:"D:\phpStudy\WWW\twothink\public/../application/admin/view/default/property\index.html";i:1542120449;s:82:"D:\phpStudy\WWW\twothink\public/../application/admin/view/default/public\base.html";i:1496373782;s:88:"D:\phpStudy\WWW\twothink\public/../application/admin/view/default/property\sidemenu.html";i:1542122004;}*/ ?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $meta_title; ?>|TwoThink管理平台</title>
    <link href="__ROOT__/public/favicon.ico" type="image/x-icon" rel="shortcut icon">
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/admin/css/base.css" media="all">
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/admin/css/common.css" media="all">
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/admin/css/module.css">
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/admin/css/style.css" media="all">
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/admin/css/<?php echo \think\Config::get('color_style'); ?>.css" media="all">
     <!--[if lt IE 9]>
    <script type="text/javascript" src="__PUBLIC__/static/jquery-1.10.2.min.js"></script>
    <![endif]--><!--[if gte IE 9]><!-->
    <script type="text/javascript" src="__PUBLIC__/static/jquery-2.0.3.min.js"></script>
    <script type="text/javascript" src="__PUBLIC__/admin/js/jquery.mousewheel.js"></script>
    <!--<![endif]-->
    
</head>
<body>
    <!-- 头部 -->
    <div class="header">
        <!-- Logo -->
        <span class="logo"></span>
        <!-- /Logo -->

        <!-- 主导航 -->
        <ul class="main-nav">
            <?php if(is_array($__MENU__['main']) || $__MENU__['main'] instanceof \think\Collection || $__MENU__['main'] instanceof \think\Paginator): $i = 0; $__LIST__ = $__MENU__['main'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?>
                <li class="<?php echo (isset($menu['class']) && ($menu['class'] !== '')?$menu['class']:''); ?>"><a href="<?php echo url($menu['url']); ?>"><?php echo $menu['title']; ?></a></li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
        <!-- /主导航 -->

        <!-- 用户栏 -->
        <div class="user-bar">
            <a href="javascript:;" class="user-entrance"><i class="icon-user"></i></a>
            <ul class="nav-list user-menu hidden">
                <li class="manager">你好，<em title="<?php echo session('user_auth.username'); ?>"><?php echo session('user_auth.username'); ?></em></li>
                <li><a  onclick="go_home();">前台首页</a></li>
                <li><a href="<?php echo url('User/updatePassword'); ?>">修改密码</a></li>
                <li><a href="<?php echo url('User/updateNickname'); ?>">修改昵称</a></li>
                <li><a href="<?php echo url('Admin/delcache'); ?>">更新缓存</a></li>
                <li><a href="<?php echo url('Publics/logout'); ?>">退出</a></li>
            </ul>
        </div>
    </div>
    <!-- /头部 -->

    <!-- 边栏 -->
    <div class="sidebar">
        <!-- 子导航 -->
        
<div id="subnav" class="subnav">
    <?php if(!(empty($_extra_menu) || (($_extra_menu instanceof \think\Collection || $_extra_menu instanceof \think\Paginator ) && $_extra_menu->isEmpty()))): ?>
        
        <?php echo extra_menu($_extra_menu,$__MENU__); endif; if(is_array($__MENU__['child']) || $__MENU__['child'] instanceof \think\Collection || $__MENU__['child'] instanceof \think\Paginator): $i = 0; $__LIST__ = $__MENU__['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sub_menu): $mod = ($i % 2 );++$i;?>
        <!-- 子导航 -->
        <?php if(!(empty($sub_menu) || (($sub_menu instanceof \think\Collection || $sub_menu instanceof \think\Paginator ) && $sub_menu->isEmpty()))): if(!(empty($key) || (($key instanceof \think\Collection || $key instanceof \think\Paginator ) && $key->isEmpty()))): ?><h3><i class="icon icon-unfold"></i><?php echo $key; ?></h3><?php endif; ?>
            <ul class="side-sub-menu">
                <?php if(is_array($sub_menu) || $sub_menu instanceof \think\Collection || $sub_menu instanceof \think\Paginator): $i = 0; $__LIST__ = $sub_menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?>
                    <li>
                        <a class="item" href="<?php echo url($menu['url']); ?>"><?php echo $menu['title']; ?></a>
                    </li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        <?php endif; ?>
        <!-- /子导航 -->
    <?php endforeach; endif; else: echo "" ;endif; ?>
 <h3>
 	<i class="icon <?php if(!in_array((request()->action()), explode(',',"mydocument,draftbox,examine"))): ?>icon-fold<?php endif; ?>"></i>
 	个人中心
 </h3>
 	<ul class="side-sub-menu <?php if(!in_array((request()->action()), explode(',',"mydocument,draftbox,examine"))): ?>subnav-off<?php endif; ?>">
 		<li <?php if(request()->action() == 'mydocument'): ?>class="current"<?php endif; ?>><a class="item" href="<?php echo url('article/mydocument'); ?>">我的文档</a></li>
 		<?php if($show_draftbox == '1'): ?>
 		<li <?php if(request()->action() == 'draftbox'): ?>class="current"<?php endif; ?>><a class="item" href="<?php echo url('article/draftbox'); ?>">草稿箱</a></li>
 		<?php endif; if($show_examine == '1'): ?>
		<li <?php if(request()->action() == 'examine'): ?>class="examine"<?php endif; ?>><a class="item" href="<?php echo url('article/examine'); ?>">待审核</a></li>
		<?php endif; ?>
 	</ul>
    <?php if(is_array($nodes) || $nodes instanceof \think\Collection || $nodes instanceof \think\Paginator): $i = 0; $__LIST__ = $nodes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sub_menu): $mod = ($i % 2 );++$i;?>
        <!-- 子导航 -->
        <?php if(!(empty($sub_menu) || (($sub_menu instanceof \think\Collection || $sub_menu instanceof \think\Paginator ) && $sub_menu->isEmpty()))): ?>
            <h3>
            	<i class="icon <?php if($sub_menu['current'] != '1'): ?>icon-fold<?php endif; ?>"></i>
            	<?php if($sub_menu['allow_publish'] > '0'): ?><a class="item" href="<?php echo url($sub_menu['url']); ?>"><?php echo $sub_menu['title']; ?></a><?php else: ?><?php echo $sub_menu['title']; endif; ?>
            </h3>
            <ul class="side-sub-menu <?php if($sub_menu["current"] != '1'): ?>subnav-off<?php endif; ?>">
                <?php if(is_array($sub_menu['_child']) || $sub_menu['_child'] instanceof \think\Collection || $sub_menu['_child'] instanceof \think\Paginator): $i = 0; $__LIST__ = $sub_menu['_child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?>
                    <li <?php if($menu['id'] == $cate_id or $menu['current'] == 1): ?>class="current"<?php endif; ?>>
                        <?php if($menu['allow_publish'] > '0'): ?><a class="item" href="<?php echo url($menu['url']); ?>"><?php echo $menu['title']; ?></a><?php else: ?><a class="item" href="javascript:void(0);"><?php echo $menu['title']; ?></a><?php endif; ?>

                        <!-- 一级子菜单 -->
                        <?php if(isset($menu['_child'])): ?>
                        <ul class="subitem">
                        	<?php if(is_array($menu['_child']) || $menu['_child'] instanceof \think\Collection || $menu['_child'] instanceof \think\Paginator): if( count($menu['_child'])==0 ) : echo "" ;else: foreach($menu['_child'] as $key=>$three_menu): ?>
                            <li>
                                <?php if($three_menu['allow_publish'] > '0'): ?><a class="item" href="<?php echo url($three_menu['url']); ?>"><?php echo $three_menu['title']; ?></a><?php else: ?><a class="item" href="javascript:void(0);"><?php echo $three_menu['title']; ?></a><?php endif; ?>
                                <!-- 二级子菜单 -->
                                <?php if(isset($three_menu['_child'])): ?>
                                <ul class="subitem">
                                	<?php if(is_array($three_menu['_child']) || $three_menu['_child'] instanceof \think\Collection || $three_menu['_child'] instanceof \think\Paginator): if( count($three_menu['_child'])==0 ) : echo "" ;else: foreach($three_menu['_child'] as $key=>$four_menu): ?>
                                    <li>
                                        <?php if($four_menu['allow_publish'] > '0'): ?><a class="item" href="<?php echo url('index','cate_id='.$four_menu['id']); ?>"><?php echo $four_menu['title']; ?></a><?php else: ?><a class="item" href="javascript:void(0);"><?php echo $four_menu['title']; ?></a><?php endif; ?>
                                        <!-- 三级子菜单 -->
                                        <?php if(isset($four_menu['_child'])): ?>
                                        <ul class="subitem">
                                        	<?php if(is_array($four_menu['_child']) || $four_menu['_child'] instanceof \think\Collection || $four_menu['_child'] instanceof \think\Paginator): $i = 0; $__LIST__ = $four_menu['_child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$five_menu): $mod = ($i % 2 );++$i;?>
                                            <li>
                                            	<?php if($five_menu['allow_publish'] > '0'): ?><a class="item" href="<?php echo url('index','cate_id='.$five_menu['id']); ?>"><?php echo $five_menu['title']; ?></a><?php else: ?><a class="item" href="javascript:void(0);"><?php echo $five_menu['title']; ?></a><?php endif; ?>
                                            </li>
                                            <?php endforeach; endif; else: echo "" ;endif; ?>
                                        </ul>
                                        <?php endif; ?>
                                        <!-- end 三级子菜单 -->
                                    </li>
                                     <?php endforeach; endif; else: echo "" ;endif; ?>
                                </ul>
                                <?php endif; ?>
                                <!-- end 二级子菜单 -->
                            </li>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                        <?php endif; ?>
                        <!-- end 一级子菜单 -->
                    </li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        <?php endif; ?>
        <!-- /子导航 -->
    <?php endforeach; endif; else: echo "" ;endif; ?>
    <!-- 回收站 -->
	<?php if($show_recycle == '1'): ?>
    <h3>
        <em class="recycle"></em>
        <a href="<?php echo url('article/recycle'); ?>">回收站</a>
    </h3>
    <?php endif; ?>
</div>
<script>
    $(function(){
        $(".side-sub-menu li").hover(function(){
            $(this).addClass("hover");
        },function(){
            $(this).removeClass("hover");
        });
    })
</script>


        <!-- /子导航 -->
    </div>
    <!-- /边栏 -->

    <!-- 内容区 -->
    <div id="main-content">
        <div id="top-alert" class="fixed alert alert-error" style="display: none;">
            <button class="close fixed" style="margin-top: 4px;">&times;</button>
            <div class="alert-content">这是内容</div>
        </div>
        <div id="main" class="main">
            
            <!-- nav -->
            <?php if(!(empty($_show_nav) || (($_show_nav instanceof \think\Collection || $_show_nav instanceof \think\Paginator ) && $_show_nav->isEmpty()))): ?>
            <div class="breadcrumb">
                <span>您的位置:</span>
                <assign name="i" value="1" />
                <?php if(is_array($_nav) || $_nav instanceof \think\Collection || $_nav instanceof \think\Paginator): if( count($_nav)==0 ) : echo "" ;else: foreach($_nav as $k=>$v): if($i == count($_nav)): ?>
                    <span><?php echo $v; ?></span>
                    <?php else: ?>
                    <span><a href="<?php echo $k; ?>"><?php echo $v; ?></a>&gt;</span>
                    <?php endif; ?>
                    <assign name="i" value="$i+1" />
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
            <?php endif; ?>
            <!-- nav -->
            

            
	<div class="main-title">
		<h2>物业管理</h2>
	</div>
	<div class="cf">
		<a class="btn" href="<?php echo url('add','id='.$id); ?>">新 增</a>
		<a class="btn" href="javascript:;">删 除</a>
		<button class="btn list_sort" url="<?php echo url('sort',array('pid'=>input('get.pid',0)),''); ?>">排序</button>
	</div>

	<div class="data-table table-striped">
		<table>
			<thead>
				<tr>
					<th class="row-selected">
						<input class="checkbox check-all" type="checkbox">
					</th>
					<th>ID</th>
					<th>报修原因</th>
					<th>业主姓名</th>
					<th>联系方式</th>
                    <th>您的地址</th>
                    <th>详细描述</th>
                    <th>报修时间</th>
					<th>操作</th>
				</tr>
			</thead>
			<tbody>
				<?php if(!(empty($list) || (($list instanceof \think\Collection || $list instanceof \think\Paginator ) && $list->isEmpty()))): if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$property): $mod = ($i % 2 );++$i;?>
					<tr>
						<td><input class="ids row-selected" type="checkbox" name="" id="" value="<?php echo $property['id']; ?>"> </td>
						<td><?php echo $property['id']; ?></td>
						<td><?php echo $property['reason']; ?></td>
						<td><?php echo $property['name']; ?></td>
						<td><?php echo $property['tel']; ?></td>
						<td><?php echo $property['address']; ?></td>
						<td><?php echo $property['contents']; ?></td>
						<!--<td><a href="<?php echo url('index?pid='.$channel['id']); ?>"><?php echo $channel['title']; ?></a></td>-->
						<td><?php echo date("Y-m-d",$property['create_time']); ?></td>
						<td>
							<a title="编辑" href="<?php echo url('edit?id='.$property['id'].'&pid='.$pid); ?>">编辑</a>
							<a href="<?php echo url('setStatus?ids='.$channel['id'].'&status='.abs(1-$channel['status'])); ?>" class="ajax-get"><?php echo show_status_op($channel['status']); ?></a>
							<a class="confirm ajax-get" title="删除" href="<?php echo url('del?id='.$property['id']); ?>">删除</a>
						</td>
					</tr>
				<?php endforeach; endif; else: echo "" ;endif; else: ?>
				<td colspan="6" class="text-center"> aOh! 暂时还没有内容! </td>
				<?php endif; ?>
			</tbody>
		</table>
		<div class="page"><?php echo $list->render(); ?></div>
	</div>


        </div>
        <div class="cont-ft">
            <div class="copyright">
                <div class="fl">感谢使用<a href="http://www.twothink.cn" target="_blank">TwoThink</a>管理平台</div>
                <div class="fr">V<?php echo TWOTHINK_VERSION; ?></div>
            </div>
        </div>
    </div>
    <!-- /内容区 -->
    <script type="text/javascript">
    (function(){
        var ThinkPHP = window.Think = {
            "ROOT"   : "__ROOT__", //当前网站地址
            "APP"    : "__APP__", //当前项目地址
            "PUBLIC" : "__PUBLIC__", //项目公共目录地址
            "DEEP"   : "<?php echo config('pathinfo_depr'); ?>", //PATHINFO分割符
            "MODEL"  : ["3", "<?php echo config('url_convert'); ?>", "<?php echo config('url_html_suffix'); ?>"],//config('URL_MODEL')
            "VAR"    : ["<?php echo config('var_module'); ?>", "<?php echo config('var_controller'); ?>", "<?php echo config('var_action'); ?>"]
        }
    })();
    </script>
    <script type="text/javascript" src="__PUBLIC__/static/think.js"></script>
    <script type="text/javascript" src="__PUBLIC__/admin/js/common.js"></script>
    <script type="text/javascript">
        +function(){
            var $window = $(window), $subnav = $("#subnav"), url;
            $window.resize(function(){
                $("#main").css("min-height", $window.height() - 130);
            }).resize();

            /* 左边菜单高亮 */
            url = window.location.pathname + window.location.search;
            url = url.replace(/(\/(p)\/\d+)|(&p=\d+)|(\/(id)\/\d+)|(&id=\d+)|(\/(group)\/\d+)|(&group=\d+)/, "");
            $subnav.find("a[href='" + url + "']").parent().addClass("current");

            /* 左边菜单显示收起 */
            $("#subnav").on("click", "h3", function(){
                var $this = $(this);
                $this.find(".icon").toggleClass("icon-fold");
                $this.next().slideToggle("fast").siblings(".side-sub-menu:visible").
                      prev("h3").find("i").addClass("icon-fold").end().end().hide();
            });

            $("#subnav h3 a").click(function(e){e.stopPropagation()});

            /* 头部管理员菜单 */
            $(".user-bar").mouseenter(function(){
                var userMenu = $(this).children(".user-menu ");
                userMenu.removeClass("hidden");
                clearTimeout(userMenu.data("timeout"));
            }).mouseleave(function(){
                var userMenu = $(this).children(".user-menu");
                userMenu.data("timeout") && clearTimeout(userMenu.data("timeout"));
                userMenu.data("timeout", setTimeout(function(){userMenu.addClass("hidden")}, 100));
            });

	        /* 表单获取焦点变色 */
	        $("form").on("focus", "input", function(){
		        $(this).addClass('focus');
	        }).on("blur","input",function(){
				        $(this).removeClass('focus');
			        });
		    $("form").on("focus", "textarea", function(){
			    $(this).closest('label').addClass('focus');
		    }).on("blur","textarea",function(){
			    $(this).closest('label').removeClass('focus');
		    });

            // 导航栏超出窗口高度后的模拟滚动条
            var sHeight = $(".sidebar").height();
            var subHeight  = $(".subnav").height();
            var diff = subHeight - sHeight; //250
            var sub = $(".subnav");
            if(diff > 0){
                $(window).mousewheel(function(event, delta){
                    if(delta>0){
                        if(parseInt(sub.css('marginTop'))>-10){
                            sub.css('marginTop','0px');
                        }else{
                            sub.css('marginTop','+='+10);
                        }
                    }else{
                        if(parseInt(sub.css('marginTop'))<'-'+(diff-10)){
                            sub.css('marginTop','-'+(diff-10));
                        }else{
                            sub.css('marginTop','-='+10);
                        }
                    }
                });
            }
        }();
        function go_home() {
          window.open("<?php echo url('/'); ?>");
        }
    </script>
    
<script type="text/javascript">
    $(function() {
    	//点击排序
    	$('.list_sort').click(function(){
    		var url = $(this).attr('url');
    		var ids = $('.ids:checked');
    		var param = '';
    		if(ids.length > 0){
    			var str = new Array();
    			ids.each(function(){
    				str.push($(this).val());
    			});
    			param = str.join(',');
    		}

    		if(url != undefined && url != ''){
    			window.location.href = url + '/ids/' + param;
    		}
    	});
    });

</script>

</body>
</html>
