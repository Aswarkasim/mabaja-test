const flashdata = $('.flash-data').data('flashdata');

if (flashdata) {
    Swal({
        title: 'Data',
        text: flashdata,
        type: 'success'
    })
}

const flashdata_error = $('.flashdata-error').data('flashdata');

if (flashdata_error) {
    Swal({
        title: 'Peringatan !',
        text: flashdata_error,
        type: 'warning'
    })
}


// Tommbol hapus
$('.tombol-hapus').on('click', function (e) {
    // Mematikan href
    e.preventDefault();
    const href = $(this).attr('href');

    Swal({
        title: 'Apakah anda yakin ingin menghapus?',
        text: "data akan dihapus",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus Data!'
    }).then((result) => {
        if (result.value) {
            document.location.href = href;
        }
    })
})


$('.hapus-foto').on('click', function (e) {
    // Mematikan href
    e.preventDefault();
    const href = $(this).attr('href');

    Swal({
        title: 'Apakah anda yakin ingin menghapus foto?',
        text: "foto akan dihapus",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus foto!'
    }).then((result) => {
        if (result.value) {
            document.location.href = href;
        }
    })
})


// Tommbol Logout
$('.tombol-logout').on('click', function (e) {
    // Mematikan href
    e.preventDefault();
    const href = $(this).attr('href');

    Swal({
        title: 'Apakah anda yakin ingin keluar?',
        // text: "data akan dihapus",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#2c007e',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Keluar',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.value) {
            document.location.href = href;
        }
    })
})