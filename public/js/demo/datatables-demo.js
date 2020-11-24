// Call the dataTables jQuery plugin
$(document).ready(function() {
  // var url = $("#dataTable").attr('url');
  // alert(url);
  
  $('#dataTable').DataTable();
  
  $('#orderTable').DataTable(
	{
		"order": [[1, 'desc']]
	}
  );
 
 
});