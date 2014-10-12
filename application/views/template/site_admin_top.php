	<style>
		.headerwidget{
			width: 180px;
		}
	</style>
	<div class="header">
		<div class="f-left">
			<h1 class="logo"><span class="c-red">King's</span> Motor</h1><br/>
			<span class="user-login">Welcome, <?php echo $this->session->userdata('dispname');?></span> <span class="sep">|</span>
			<span class="logout"><a href="<?php echo site_url('login_adm1n/logout');?>">Logout</a></span>
		</div>
		<div class="f-right">
			<ul class="headermenu">
				<?php $menu_tops = $this->fungsi->get_menu_top(1,M_ADMIN);
					foreach ($menu_tops as $mt){?>
					<li class="<?php echo ($menu_active == $mt->id_menu)? "current":""; ?>">
						<a href="<?php echo site_url($mt->menu_url);?>"><span class="icon <?php echo $mt->menu_icon;?>"></span><?php echo $mt->menu_nama;?></a>
					</li>
				<?php }?>
			</ul>
        </div>
    </div><!--header-->