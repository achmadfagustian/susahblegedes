<body class="loginpage">
	<div class="loginbox">
    	<div class="loginboxinner">
            <div class="logo">
            	<h1><span>KING</span>S</h1>
                <p>Motor</p>
            </div><!--logo-->
            <br clear="all" /><br />
			<?php $msg = $this->fungsi->get_sys_msg(); if($msg!=""){?>
            <div class="nousername">
				<div class="loginmsg">
				<?php 
					/* Display system message */
					echo $msg;
					echo validation_errors('<p class="field_error">', '</p>'); ?>
				</div>
            </div>
			<?php }?>
			<?php if($this->fungsi->is_login()){?>
			<div class="loginf">
				<div class="thumb"><img alt="" src="images/thumbs/avatar1.png" />
					<div class="userlogged">
						<a href="<?php echo site_url('login_adm1n/logout')?>">Not <span><?php echo $this->session->userdata('dispname')?></span> ?</a> 
					</div>
				</div>
			</div><!--loginf-->
			<?php }else{?>
            <form id="login" action="<?php echo base_url('login_adm1n/do_login')?>" method="post">
                <div class="username">
                	<div class="usernameinner">
                    	<input type="text" name="username" id="username" />
                    </div>
                </div>
                <div class="password">
                	<div class="passwordinner">
                    	<input type="password" name="pass" id="pass" />
                    </div>
                </div>
                <button>Sign In</button>
                <div class="keep"><input type="checkbox" /> Keep me logged in</div>
            </form>
			<?php };?>
        </div><!--loginboxinner-->
    </div><!--loginbox-->
</body>
</body>