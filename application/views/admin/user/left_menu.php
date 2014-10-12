<div class="vernav iconmenu">
	<ul>
		<?php $menu_tops = $this->fungsi->get_menu_left(1,M_USER);
			foreach ($menu_tops as $mt){?>
			<li class="<?php echo ($submenu_active == $mt->id_menu)? "current":""; ?>">
				<a href="<?php echo site_url($mt->menu_url);?>"><span class="icon <?php echo $mt->menu_icon;?>"></span><?php echo $mt->menu_nama;?></a>
			</li>
		<?php }?>
	</ul>
	<a class="togglemenu"></a>
	<br /><br />
</div>