<!DOCTYPE html> 
<html lang="en">
	<!--begin::Head-->
	<head>
		<base href=""/>
		<title>SIPAYU</title>
		<meta charset="utf-8" />
		<meta name="data-bs-theme-mode" content="dark">
		<meta name="data-bs-theme" content="dark">
		<meta name="prefers-color-scheme" content="dark">
		<meta name="description" content="SIPAYU" />
		<meta name="keywords" content="SIPAYU" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="SIPAYU" />
		<meta property="og:url" content="//sipayu.indramayukab.go.id" />
		<meta property="og:site_name" content="SIPAYU" />
		<link rel="canonical" href="//sipayu.indramayukab.go.id" />
		<link rel="shortcut icon" href="{{ url('public/images/sipayu-ori-logo.png') }}" />
		<!--begin::Fonts(mandatory for all pages)-->
		<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Vendor Stylesheets(used for this page only)-->
		<link href="{{ url('public/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ url('public/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="//code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
		<!--end::Vendor Stylesheets-->
		<!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
		<link href="{{ url('public/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ url('public/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
		<script>// Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }</script>

		<!--begin::Javascript-->
		<script>var hostUrl = "{{ url('public/assets') }}";</script>
		<script>var baseUrl = "{{ url('') }}";</script>
		<script>var baseUrlApi = '';//window.location.hostname; //!= 'sipayu.indramayukab.go.id' ? `http://${window.location.hostname}:8000/public` : `//be-sipayu.indramayukab.go.id/public`;</script>
		<script>var urlImage = window.location.hostname; //baseUrlApi.replace('/public','');</script>
		<!--begin::Global Javascript Bundle(mandatory for all pages)-->
		<script src="{{ url('public/assets/plugins/global/plugins.bundle.js') }}"></script>
		<script src="{{ url('public/assets/js/scripts.bundle.js') }}"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Vendors Javascript(used for this page only)-->
		<script src="{{ url('public/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
		<!-- compress -->
		<script src="//cdnjs.cloudflare.com/ajax/libs/lz-string/1.5.0/lz-string.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/lz-string/1.5.0/base64-string.min.js"></script>
		<!-- compress -->
		<script src="//cdn.amcharts.com/lib/5/index.js"></script>
		<script src="//cdn.amcharts.com/lib/5/xy.js"></script>
		<script src="//cdn.amcharts.com/lib/5/percent.js"></script>
		<script src="//cdn.amcharts.com/lib/5/radar.js"></script>
		<script src="//cdn.amcharts.com/lib/5/themes/Animated.js"></script>
		<script src="//cdn.amcharts.com/lib/5/map.js"></script>
		<script src="//cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
		<script src="//cdn.amcharts.com/lib/5/geodata/continentsLow.js"></script>
		<script src="//cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
		<script src="//cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js"></script>
		<script src="//cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js"></script>
		<script src="{{ url('public/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
		<script src="//code.jquery.com/ui/1.13.3/jquery-ui.js"></script>

		<!--end::Vendors Javascript-->
		<script>
			if (localStorage.getItem("sipayuSession") == null) {
				window.location = "{{ url('login') }}";
			}
			$("#kt_datatable_zero_configuration").DataTable();
			$(document).on("click", "#sign-out", function() {
				localStorage.removeItem("sipayuSession");
				window.location = "{{ url('login') }}";
			});
		
			var session = JSON.parse(localStorage.sipayuSession);
			var apiKey = session.data.access_token;
			var oTable;
			
			var swalWithBootstrapButtons = Swal.mixin({
				customClass: {
					confirmButton: "btn btn-success",
					cancelButton: "btn btn-danger"
				},
				buttonsStyling: false
			});
	
			async function refreshKey() {
				let headersList = {
					"Accept": "*/*",
					"Authorization": `Bearer ${apiKey}` 
				}
				let reqOptions = {
					url: `${baseUrlApi}/api/refresh`,
					method: "POST",
					headers: headersList,
				}
				let response = await axios.request(reqOptions);
				apiKey = response.data.data;
				return apiKey;
			}

			// setInterval(() => {
			// 	refreshKey()
			// }, ((1000 * 60) * 15)/*15min*/);
	
			function swalFailed() {
				Swal.fire({
					text: "Galat, hubungi administrator!",
					icon: "warning",
					buttonsStyling: false,
					confirmButtonText: "Ok, mengerti!",
					customClass: {
						confirmButton: "btn btn-primary"
					}
				});
			}
		</script>
		<!--end::Javascript-->

	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_app_body" data-kt-app-header-fixed="true" data-kt-app-header-fixed-mobile="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" data-kt-app-aside-enabled="false" data-kt-app-aside-fixed="false" data-kt-app-aside-push-toolbar="false" data-kt-app-aside-push-footer="true" class="app-default">
		<!--begin::Theme mode setup on page load-->
		<script>var defaultThemeMode = "dark"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>
		<!--end::Theme mode setup on page load-->