<?php use_helper('I18N');?>
<div id="header">
    <div class="m_wrap">
         
         <div class="m_rt tebie">
             <div class="top">
		<?php include_partial('home/topU');?>
	</div>
    <div class="m-path-link">
        <?php include_partial('home/mpath');?><span class="m_color">></span>注册
    </div>
    <div class="m-registerWrap">
        <h2>注册</h2>
        <div class="m-register">
			<?php echo get_partial('sfGuardRegister/form', array('form' => $form)) ?>
        </div>
    </div>
         </div>
    </div>

</div>
<?php include_partial('home/footer');?>