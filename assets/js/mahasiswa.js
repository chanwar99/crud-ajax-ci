$(document).ready(function () {
	var baseUrl = $("#baseUrl").val();
	var modalForm = $("#modalForm");
	var modalConfirm = $("#modalConfirm");
	var formSubmit = $("#formMahasiswa");
	var tableBody = $("#tableLoadMahasiswa");
	var tableLoading = '<tr class="fa-3x"><td colspan="5" class="text-center"><i class="fas fa-spinner fa-spin"></i></td></tr>';
	var tableNotfound = '<tr><td colspan="5" class="text-center"><p>Row Not Found!</p></td></tr>';

	var errorReset = () => {
		$("#npmError").html("");
		$("#namaError").html("");
		$("#jurusanError").html("");
	}

	var inTableMahasiswa = () => {
		$(".btnUpdate").on("click", function () {
			modalForm.modal();
			modalForm.find(".modal-title").text("Update");
			formSubmit[0].reset();
			errorReset();
		});

		$(".btnDelete").on("click", function () {
			modalConfirm.modal();
			modalConfirm.find(".modal-title").text("Delete");
		});
	}

	var readMahasiswa = () => {
		tableBody.html(tableLoading);
		$.ajax({
			url: baseUrl + "mahasiswa/read",
			type: "POST",
			data: {},
			dataType: 'JSON',
			success: function (response) {
				if (response.data) {
					tableBody.hide().html(response.html).fadeIn("slow");
					inTableMahasiswa();
				} else {
					tableBody.hide().html(tableNotfound).fadeIn("slow");
				}
			}
		});
	}

	var insertMahasiswa = (form) => {
		$.ajax({
			url: baseUrl + "mahasiswa/create",
			type: "POST",
			data: form.serialize(),
			dataType: 'JSON',
			success: function (response) {
				if (response.data) {
					modalForm.modal("hide");
					readMahasiswa();
				}

				if (response.error) {
					$("#npmError").html(response.npmError);
					$("#namaError").html(response.namaError);
					$("#jurusanError").html(response.jurusanError);
				}
			}
		});
	}

	$(".btnCreate").on("click", function () {
		modalForm.modal();
		modalForm.find(".modal-title").text("Create");
		formSubmit[0].reset();
		errorReset();
	});

	$(".btnRead").on("click", function () {
		readMahasiswa();
	});

	readMahasiswa();

	$(formSubmit).on("submit", function (e) {
		e.preventDefault();
		insertMahasiswa($(this));
	});
});
