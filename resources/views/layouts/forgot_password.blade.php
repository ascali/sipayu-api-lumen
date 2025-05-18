<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head><base href="../../"/>
		<title>Forgot Password | SIPAYU</title>
		<meta charset="utf-8" />
		<meta name="description" content="SIPAYU" />
		<meta name="keywords" content="sipayu" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="SIPAYU" />
		<meta property="og:url" content="//sipayu.indramayukab.go.id" />
		<meta property="og:site_name" content="SIPAYU" />
		<link rel="canonical" href="//sipayu.indramayukab.go.id" />
		<link rel="shortcut icon" href="{{ url('images/sipayu-ori-logo.png') }}" />
		<!--begin::Fonts(mandatory for all pages)-->
		<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
		<link href="{{ url('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ url('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
		<script>// Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }</script>
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="app-blank">
		<!--begin::Theme mode setup on page load-->
		<script>
			var defaultThemeMode = "light";
			var themeMode;
			if (document.documentElement) {
				if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
					themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
				} else {
					if (localStorage.getItem("data-bs-theme") !== null) {
						themeMode = localStorage.getItem("data-bs-theme");
					} else {
						themeMode = defaultThemeMode;
					}
				}
				if (themeMode === "system") {
					themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
				}
				document.documentElement.setAttribute("data-bs-theme", themeMode);
			}
		</script>
		<!--end::Theme mode setup on page load-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root" id="kt_app_root">
			<!--begin::Authentication - reset-password -->
			<div class="d-flex flex-column flex-lg-row flex-column-fluid">
				<!--begin::Aside-->
				<div class="d-flex flex-column flex-lg-row-auto bg-danger w-xl-600px positon-xl-relative">
					<!--begin::Wrapper-->
					<div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-600px scroll-y">
						<!--begin::Header-->
						<div class="d-flex flex-row-fluid flex-column text-center p-5 p-lg-10 pt-lg-20">
							<!--begin::Logo-->
							<a href="javascript:void(0)" class="py-2 py-lg-20">
								<img alt="Logo" src="{{ url('images/main.png') }}" class="h-40px h-lg-550px" />
							</a>
							<!--end::Logo-->
							<!--begin::Title-->
							<h1 class="d-none d-lg-block fw-bold text-white fs-2qx pb-5 pb-md-10">Welcome to SIPAYU</h1>
							<!--end::Title-->
							<!--begin::Description-->
							<p class="d-none d-lg-block fw-semibold fs-2 text-white">Plan your destination travel by choosing a place
							<br />a beautiful and healing places</p>
							<!--end::Description-->
						</div>
						<!--end::Header-->
						<!--begin::Illustration-->
						<div class="d-none d-lg-block d-flex flex-row-auto bgi-no-repeat bgi-position-x-center bgi-size-contain bgi-position-y-bottom min-h-100px min-h-lg-350px" style="background-image: url(assets/media/illustrations/sketchy-1/17.png)"></div>
						<!--end::Illustration-->
					</div>
					<!--end::Wrapper-->
				</div>
				<!--begin::Aside-->
				<!--begin::Body-->
				<div class="d-flex flex-column flex-lg-row-fluid py-10">
					<!--begin::Content-->
					<div class="d-flex flex-center flex-column flex-column-fluid">
						<!--begin::Wrapper-->
						<div class="w-lg-500px p-10 p-lg-15 mx-auto">
							<!--begin::Form-->
							<form class="form w-100" novalidate="novalidate" id="kt_password_reset_form" data-kt-redirect-url="/login" action="#">
								<!--begin::Heading-->
								<div class="text-center mb-10">
									<!--begin::Title-->
									<a href="javascript:void(0)" class="py-2 py-lg-20">
										<img alt="Logo" src="{{ url('images/sipayu-ori.png') }}" class="h-40px h-lg-250px" />
									</a>
									<!--end::Title-->
								</div>
								<!--begin::Heading-->
								<!--begin::Input group-->
								<div class="fv-row mb-10">
									<!--begin::Label-->
									<label class="form-label fs-6 fw-bold text-dark">Lupa Password? Masukan Email Anda</label>
									<!--end::Label-->
									<!--begin::Input-->
									<input class="form-control form-control-lg form-control-solid" placeholder="your@mail.com" type="email" name="email" autocomplete="off" />
									<!--end::Input-->
								</div>
								<!--end::Input group-->
								<!--begin::Actions-->
								<div class="text-center">
									<!--begin::Submit button-->
									<button type="submit" id="kt_password_reset_submit" class="btn btn-lg btn-danger w-100 mb-5">
										<span class="indicator-label">Submit</span>
										<span class="indicator-progress">Mohon Tunggu...
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
									</button>
									<!--end::Submit button-->
								</div>
								<!--end::Actions-->
							</form>
							<!--end::Form-->
						</div>
						<!--end::Wrapper-->
					</div>
					<!--end::Content-->
					<!--begin::Footer-->
					<div class="d-flex flex-center flex-wrap fs-6 p-5 pb-0">
						<!--begin::Links-->
						<div class="d-flex flex-center fw-semibold fs-6">
							<a href="#" class="text-muted text-hover-danger px-2" target="_blank">Dinas Pariwisata, Pemuda dan Olahraga Kab. Indramayu | Gincu Media Telematika</a>
						</div>
						<!--end::Links-->
					</div>
					<!--end::Footer-->
				</div>
				<!--end::Body-->
			</div>
			<!--end::Authentication - reset-password-->
		</div>
		<!--end::Root-->
		<!--begin::Javascript-->
		<script>
			var hostUrl = "{{ url('assets') }}";
			var baseUrl = "{{ url('') }}";
		</script>
		<!--begin::Global Javascript Bundle(mandatory for all pages)-->
		<script src="{{ url('assets/plugins/global/plugins.bundle.js') }}"></script>
		<script src="{{ url('assets/js/scripts.bundle.js') }}"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Custom Javascript(used for this page only)-->
		<script>
			var baseUrlApi = '';//window.location.hostname; //!= 'sipayu.indramayukab.go.id' ? `http://${window.location.hostname}:9090/public` : `//be-sipayu.indramayukab.go.id/public`;
		</script>
		<script src="{{ url('assets/js/custom/authentication/reset-password/reset-password.js') }}"></script>
		<!--end::Custom Javascript-->
		<!--end::Javascript-->
	</body>
	<!--end::Body-->
</html>