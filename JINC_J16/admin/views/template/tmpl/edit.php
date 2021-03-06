<?php
/**
 * @copyright           Copyright (C) 2010 - Lhacky
 * @license		GNU/GPL http://www.gnu.org/licenses/gpl-2.0.html
 *   This file is part of JINC.
 *
 *   JINC is free software: you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation, either version 3 of the License, or
 *   (at your option) any later version.
 *
 *   JINC is distributed in the hope that it will be useful,
 *   but WITHOUT ANY WARRANTY; without even the implied warranty of
 *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *   GNU General Public License for more details.
 *
 *   You should have received a copy of the GNU General Public License
 *   along with JINC.  If not, see <http://www.gnu.org/licenses/>.
 */
defined('_JEXEC') or die('Restricted access');
?>
<?php
isset($this->item) or die('Item is not defined');
$isNew = ($this->item->id == 0);
?>

<script type="text/javascript">
    <!--
    function submitbutton(task) {
        if (task == 'message.cancel' || document.formvalidator.isValid(document.id('message-form'))) {
            submitform(task);
        }
        submitform(task);
    }
    // -->
</script>

<form action="<?php JRoute::_('index.php?option=com_jinc'); ?>" method="post" name="adminForm" id="message-form" class="form-validate">
    <div class="width-60 fltlft">

        <fieldset class="adminform">
            <legend><?php echo empty($this->item->id) ? JText::_('COM_JINC_NEW_TEMPLATE') : JText::sprintf('COM_JINC_EDIT_TEMPLATE', $this->item->id); ?></legend>

            <ul class="adminformlist">
                <?php
                $formArray = array('id', 'name', 'subject');
                foreach ($formArray as $value) {
                    echo '<li>' . $this->form->getLabel($value) . $this->form->getInput($value) . '</li>' . "\n";
                }
                ?>
            </ul>
            <?php echo $this->form->getLabel('body'); ?>
            <div class="clr"></div>
            <?php 
            jincimport('utility.jinceditor');
            $editor_helper = new JINCEditor('jform[body]');
            $editor_helper->content = $this->item->body;
            if (!$isNew) $editor_helper->setTemplate($this->item->id);
            echo $editor_helper->display();
            ?>
        </fieldset>
    </div>

    <div class="width-40 fltrt">
        <fieldset class="adminform">
            <legend><?php echo JText::_('COM_JINC_EDIT_CSS'); ?></legend>

            <?php if (!$isNew) { ?>
                <?php 
                    echo JText::_('COM_JINC_EDIT_CSS_WARNING') . '<br>';
                    echo $this->form->getLabel('cssfile_content'); ?>
                <div class="clr"></div>
                <?php echo $this->form->getInput('cssfile_content'); ?>
            <?php } else { 
                echo JText::_('COM_JINC_EDIT_CSS_ISNEW'); } ?>
        </fieldset>
    </div>

<input type="hidden" name="task" value="" />
<?php echo JHtml::_('form.token'); ?>
</form>