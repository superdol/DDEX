$(document).ready(function() {
		$('#news_datetime').datetimepicker({
			dateFormat: 'yy-mm-dd',
			timeFormat: 'hh:mm:ss'
		});
		
		$('#markItUp').markItUp(mySettings);
		
		var $deleteNewsAlertDialog = $('<div id="delete-news-alert-dialog" title="Delete this news item ?"></div>')
		.html('<p>Are you sure you want to delete this news ?</p>')
		.dialog({
			autoOpen: false,
			title: 'Delete this news item ?',
			resizable: false,
			height:200,
			modal: true,
			buttons: {
				"Delete": function() {
					$(this).dialog( "close" );
					var path = $(this).data('link').href;
					$(location).attr('href', path);
				},
				Cancel: function() {
					$(this).dialog( "close" );
				}
			}
		});

		$(".delete").click(function(event){
         event.preventDefault();
         $deleteNewsAlertDialog.data('link',this).dialog('open');
       });

});