$(function() {

	$(document).ready(function() {
		$(".datatables").DataTable();

		$(function() {
			$('[data-toggle="tooltip"]').tooltip();
		});

		$(".modal").on('shown.bs.modal', function() {
			$(".modal form").find('input:eq(1)').focus()
		});
	})

	// AJAX Video Upload
	$('#video-upload').fileupload({
		dataType: 'json',
		add: function (e, data) {
			$("#upload-video-label").text(data.files[0].name)
			$("#container-upload-btn").html('')
			data.context = $('<a href="javascript:void(0)" class="btn btn-warning" id="upload-video-btn"><i class="fas fa-upload mr-2"></i>Upload</a>').appendTo($('#container-upload-btn')).click(function() {
				const acceptedFileTypes = /ogm|wmv|mpg|webm|ogv|mov|asx|mpeg|mp4|m4v|avi/i;
				var fileType = data.files[0].type
				if (!fileType.match(acceptedFileTypes)) {
					alert('Format file salah, file yang didukung: ogm, wmv, mpg, webm, ogv, mov, asx, mpeg, mp4, m4v, avi.')
				} else if (data.files[0].size > 52428800) {
					alert('File terlalu besar, ukuran maksimum 50MB')
				} else if (data.files[0].type) {

				} else {
					if (confirm('Anda yakin ingin mengupload file ini?')) {
						data.submit()
						$(".progress").removeClass('d-none')
					}
				}
			})
		},
		progressall: function (e, data) {
			var progress = parseInt(data.loaded / data.total * 100, 10)
			$(".progress-bar").css('width', progress + '%')
		},
		done: function (e, data) {
			if (data.result.status == 'success') {
				$(".progress").addClass('d-none')
				$(".alert-success").removeClass('d-none')
			}
		},
		fail: function (e, data) {
			console.log(data.errorThrown)
		}
	});
})