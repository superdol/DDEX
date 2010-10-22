<?php $this->load->helper('string'); ?>
<div id="box">
<h2>News</h2>
<p><a href="/administrator/news/add" class="add">Add a news</a></p>
<table cellpadding="0" cellspacing="0">
	<tbody>
		<?php foreach ($last_news as $news) { ?>
			<tr <?php echo alternator('', 'class="odd"'); ?>>
				<td><?php echo date('jS F Y', strtotime($news->datetime)); ?></td>
				<td><?php print $news->title; ?></td>
				<td class="action">
					<a href="/news/<?php echo $news->path ?>" target="_blank" class="view">View</a>
					<a href="/administrator/news/edit/<?php echo $news->id ?>" class="edit">Edit</a>
					<a href="/administrator/news/delete/<?php echo $news->id ?>" class="delete">Delete</a>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>
<div class="pagination">
	<?php echo $pagination; ?>
</div>
</div>