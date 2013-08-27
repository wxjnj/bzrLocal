<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('question/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table class="full-table form-table" cellspacing="0" cellpadding="0" border="0">
     <?php echo $form->renderHiddenFields(false) ?>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
      <td colspan=2 style="line-height:25px;">
      问题标题：<?php echo $form->getObject()->getTitle(); ?><br />
      问题内容：<?php echo $form->getObject()->getContent(); ?><br />
      提问人：<?php echo $form->getObject()->getUser()->getNickName(); ?>
      </td>
      </tr>
      <tr>
        <th>回复内容</th>
        <td>
          <?php echo $form['answer_content']->renderError() ?>
          <?php echo $form['answer_content'] ?>
        </td>
      </tr>
    </tbody>
  </table>
  <table class="full-table form-button-table" cellspacing="0" cellpadding="0" border="0">
		<tr>
			<td width="80px">
				  <a href="<?php echo url_for('@question') ?>">
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
