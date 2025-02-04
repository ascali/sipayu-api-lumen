@include('layouts.header')
	<!--begin::App-->
	<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
		<!--begin::Page-->
		<div class="app-page flex-column flex-column-fluid" id="kt_app_page">
			<!-- begin::appheader -->
			@include('layouts.app_header')
			<!-- end::appheader -->
			<!--begin::Wrapper-->
			<div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
				<!--begin::Sidebar-->
				@include('layouts.app_sidebar')
				<!--end::Sidebar-->
				<!--begin::Main-->
				<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
					<!--begin::Content wrapper-->
					<div class="d-flex flex-column flex-column-fluid">
						<!--begin::Toolbar-->
						<div id="kt_app_toolbar" class="app-toolbar pt-5">
							<!--begin::Toolbar container-->
							<div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
								<!--begin::Toolbar wrapper-->
								<div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
									<!--begin::Page title-->
									<div class="page-title d-flex flex-column gap-1 me-3 mb-2">
										<!--begin::Breadcrumb-->
										<ul class="breadcrumb breadcrumb-separatorless fw-semibold mb-6">
											<!--begin::Item-->
											<li class="breadcrumb-item text-gray-700 fw-bold lh-1">
												<a href="javascript:void(0)" class="text-gray-500">
													<i class="ki-duotone ki-home fs-3 text-gray-400 me-n1"></i>
												</a>
											</li>
											<!--end::Item-->
											<!--begin::Item-->
											<li class="breadcrumb-item">
												<i class="ki-duotone ki-right fs-4 text-gray-700 mx-n1"></i>
											</li>
											<!--end::Item-->
											<!--begin::Item-->
											<li class="breadcrumb-item text-gray-700 fw-bold lh-1">{{$title}}</li>
											<!--end::Item-->
											<!--begin::Item-->
											<li class="breadcrumb-item">
												<i class="ki-duotone ki-right fs-4 text-gray-700 mx-n1"></i>
											</li>
											<!--end::Item-->
											<!--begin::Item-->
											<li class="breadcrumb-item text-gray-700">Default</li>
											<!--end::Item-->
										</ul>
										<!--end::Breadcrumb-->
										<!--begin::Title-->
										<h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bolder fs-1 lh-0">{{$title}}</h1>
										<!--end::Title-->
									</div>
									<!--end::Page title-->
									<!--begin::Actions-->
									<a href="javascript:void(0)" class="btn btn-sm btn-success ms-3 px-4 py-3 sipayu_modal">Tambah Data</a>
									<!--end::Actions-->
								</div>
								<!--end::Toolbar wrapper-->
							</div>
							<!--end::Toolbar container-->
						</div>
						<!--end::Toolbar-->
						<!--begin::Content-->
						<div id="kt_app_content" class="app-content flex-column-fluid">
							<!--begin::Content container-->
							<div id="kt_app_content_container" class="app-container container-fluid">
								<!--begin::Row-->
								<div class="row gx-5 gx-xl-12">
									<!--begin::Col-->
									<div class="col-xxl-12 mb-5 mb-xl-12">
										<!--begin::Chart widget 8-->
										<div class="card card-flush">
											<!--begin::Body-->
											<div class="card-body pt-6">
                                                
                                                <div class="table-responsive">
                                                    <table id="datatable_sipayu" class="table table-row-bordered gy-5">
                                                        <thead>
                                                            <tr class="fw-semibold fs-6 text-muted">
                                                                <th>Nama</th>
                                                                <th>Deskripsi</th>
                                                                <th>Dibuat</th>
																<th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                </div>

											</div>
											<!--end::Body-->
										</div>
										<!--end::Chart widget 8-->
									</div>
									<!--end::Col-->
								</div>
								<!--end::Row-->
							</div>
							<!--end::Content container-->
						</div>
						<!--end::Content-->
					</div>
					<!--end::Content wrapper-->
					<!--begin::Footer-->
					@include('layouts.app_footer')
					<!--end::Footer-->
				</div>
				<!--end:::Main-->
			</div>
			<!--end::Wrapper-->
		</div>
		<!--end::Page-->
	</div>
	<!--end::App-->

	<!-- Modal -->
	<form id="form">
		<div class="modal fade" id="modalForm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalFormLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-scrollable">
				<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modalFormLabel">Form {{ $title }}</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
						<input type="hidden" name="id" id="id" />
						<div class="mb-3">
							<label for="name" class="col-form-label">Nama:</label>
							<input type="text" name="name" class="form-control" id="name" required />
						</div>
						<div class="mb-3">
							<label for="description" class="col-form-label">Deskripsi:</label>
							<textarea class="form-control" name="description" id="description" required></textarea>
						</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
					<button type="sumit" class="btn btn-primary">Submit</button>
				</div>
				</div>
			</div>
		</div>
	</form>

    <script>
		var action;
        $(document).ready(function() {
			oTable = $('#datatable_sipayu').DataTable( {
				'ajax': {
					'url': `${baseUrlApi}/api/term_and_condition/list`,
					'type': 'GET',
					'beforeSend': function (request) {
						request.setRequestHeader("Authorization", `Bearer ${apiKey}`);
					}
				},
				"processing":true,
				"serverSide":true,
				"stateSave":true,
				"bDestroy": true,
				"retrieve": true,
				"columns": [
					{ "data": "name" },
					{ "data": "description"  },
					{ "data": "created_at" },
					{ 
						"data": null,
						"render": function(row) {
							let html = `
								<a href="javascript:void(0)" class="btn btn-sm btn-info edit" data-id="${row.id}">Ubah</a>
								<a href="javascript:void(0)" class="btn btn-sm btn-danger delete" data-id="${row.id}">Hapus</a>
							`;
							return html;
						}
					},
				]
			} );
        });
		$('.search-input').keyup(function(){
			oTable.search($(this).val()).draw() ;
		});
		$(document).on("click", ".sipayu_modal", async function() {
			action = "add";
			$("#modalForm").modal("show");
		});
		$(document).on("click", ".edit", function() {
			action = "edit";
			let id = $(this).attr("data-id");
			$("#id").val(id);
			getData(id);
			$("#modalForm").modal("show");
		});
		$(document).on("click", ".delete", async function() {
			let id = $(this).attr("data-id");
			$("#id").val(id);
			await deleteData(id);
		});
		$(document).on("submit", "#form", async function(e) {
			e.preventDefault();
			await submitData();
			setTimeout(async () => {
				await $('form').trigger("reset");
			}, 1000);
			$("#modalForm").modal("hide");
		});

		async function getData(id) {
			let config = {
			  method: 'get',
			  maxBodyLength: Infinity,
			  url: `${baseUrlApi}/api/term_and_condition/${id}`,
			  headers: { 
				"Authorization": `Bearer ${apiKey}`
			  }
			};
			
			await axios.request(config)
			.then(async (response) => {
			  let data = response.data.data;
			  $("#name").val(data.name);
			  $("#description").val(data.description);
			})
			.catch((error) => {
			  swalFailed();
			});

		}

		async function deleteData(id) {
			swalWithBootstrapButtons.fire({
				title: "Apakah yakin?",
				text: "Tidak akan dapat dikembalikan!",
				icon: "warning",
				showCancelButton: true,
				confirmButtonText: "Ya, hapus!",
				cancelButtonText: "Tidak, batal!",
				reverseButtons: true
			}).then(async (result) => {
				if (result.isConfirmed) {
					await execute(id);
					await swalWithBootstrapButtons.fire({
						title: "Terhapus!",
						text: "Data Anda telah dihapus.",
						icon: "success"
					});
					setTimeout(async () => {
						await oTable.ajax.reload( null, false );
					}, 1000);
				} else if (
					result.dismiss === Swal.DismissReason.cancel
				) {
					await swalWithBootstrapButtons.fire({
						title: "Dibatalkan",
						text: "Data Anda aman!",
						icon: "error"
					});
				}
			});

			let execute = async (id) => {
				let config = {
				  method: 'delete',
				  maxBodyLength: Infinity,
				  url: `${baseUrlApi}/api/term_and_condition/delete/${id}`,
				  headers: { 
					"Authorization": `Bearer ${apiKey}` 
				  }
				};
				
				await axios.request(config)
				.then((response) => {
					Swal.fire({
						text: "Berhasil!",
						icon: "success",
						buttonsStyling: false,
						confirmButtonText: "Ok, mengerti!",
						customClass: {
							confirmButton: "btn btn-primary"
						}
					});
				})
				.catch((error) => {
				  	swalFailed();
				});
			}
				

		}

		async function submitData() {
			let data = {
				"name": $("#name").val(),
				"description": $("#description").val(),
			};
			data = JSON.stringify(data);
			let isUrl = action == "add" ? `${baseUrlApi}/api/term_and_condition/create` : `${baseUrlApi}/api/term_and_condition/update/${$("#id").val()}`;
			let config = {
			  method: 'post',
			  maxBodyLength: Infinity,
			  url: isUrl,
			  headers: { 
				'Content-Type': 'application/json', 
				"Authorization": `Bearer ${apiKey}`
			  },
			  data : data
			};
			
			await axios.request(config)
			.then(async (response) => {
				await swalWithBootstrapButtons.fire({
					title: "Berhasil!",
					text: "Data Anda telah disubmit.",
					icon: "success"
				});
				setTimeout(async () => {
					await oTable.ajax.reload( null, false );
				}, 1000);
			})
			.catch((error) => {
				swalFailed();
			});
		}

    </script>

	@include('layouts.scrolltop')
	@include('layouts.modal_template')
@include('layouts.footer')