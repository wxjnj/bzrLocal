<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('ans/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('ans/index') ?>">Back to list</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'ans/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['token']->renderLabel() ?></th>
        <td>
          <?php echo $form['token']->renderError() ?>
          <?php echo $form['token'] ?>
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
        <th><?php echo $form['attachment']->renderLabel() ?></th>
        <td>
          <?php echo $form['attachment']->renderError() ?>
          <?php echo $form['attachment'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['attachment_name']->renderLabel() ?></th>
        <td>
          <?php echo $form['attachment_name']->renderError() ?>
          <?php echo $form['attachment_name'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['attachment_size']->renderLabel() ?></th>
        <td>
          <?php echo $form['attachment_size']->renderError() ?>
          <?php echo $form['attachment_size'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['need_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['need_id']->renderError() ?>
          <?php echo $form['need_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['user_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['user_id']->renderError() ?>
          <?php echo $form['user_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['is_true']->renderLabel() ?></th>
        <td>
          <?php echo $form['is_true']->renderError() ?>
          <?php echo $form['is_true'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['created_at']->renderLabel() ?></th>
        <td>
          <?php echo $form['created_at']->renderError() ?>
          <?php echo $form['created_at'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['updated_at']->renderLabel() ?></th>
        <td>
          <?php echo $form['updated_at']->renderError() ?>
          <?php echo $form['updated_at'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
