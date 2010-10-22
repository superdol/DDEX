<?php $this->load->helper('string'); ?>
<div id="box">
<h2>Pages</h2>
<p><a href="/administrator/pages/add" class="add">Add a page</a></p>
<table cellpadding="0" cellspacing="0">
	<tbody>
		<?php foreach ($last_pages as $page) { ?>
			<tr <?php echo alternator('', 'class="odd"'); ?>>
				<td><?php echo date('jS F Y', strtotime($page->datetime)); ?></td>
				<td><?php print $page->path; ?></td>
				<td><?php print $page->title; ?></td>
				<td class="action">
					<a href="/page/<?php echo $page->path ?>" target="_blank" class="view">View</a>
					<a href="/administrator/pages/edit/<?php echo $page->id ?>" class="edit">Edit</a>
					<a href="/administrator/pages/delete/<?php echo $page->id ?>" class="delete">Delete</a>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>
<div class="pagination">
	<?php echo $pagination; ?>
</div>
</div>