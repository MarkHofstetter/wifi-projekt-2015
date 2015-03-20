<?php
 // module/Album/view/share/lend/add.phtml:

 $title = 'ausleihen';
 $this->headTitle($title);
 ?>
 <h2><?php echo $this->escapeHtml($title); ?></h2>
 <br/><br/>
 <?php


 $form->setAttribute('action', $this->url('lend', array('action' => 'add')));
 $form->prepare();

 echo $this->form()->openTag($form);
 echo $this->formHidden($form->get('id'));

 echo $this->formRow($form->get('lend_begin'));
 echo $this->formRow($form->get('lend_end'));
 echo $this->formSubmit($form->get('submit'));
 echo $this->form()->closeTag();