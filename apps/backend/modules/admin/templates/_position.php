<table class="full-table">
	<tr>
		<td>
			<div class="content-title">
				<img height="14" width="20" src="/images/book1.gif">
				<?php if($route):?>
				<a href="<?php echo urldecode(url_for($route))?>"><?php echo $route_name?></a>&nbsp;&gt;&gt;&nbsp;
				<?php else:?>
				<?php echo $route_name?>&nbsp;&gt;&gt;&nbsp;
				<?php endif;?>
				<?php echo $position_name;?>
			</div>
		</td>
	</tr>
</table>