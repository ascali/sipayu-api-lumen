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
                                                                <th>name</th>
                                                                <th>type of interests name</th>
                                                                <th>image</th>
                                                                <th>contact</th>
                                                                <th>description</th>
                                                                <th>location</th>
                                                                <th>latitude</th>
                                                                <th>longitude</th>
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
			<div class="modal-dialog modal-lg modal-dialog-scrollable">
				<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modalFormLabel">Form {{ $title }}</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
						<input type="hidden" name="id" id="id" />
						<div class="row">
							<div class="col-md-4 mb-3">
								<label for="id_toi" class="col-form-label">Type of Interest (Menu):</label>
								<select class="form-control"  name="id_toi" id="id_toi" required></select>
							</div>
							<div class="col-md-4 mb-3">
								<label for="name" class="col-form-label">Nama:</label>
								<input type="text" name="name" class="form-control" id="name" required />
							</div>
							<div class="col-md-4 mb-3">
								<label for="contact" class="col-form-label">Kontak:</label>
								<input type="text" name="name" class="form-control" id="contact" required />
								<label for="contact"><small>Anda dapat mengisi no hp atau alamat email</small></label>
							</div>
							<div class="col-md-6 mb-3">
								<label for="description" class="col-form-label">Description:</label>
								<textarea class="form-control" name="description" id="description"></textarea>
							</div>
							<div class="col-md-6 mb-3">
								<label for="location" class="col-form-label">Alamat Lokasi:</label>
								<textarea class="form-control" name="location" id="location"></textarea>
							</div>
							<div class="col-md-6 mb-3">
								<label for="latitude" class="col-form-label">Latitude:</label>
								<input type="text" name="latitude" class="form-control" id="latitude" />
							</div>
							<div class="col-md-6 mb-3">
								<label for="longitude" class="col-form-label">Longitude:</label>
								<input type="text" name="longitude" class="form-control" id="longitude" />
							</div>
						</div>
						<div class="mb-3">
						  <label for="image" class="form-label">Gambar Lokasi</label>
						  <input class="form-control form-control-sm" id="file" accept=".jpg, .png, .jpeg" multiple type="file" onchange="preview_image()" />
						  <input type="hidden" name="image" id="imageBase64" />
						</div>
						<div class="mb-3 row" id="allImages"><img id="ads-img-thumbnail" src="" class="img-thumbnail mx-auto d-block" alt="..."></div>
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
		var multipleImages = [];
        $(document).ready(function() {
			$( "#allImages" ).sortable();
			$( "#allImages" ).disableSelection();

			oTable = $('#datatable_sipayu').DataTable( {
				'ajax': {
					'url': `${baseUrlApi}/api/destination/list_dt`,
					'type': 'GET',
					'beforeSend': function (request) {
						request.setRequestHeader("Accept", `*/*`);
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
					{ "data": "type_of_interests_name" },
					{ "data": null, "render": (row) => `<img src="${row.image}" class="rounded mx-auto d-block" alt="" style="width: 100px;" />` },
					{ "data": "contact"  },
					{ "data": "description" },
					{ "data": "location"  },
					{ "data": "latitude"  },
					{ "data": "longitude"  },
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
		$(document).on("keyup", ".search-input", function() {
			oTable.search($(this).val()).draw() ;
		});
		$(document).on("click", ".sipayu_modal", async function() {
			action = "add";
			await getToI("");
			$("#allImages").html('');
			$("#ads-img-thumbnail").attr("src", "");
			$("#modalForm").modal("show");
		});
		$(document).on("click", ".edit", async function() {
			action = "edit";
			let id = $(this).attr("data-id");
			$("#id").val(id);
			await getData(id);
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
		});

		async function getToI(id_toi="") {
			let headersList = {
				"Authorization": `Bearer ${apiKey}` 
			}
			
			let reqOptions = {
				url: `${baseUrlApi}/api/type_of_interest/list`,
				method: "GET",
				headers: headersList,
			}
			
			let response = await axios.request(reqOptions);
			let data = response.data.data;
			let dom = ``;
			dom += `<option selected>Pilih</option>`;
			for (let i = 0; i < data.length; i++) {
				const element = data[i];
				dom += `<option value="${element.id}" ${id_toi!=""?'selected':''}>${element.name}</option>`;
			}
			$("#id_toi").html(dom);
		}

		async function getData(id) {
			let config = {
			  method: 'get',
			  maxBodyLength: Infinity,
			  url: `${baseUrlApi}/api/destination/${id}`,
			  headers: { 
				"Authorization": `Bearer ${apiKey}`
			  }
			};
			
			await axios.request(config)
			.then(async (response) => {
			//   console.log(JSON.stringify(response.data));
			  let data = response.data.data;
			  $("#name").val(data.name);
			  await getToI(data.id_toi);
			  $("#id_toi").val(data.id_toi).trigger("change");
			  $("#contact").val(data.contact);

			  $("#allImages").html('');
			  let image = isJsonString(data.image);
			  if (image != false) {
				  image = JSON.parse(data.image);
				  console.log("🚀 ~ .then ~ imagesss:", image)
				  
				  let images = '';
				  for (let i = 0; i < image.length; i++) {
					  const element = image[i];
					  if (element != "") {
						  images += `<div class="col-md-4">
							  <img id="ads-img-thumbnail" src="${element}" class="img-thumbnail mx-auto d-block" alt="...">
						  </div>`;
					  }
				  }
				  $("#allImages").html(images);

				} else {
					$("#imageBase64").val(data.image);
					// $("#ads-img-thumbnail").attr("src", `${data.image}`);
					$("#allImages").html(`<img id="ads-img-thumbnail" src="${data.image}" class="img-thumbnail mx-auto d-block" alt="...">`);
				}
			  
			  $("#location").val(data.location);
			  $("#description").val(data.description);
			  $("#latitude").val(data.latitude);
			  $("#longitude").val(data.longitude);
			})
			.catch((error) => {
			  console.log(error);
			  swalFailed();
			});

		}

		function isJsonString(str) {
			try {
				JSON.parse(str);
			} catch (e) {
				return false;
			}
			return true;
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
				  url: `${baseUrlApi}/api/destination/delete/${id}`,
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
			if ($("#imageBase64").val()!='' || multipleImages.length > 1) {
				let data = {
				  "name": $("#name").val(),
				  "id_toi": $("#id_toi").val(),
				  "image": multipleImages.length == 1 ? $("#imageBase64").val() : JSON.stringify(multipleImages.filter(val => val != '')),
				  "contact": $("#contact").val(),
				  "description": $("#description").val(),
				  "location": $("#location").val(),
				  "latitude": $("#latitude").val(),
				  "longitude": $("#longitude").val(),
				};
				data = JSON.stringify(data);
				let isUrl = action == "add" ? `${baseUrlApi}/api/destination/create` : `${baseUrlApi}/api/destination/update/${$("#id").val()}`;
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
					setTimeout(async () => {
						await $('form').trigger("reset");
					}, 1000);
					$("#modalForm").modal("hide");
				})
				.catch((error) => {
				  console.log(error);
					swalFailed();
				});
			} else {
				await swalWithBootstrapButtons.fire({
					title: "Galat!",
					text: "File Gambar harus di isi!",
					icon: "error"
				});
			}
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
			$("#allImages").html('Loading.. | Sedang mempersiapkan gambar!');
			const file = document.getElementById('file');
			// console.log(file.files)
			const jumlahImage = Object.keys(file.files).length;
			if (jumlahImage > 1) {
				multipleImages = [];
				for (const key in file.files) {
					if (file.files[key] != "") {
						let imageBase64 = await process_image(file.files[key]);
						multipleImages.push(imageBase64);
					}
				}

				// console.log(multipleImages)
				let images = '';
				for (let i = 0; i < multipleImages.length; i++) {
					const element = multipleImages[i];
					if (element != "") {
						images += `<div class="col-md-4">
							<img id="ads-img-thumbnail" src="${element}" class="img-thumbnail mx-auto d-block" alt="...">
						</div>`;
					}
				}
				$("#allImages").html(images);

			} else {
				const image = await process_image(file.files[0]);
				// document.querySelector("#ads-img-thumbnail").src = image;
				document.querySelector("#imageBase64").value	 = image;
				$("#allImages").html(`<img id="ads-img-thumbnail" src="${image}" class="img-thumbnail mx-auto d-block" alt="...">`);
			}
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
		
		// async function image_to_base64(file) {
		// 	let result_base64 = await new Promise((resolve) => {
		// 		let fileReader = new FileReader();
		// 		fileReader.onload = (e) => resolve(fileReader.result);
		// 		fileReader.onerror = (error) => {
		// 			console.log(error)
		// 			alert('An Error occurred please try again, File might be corrupt');
		// 		};
		// 		fileReader.readAsDataURL(file);
		// 	});
		// 	return result_base64;
		// }

		// async function image_to_base64(file) {
		// 	if (!file || !(file instanceof Blob)) {
		// 	  throw new Error("Invalid file provided. Please select an image file.");
		// 	}
		  
		// 	let result_base64 = await new Promise((resolve, reject) => {
		// 	  let fileReader = new FileReader();
		// 	  fileReader.onload = (e) => resolve(e.target.result);
		// 	  fileReader.onerror = (error) => reject(error);
		// 	  fileReader.readAsDataURL(file);
		// 	});
		// 	return result_base64;
		// }

		async function imageToBase64(file) {
			if (!file || !(file instanceof Blob)) {
				throw new Error('Invalid file provided. Please select an image file.');
			}

			return new Promise((resolve, reject) => {
				const fileReader = new FileReader();
				fileReader.onload = (event) => resolve(event.target.result);
				fileReader.onerror = (error) => reject(error);
				fileReader.readAsDataURL(file);
			});
		}
		
		async function process_image(file, min_image_size = 300) {
			return imageToBase64(file)
				.then(async (base64String) => {
					// console.log('Base64:', base64String);
					// Gunakan base64String untuk menampilkan atau memproses gambar
					let dataBase64 = "";
					const old_size = calc_image_size(base64String);
					if (old_size > min_image_size) {
						const resized = await reduce_image_file_size(base64String);
						const new_size = calc_image_size(resized);
						dataBase64 = resized;
					} else {
						dataBase64 = base64String;
					}
					return dataBase64;

				})
				.catch((error) => {
					// console.error('Error:', error);
					return '';
				});
				
		}
		
		// async function process_image(file, min_image_size = 300) {
		// 	const res = await image_to_base64(file);
		// 	let dataBase64 = "";
		// 	if (res) {
		// 		const old_size = calc_image_size(res);
		// 		if (old_size > min_image_size) {
		// 			const resized = await reduce_image_file_size(res);
		// 			const new_size = calc_image_size(resized)
		// 			// console.log('new_size=> ', new_size, 'KB');
		// 			// console.log('old_size=> ', old_size, 'KB');
		// 			dataBase64 = resized;
		// 		} else {
		// 			// console.log('image already small enough')
		// 			dataBase64 = res;
		// 		}
		// 	} else {
		// 		console.log('return err')
		// 		dataBase64 = '';
		// 	}
		// 	return dataBase64;
		// }
		
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