const toastMessage = document.body.dataset.toastSuccess;

if (toastMessage) {
    Swal.fire({
        toast: true,
        position: "top-end",
        icon: "success",
        title: toastMessage,
        showConfirmButton: false,
        timer: 2200,
        timerProgressBar: true,
    });
}
