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
                                                                <th>Foto</th>
                                                                <th>Role</th>
                                                                <th>Email</th>
                                                                <th>No HP</th>
                                                                <th>Alamat</th>
                                                                <th>Latitude</th>
                                                                <th>Longitude</th>
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
							<label for="id_role" class="col-form-label">Role:</label>
							<!-- <select class="form-control"  name="id_role" id="id_role" required></select> -->
							<select class="form-control" name="id_role" id="id_role" required="">
								<option selected="">Pilih</option>
								<!-- <option value="1">Superadmin</option> -->
								<option value="2">Administrator</option>
								<option value="3">User</option>
							</select>
						</div>
						<div class="mb-3">
							<label for="name" class="col-form-label">Nama:</label>
							<input type="text" name="name" class="form-control" id="name" required />
						</div>
						<div class="mb-3">
							<label for="email" class="col-form-label">Email:</label>
							<input type="email" name="email" class="form-control" id="email" required />
						</div>
						<div class="mb-3">
							<label for="password" class="col-form-label">Kata Sandi:</label>
							<input type="password" name="password" class="form-control" id="password" />
						</div>
						<br>
						<div class="form-check mb-3 centang">
							<input class="form-check-input" type="checkbox" value="1" id="change-password">
							<label class="form-check-label" for="change-password">
							  Centang untuk ubah kata sandi!
							</label>
						</div>
						<div class="mb-3">
							<label for="mobile_no" class="col-form-label">No Hp:</label>
							<input type="number" name="mobile_no" class="form-control" id="mobile_no" />
						</div>
						<div class="mb-3">
							<label for="address" class="col-form-label">Alamat:</label>
							<textarea class="form-control" name="address" id="address"></textarea>
						</div>
						<div class="mb-3">
						  <label for="image" class="form-label">Gambar Pengguna</label>
						  <input class="form-control form-control-sm" id="file" accept=".jpg, .png, .jpeg" type="file" onchange="preview_image()" />
						  <input type="hidden" name="image" id="imageBase64" />
						</div>
						<div class="mb-3"><img id="ads-img-thumbnail" src="" class="img-thumbnail mx-auto d-block" alt="..."></div>
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
					'url': `${baseUrlApi}/api/users/list`,
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
					{ "data": "users_name" },
					{ "data": null, "render": (row) => `<img src="${row.users_image}" class="rounded mx-auto d-block" alt="" style="width: 100px;" />` },
					{ "data": "roles_name" },
					{ "data": "users_email"  },
					{ "data": "users_mobile_no" },
					{ "data": "users_address"  },
					{ "data": "users_latitude" },
					{ "data": "users_longitude"  },
					{ "data": "users_created_at" },
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
			// await getRoles();
			$('.centang').hide();
			$("#modalForm").modal("show");
		});
		$(document).on("click", ".edit", function() {
			action = "edit";
			let id = $(this).attr("data-id");
			$("#id").val(id);
			getUser(id);
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

		async function getRoles(id_role="") {
			let headersList = {
				"Authorization": `Bearer ${apiKey}` 
			}
			
			let reqOptions = {
				url: `${baseUrlApi}/api/roles/`,
				method: "GET",
				headers: headersList,
			}
			
			let response = await axios.request(reqOptions);
			let data = response.data.data;
			let dom = ``;
			dom += `<option selected>Pilih</option>`;
			for (let i = 0; i < data.length; i++) {
				const element = data[i];
				dom += `<option value="${element.id}" ${id_role!=""?'selected':''}>${element.name}</option>`;
			}
			$("#id_role").html(dom);
		}

		async function getUser(id) {
			let config = {
			  method: 'get',
			  maxBodyLength: Infinity,
			  url: `${baseUrlApi}/api/users/${id}`,
			  headers: { 
				"Authorization": `Bearer ${apiKey}`
			  }
			};
			
			await axios.request(config)
			.then(async (response) => {
			  console.log(JSON.stringify(response.data));
			  let data = response.data.data;
			  $("#name").val(data.name);
			  $("#id_role").val(data.id_role).trigger("change");
			//   await getRoles(data.id_role);
			  $("#email").val(data.email);
			  $("#address").val(data.address);
			  $("#mobile_no").val(data.mobile_no);
			  $("#latitude").val(data.latitude);
			  $("#longitude").val(data.longitude);
			  $("#imageBase64").val(data.image);
			  $("#ads-img-thumbnail").attr("src", `${data.image}`);
			  $('.centang').show();
			})
			.catch((error) => {
			  console.log(error);
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
				  url: `${baseUrlApi}/api/users/delete/${id}`,
				  headers: { 
					"Authorization": `Bearer ${apiKey}` 
				  }
				};
				
				await axios.request(config)
				.then((response) => {
				  console.log(JSON.stringify(response.data));
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
				  console.log(error);
				  	swalFailed();
				});
			}
				

		}

		async function submitData() {
			let data = {
				"name": $("#name").val(),
				"image": $("#imageBase64").val(),
				"id_role": $("#id_role").val(),
				"email": $("#email").val(),
				"password": $("#password").val(),
				"address": $("#address").val(),
				"mobile_no": $("#mobile_no").val(),
				"latitude": $("#latitude").val(),
				"longitude": $("#longitude").val(),
			};
			if ($("#change-password").is(":checked")) {
				data.password = $("#password").val();
			}
			data = JSON.stringify(data);
			let isUrl = action == "add" ? `${baseUrlApi}/api/users/create` : `${baseUrlApi}/api/users/update/${$("#id").val()}`;
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
			  console.log(JSON.stringify(response.data));
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
			  console.log(error);
				swalFailed();
			});
		}


		function readFile() {
			if (!this.files || !this.files[0]) return;
			const FR = new FileReader();
			FR.addEventListener("load", function(evt) {
				document.querySelector("#ads-img-thumbnail").src = evt.target.result;
				document.querySelector("#imageBase64").value	 = evt.target.result;
			}); 
			FR.readAsDataURL(this.files[0]);
		}
		// document.querySelector("#file").addEventListener("change", readFile);

		async function preview_image() {
			const file = document.getElementById('file');
			const image = await process_image(file.files[0]);
			document.querySelector("#ads-img-thumbnail").src = image;
			document.querySelector("#imageBase64").value	 = image;
			// console.log(image)
		}

		async function reduce_image_file_size(base64Str, MAX_WIDTH = 450, MAX_HEIGHT = 450) {
			let resized_base64 = await new Promise((resolve) => {
				let img = new Image()
				img.src = base64Str
				img.onload = () => {
					let canvas = document.createElement('canvas')
					let width = img.width
					let height = img.height
		
					if (width > height) {
						if (width > MAX_WIDTH) {
							height *= MAX_WIDTH / width
							width = MAX_WIDTH
						}
					} else {
						if (height > MAX_HEIGHT) {
							width *= MAX_HEIGHT / height
							height = MAX_HEIGHT
						}
					}
					canvas.width = width
					canvas.height = height
					let ctx = canvas.getContext('2d')
					ctx.drawImage(img, 0, 0, width, height)
					resolve(canvas.toDataURL()) // this will return base64 image results after resize
				}
			});
			return resized_base64;
		}
		
		async function image_to_base64(file) {
			let result_base64 = await new Promise((resolve) => {
				let fileReader = new FileReader();
				fileReader.onload = (e) => resolve(fileReader.result);
				fileReader.onerror = (error) => {
					console.log(error)
					alert('An Error occurred please try again, File might be corrupt');
				};
				fileReader.readAsDataURL(file);
			});
			return result_base64;
		}
		
		async function process_image(file, min_image_size = 300) {
			const res = await image_to_base64(file);
			let dataBase64 = "";
			if (res) {
				const old_size = calc_image_size(res);
				if (old_size > min_image_size) {
					const resized = await reduce_image_file_size(res);
					const new_size = calc_image_size(resized)
					console.log('new_size=> ', new_size, 'KB');
					console.log('old_size=> ', old_size, 'KB');
					dataBase64 = resized;
				} else {
					console.log('image already small enough')
					dataBase64 = res;
				}
		
			} else {
				console.log('return err')
				dataBase64 = '';
			}
			return dataBase64;
		}
		
		function calc_image_size(image) {
			let y = 1;
			if (image.endsWith('==')) {
				y = 2
			}
			const x_size = (image.length * (3 / 4)) - y
			return Math.round(x_size / 1024)
		}
    </script>

	@include('layouts.scrolltop')
	@include('layouts.modal_template')
@include('layouts.footer')