<?php $this->Helpers->load('Time');?>
<?php $this->Helpers->load('Paginator');?>
<?php $this->Html->css('/Guestbook/css/guestbook',null,array('inline' => false));?>

<?php $input = $this->Session->read('input');?>
<?php $errors = $this->Session->read('errors');?>

<?php echo $this->Session->flash();?>

<div id='guestbook_write'>

<?php echo $this->Form->create('GuestbookPost', array('url' => array('plugin' => 'Guestbook', 'controller' => 'GuestbookApp','action' => 'save')));?>
	<table>
		<tr>
			<td> <?php echo $this->Form->label('author', __('Name'));?>
			</td>
			<td> <?php if (($input != NULL) && array_key_exists('author', $input['GuestbookPost'])){
							echo $this->Form->input('author', array('label' => false, 'value' => $input['GuestbookPost']['author']));
						} else {
							echo $this->Form->input('author', array('label' => false));
						}
						if (($errors != NULL) && array_key_exists('author', $errors) && array_key_exists('0', $errors['author'])){
							echo $errors['author']['0'];
						}
					?>
			</td>
		</tr>
		<tr>
			<td> <?php echo $this->Form->label('title', __('Titel'));?>
			</td>
			<td> <?php if (($input != NULL) && array_key_exists('title', $input['GuestbookPost'])){
							echo $this->Form->input('title', array('label' => false, 'value' => $input['GuestbookPost']['title']));
						} else{
							echo $this->Form->input('title', array('label' => false));
						}
						if (($errors != NULL) && array_key_exists('title', $errors) && array_key_exists('0', $errors['title'])){
							echo $errors['title']['0'];
						}
					?>
			</td>
		</tr>
		<tr>
			<td> <?php echo $this->Form->label('text', __('Text'));?>
			</td>
			<td> <?php if (($input != NULL) && array_key_exists('text', $input['GuestbookPost'])){
							echo $this->Form->input('text', array('label' => false, 'value' => $input['GuestbookPost']['text']));
						} else{
							echo $this->Form->input('text', array('label' => false));
						}
						if (($errors != NULL) && array_key_exists('text', $errors) && array_key_exists('0', $errors['text'])){
							echo $errors['text']['0'];
						}
					?>
			</td>
		</tr>
		<tr>
			<td></td>
			<td> <?php echo $this->Form->end('Eintrag speichern');?>
			</td>
	</table>
</div>

<div id='guestbook_display'>

	<div class='guestbook_navigation'>
	<?php
	$paging_params = $this->Paginator->params();
	if ($paging_params['count'] > 0){
		echo $this->Paginator->counter(__('Eintr�ge {:start} bis {:end} von {:count}, Seite {:page} von {:pages}, '));
		if ($this->Paginator->hasPrev()){
			echo $this->Paginator->prev('<< ');
		}
		echo $this->Paginator->numbers();
		if ($this->Paginator->hasNext()){
			echo $this->Paginator->next(' >>');
		}
	}
	?>
	</div>
		
	<?php foreach($data as $GuestbookPost):?>
	
		<div class='guestbook_post'>
		
			<div class='guestbook_post_author'>
				<?php echo $GuestbookPost['GuestbookPost']['author'] . __(' am ') . $this->Time->format('d.m.Y', $GuestbookPost['GuestbookPost']['created']) . __(' um ') . $this->Time->format('H:i:s',$GuestbookPost['GuestbookPost']['created'])?>
			</div>
				
			<div class='guestbook_post_title'>
				<?php echo $GuestbookPost['GuestbookPost']['title']?>
				<?php 						
					if (($GuestbookPost['GuestbookPost']['released'] == '0000-00-00 00:00:00') && $this->PermissionValidation->actionAllowed(8, 'release')) {
						echo $this->Html->link($this->Html->image('/img/check.png', array('height' => 16, 'width' => 16, 'alt' => __('Eintrag freigeben'))),
							array('plugin' => 'Guestbook', 'controller' => 'GuestbookApp', 'action' => 'release', $GuestbookPost['GuestbookPost']['id']),
							array('escape' => false));
					}
					if (($GuestbookPost['GuestbookPost']['deleted'] == '0000-00-00 00:00:00') && $this->PermissionValidation->actionAllowed(8, 'delete')) {
						echo $this->Html->link($this->Html->image('/img/delete.png', array('height' => 16, 'width' => 16, 'alt' => __('Eintrag Entfernen'))),
							array('plugin' => 'Guestbook', 'controller' => 'GuestbookApp', 'action' => 'delete', $GuestbookPost['GuestbookPost']['id']),
							array('escape' => false),
							__('Soll der Eintrag wirklich entfernt werden?'));
					}
				?>	
			</div>
			
			<div class='guestbook_post_text'>
				<?php echo $GuestbookPost['GuestbookPost']['text']?>
			</div>
			
		</div>
		
	<?php endforeach;?>

	<div class='guestbook_navigation'>
		<?php 
		$paging_params = $this->Paginator->params();
		if ($paging_params['count'] > 0){
			echo $this->Paginator->counter(__('Seite {:page} von {:pages}, '));
			if ($this->Paginator->hasPrev()){
				echo $this->Paginator->prev('<< ');
			}
			echo $this->Paginator->numbers();
			if ($this->Paginator->hasNext()){
				echo $this->Paginator->next(' >>');
			}
		}
		?>
	</div>

</div>

