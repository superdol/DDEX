$(document).ready(function() {
		$('#datetime').datetimepicker({
			dateFormat: 'yy-mm-dd',
			timeFormat: 'hh:mm:ss'
		});
		
		$('#markItUp').markItUp(mySettings);
		
		var $deleteItemAlertDialog = $('<div id="delete-alert-dialog" title="Delete this item ?"></div>')
		.html('<p>Are you sure you want to delete this item ?</p>')
		.dialog({
			autoOpen: false,
			title: 'Delete this item ?',
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
         $deleteItemAlertDialog.data('link',this).dialog('open');
       });

});