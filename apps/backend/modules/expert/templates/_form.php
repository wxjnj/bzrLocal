<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('expert/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
<?php echo $form->renderHiddenFields(false) ?>
  <table class="full-table form-table" cellspacing="0" cellpadding="0" border="0">
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['name']->renderLabel() ?></th>
        <td>
          <?php echo $form['name']->renderError() ?>
          <?php echo $form['name'] ?><span class="red">*</span>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['job']->renderLabel() ?></th>
        <td>
          <?php echo $form['job']->renderError() ?>
          <?php echo $form['job'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['sub_description']->renderLabel() ?></th>
        <td>
          <?php echo $form['sub_description']->renderError() ?>
          <?php echo $form['sub_description'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['direction']->renderLabel() ?></th>
        <td>
          <?php echo $form['direction']->renderError() ?>
          <?php echo $form['direction'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['description']->renderLabel() ?></th>
        <td>
          <?php echo $form['description']->renderError() ?>
          <?php echo $form['description'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['picture']->renderLabel() ?></th>
        <td>
          <?php echo $form['picture']->renderError() ?>
          <?php echo $form['picture'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['type']->renderLabel() ?></th>
        <td>
          <?php echo $form['type']->renderError() ?>
          <?php echo $form['type'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['weight']->renderLabel() ?></th>
        <td>
          <?php echo $form['weight']->renderError() ?>
          <?php echo $form['weight'] ?>
        </td>
      </tr>
    </tbody>
  </table>
  <table class="full-table form-button-table" cellspacing="0" cellpadding="0" border="0">
		<tr>
			<td width="80px">
				  <a href="<?php echo url_for('@share') ?>">
					<img height="22" border="0" width="60" src="/images/button_back.gif">
				 </a>

			</td>
			<td width="100px">
				<input type="submit" value="" class="input-submit" id="submit"/>
			</td>
			<td></td>
		</tr>
	</table>
</form>

<script type="text/javascript">
$(function() {
	//表单提交判断
	$('#submit').click(function(){
		var expert_name = $('#expert_name').val();

		if(expert_name == ''){
			alert('专家姓名不能为空！');return false;
		}
	});
});
</script>