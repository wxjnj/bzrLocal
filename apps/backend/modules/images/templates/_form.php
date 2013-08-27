<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('images/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
<?php echo $form->renderHiddenFields(false) ?>
  <table class="full-table form-table" cellspacing="0" cellpadding="0" border="0">
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['title']->renderLabel() ?></th>
        <td>
          <?php echo $form['title']->renderError() ?>
          <?php echo $form['title'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['picture']->renderLabel() ?><br /><span class="red">图片新闻（402*292）分享图片（322*648）</span></th>
        <td>
          <?php echo $form['picture']->renderError() ?>
          <?php echo $form['picture'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['url']->renderLabel() ?></th>
        <td>
          <?php echo $form['url']->renderError() ?>
          <?php echo $form['url'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['content']->renderLabel() ?></th>
        <td>
          <?php echo $form['content']->renderError() ?>
          <?php echo $form['content'] ?>
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
				  <a href="<?php echo url_for('@images') ?>">
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
