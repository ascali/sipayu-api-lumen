
	<script>

		$(document).ready(function() {
			$.fn.dataTable.ext.errMode = 'throw';
			$("#name-user").html(session.data.user.name);
			$("#email-user").html(session.data.user.email);
		});
				
	</script>
	</body>
	<!--end::Body-->
</html>