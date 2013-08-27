<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('category/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
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
          <?php echo $form['name'] ?>
        </td>
      </tr>
    </tbody>
  </table>
  <table class="full-table form-button-table" cellspacing="0" cellpadding="0" border="0">
		<tr>
			<td width="80px">
				  <a href="<?php echo url_for('@category') ?>">
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
