$(document).ready(function () {
    $('.select2').select2({
        theme: 'bootstrap4',
    });
    // swal confirm
    $('.btn-del').on('submit', function (e) {
        let url = $(this).attr('action')
        e.preventDefault();
        Swal.fire({
            title: 'Anda yakin ingin menghapus data ini??',
            text: "Data akan terhapus secara permanen!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'delete',
                    url: url,
                    data: $(this).serialize(),
                    success: function (data) {
                        document.location.href = data;
                    }
                })
            }
        });
    });


    $('.btn-logout').on('click', function (e) {
        let url = $(this).attr('href')
        e.preventDefault();
        Swal.fire({
            title: 'Apakah anda yakin ingin keluar?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.value) {
                document.location.href = url;
            }
        });
    });

    $('.btn-passs').on('click', function (e) {
        console.log('ok')
        // let url = $(this).data('url')
        // let text = $(this).data('original-title')
        e.preventDefault();
        // Swal.fire({
        //     title: 'Are you sure?',
        //     text: "You won't be able to revert this!",
        //     type: 'warning',
        //     showCancelButton: true,
        //     confirmButtonColor: '#3085d6',
        //     cancelButtonColor: '#d33',
        //     confirmButtonText: text
        // }).then((result) => {
        //     if (result.value) {
        //         $.ajax({
        //             type: 'get',
        //             url: url,
        //             data: $(this).serialize(),
        //             success: function (data) {
        //                 document.location.href = data;
        //             }
        //         })
        //     }
        // });
    });

    $('.detail-bukti').on('click', function () {
        let gambar = $(this).data('image')

        $('#datagambar').attr('src', gambar)
    });
    $('#showpass').hide()
    $('#password1').on('keyup', function () {
        $p1 = $(this).val();
        $p = $('#password').val();

        if ($p1 != $p) {
            $('#save').attr('disabled', true)
            $('#showpass').show()
        } else {
            $('#showpass').hide()
            $('#save').attr('disabled', false)
        }
    })
    // swal confirm
    $('.kon').on('submit', function (e) {
        let url = $(this).attr('action')
        let valss = $(this).data('jenis')
        let text = $(this).data('original-title')
        var title = 'Kamu yakin ingin merubah data ini?'
        var data = $(this).serializeArray();

        if (valss == 'tolak') {
            title = 'Kamu yakin ingin merubah data ini?, <br/> <br/> silahkan isi pesan revisi'
        }


        e.preventDefault();
        Swal.fire({
            title: title,
            input: valss == 'tolak' ? 'text' : false,
            inputAttributes: {
                autocapitalize: 'off'
            },
            type: 'warning',
            showCancelButton: true,
            showLoaderOnConfirm: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: text
        }).then((result) => {
            if (result.value) {
                if (valss == 'tolak')
                    data.push({ name: "pesan", value: result.value });
                // console.log(data)
                $.ajax({
                    type: 'put',
                    url: url,
                    data: data,
                    success: function (data) {
                        document.location.href = data;
                    }
                })
            }
        });
    });


    // 
    // flash-data
    // const flashData = $('.flash-data').data('flashdata');
    // if (flashData) {
    //     let content = {};
    //     content.message = flashData;
    //     content.title = 'Sukses :';
    //     content.icon = "fa fa-check";
    //     $.notify(content, {
    //         type: 'primary',
    //         placement: {
    //             from: 'top',
    //             align: 'center'
    //         },
    //         time: 1000,
    //         delay: 0,
    //     });
    // }

    // crud siswa
    $('.btnSiswaModal').on('click', function () {
        let url = $(this).data('url')
        let id = $(this).data('id')
        let action = $(this).data('action')

        if (action == 'add') {
            $('#nis').prop("readonly", false)
            $('#nis').val('')
            $('#nama').val('')
            $('#kelas').val('');
            $('.siswa-form').attr('id', 'siswaForm')
            $('#siswaForm').attr('action', '/siswa')
            $('#siswaModalMethod').html('')
            $('#siswaModalTitle').html('Tambah Siswa')
        } else {
            $.get(url, function (data) {
                data = JSON.parse(data)
                let jk = data.jk
                if (jk == 'l') {
                    $('#jkl').prop("checked", true)
                } else {
                    $('#jkp').prop("checked", true)
                }

                $('#nis').prop("readonly", true)
                $('#nis').val(data.nis)
                $('#nama').val(data.nama)
                $('#kelas').val(data.kelas_id);
            })
            $('.siswa-form').attr('id', 'siswaEditForm')
            $('#siswaEditForm').attr('action', '/siswa/' + id + '/update')
            $('#siswaModalMethod').html($(this).data('method'))
            $('#siswaModalTitle').html('Edit Siswa')
        }
        $('#exampleModalCenter').modal('show')
    })

    // $('#rfid-page').children().off('click');
    // $('#no_kartu_auto').focus();

    // $('#rfid-page').click(function (e) {
    //     e.preventDefault();
    // });

    $('.btnGuruModal').on('click', function () {
        let url = $(this).data('url')
        let id = $(this).data('id')
        let action = $(this).data('action')

        if (action == 'add') {
            $('#nip').prop("readonly", false)
            $('#nip').val('')
            $('#nama').val('')
            $('.guru-form').attr('id', 'guruForm')
            $('#guruForm').attr('action', '/guru')
            $('#guruModalMethod').html('')
            $('#guruModalTitle').html('Tambah Guru')
        } else {
            $.get(url, function (data) {
                data = JSON.parse(data)
                $('#nip').prop("readonly", true)
                $('#nip').val(data.nip)
                $('#nama').val(data.nama)
            })
            $('.guru-form').attr('id', 'guruEditForm')
            $('#guruEditForm').attr('action', '/guru/' + id + '/update')
            $('#guruModalMethod').html($(this).data('method'))
            $('#guruModalTitle').html('Edit Guru')
        }
        $('#exampleModalCenter').modal('show')
    })

    // crud admin
    $('.btnAdminModal').on('click', function () {
        let url = $(this).data('url')
        let id = $(this).data('id')
        let action = $(this).data('action')

        if (action == 'add') {
            $('#nama').val('')
            $('#username').val('')
            $('#no_kartu').val('')
            $('#email').val('')
            $('#adminForm').attr('action', '/admin')
            $('#password1').attr('required', true)
            $('#password').attr('required', true)
            $('#showpassedit').hide()
            $('#adminModalMethod').html('')
            $('#username').prop("readonly", false)
              $('#adminModalTitle').html('Tambah user')
        } else {
            $.get(url, function (data) {
                $('#nama').val(data.name)
                $('#username').val(data.username)
                $('#email').val(data.email)
                $('#role').val(data.role)
                $('#no_kartu').val(data.no_kartu)
            })
            $('#adminForm').attr('action', '/admin/' + id + '/update')
            $('#adminModalMethod').html($(this).data('method'))
            $('#showpassedit').show()
            $('#password1').attr('required', false)
            $('#password').attr('required', false)
            $('#username').prop("readonly", true)
            $('#adminModalTitle').html('Edit user')
        }
        $('#exampleModalCenter').modal('show')
    })

    // udit user
    $('.btnEditUser').on('click', function () {
        let url = $(this).data('url')
        $.get(url, function (data) {
            $('#nama').val(data.name)
            $('#username').val(data.username)
        })
        $('#editModalUser').modal('show')
    })
    $('.btnAbsenDetailModal').on('click', function () {
        let url = $(this).data('url')
        let kelas = $(this).data('kelas')
        $('#kelasName').text(kelas)
        $.get(url, function (data) {
            console.log(data)
            var html = '';
            for (x in data) {
                html += `
                    <tr>
                        <td>${data[x].nis}</td>
                        <td>${data[x].nama}</td>
                        <td>${data[x].tagihan_id == null ? '<p class="text-danger">Belum Bayar</p>' : 'Sudah Bayar'}</td>
                    </tr>
                `
            }
            $('#detailBodys').html(html)
        })
        $('#DetailModal').modal('show')
    })
    $('#no_kartu_auto').on('input', function (e) {
        var val = $('#no_kartu_auto').val();
        if (val.length >= 11) {
            $(this).val("")
        }
        // $("#no_kartu_auto").on("keydown", false);
        console.log(val);
    })
    
    

    // crud kelas
    $(document).on('click', '.btnKelasModal', function () {
        let url = $(this).data('url')
        let id = $(this).data('id')
        let action = $(this).data('action')

        if (action == 'add') {
            $('#kelas').val('')
            $('#guru_id').val('')
            $('#kelasForm').attr('action', '/kelas')
            $('#kelasModalMethod').html('')
            $('#kelasModalTitle').html('Tambah Kelas')
        } else {
            $.get(url, function (data) {
                $('#kelas').val(data.namaKelas)
                $('#guru_id').val(data.guru_id)
            })
            $('#kelasForm').attr('action', '/kelas/' + id + '/update')
            $('#kelasModalMethod').html($(this).data('method'))
            $('#kelasModalTitle').html('Edit Kelas')
        }
        $('#exampleModalCenter').modal('show')
    })

    // crud Mapel
    $(document).on('click', '.btnMapelModal', function () {
        let url = $(this).data('url')
        let id = $(this).data('id')
        let action = $(this).data('action')

        if (action == 'add') {
            $('#namamapel').val('')
            $('#jumlahjam').val('')
            $('#mapelForm').attr('action', '/matapelajaran')
            $('#mapelModalMethod').html('')
            $('#mapelModalTitle').html('Tambah Mata Pelajaran')
        } else {
            $.get(url, function (data) {
                $('#namamapel').val(data.namamapel)
                $('#jumlahjam').val(data.jumlahjam)
            })
            $('#mapelForm').attr('action', '/matapelajaran/' + id + '/update')
            $('#mapelModalMethod').html($(this).data('method'))
            $('#mapelModalTitle').html('Edit Mata Pelajaran')
        }
        $('#exampleModalCenter').modal('show')
    })

    // crud Jadwal
    $(document).on('click', '.btnJadwalModal', function () {
        let url = $(this).data('url')
        let id = $(this).data('id')
        let action = $(this).data('action')

        if (action == 'add') {
            $('#jam').val('')
            $('#hari').val('')
            $('#semester').val('')
            $('#guru_id').val('')
            $('#kelas_id').val('')
            $('#mata_pelajaran_id').val('')
            $('#tahun_ajaran').val('')
            $('#jadwalForm').attr('action', '/jadwal')
            $('#jadwalModalMethod').html('')
            $('#jadwalModalTitle').html('Tambah Jadwal')
        } else {
            $.get(url, function (data) {
                $('#jam').val(data.jam)
                $('#hari').val(data.hari)
                $('#semester').val(data.semester)
                $('#guru_id').val(data.guru_id)
                $('#kelas_id').val(data.kelas_id)
                $('#mata_pelajaran_id').val(data.mata_pelajaran_id)
                $('#tahun_ajaran').val(data.tahun_ajaran)
            })
            $('#jadwalForm').attr('action', '/jadwal/' + id + '/update')
            $('#jadwalModalMethod').html($(this).data('method'))
            $('#jadwalModalTitle').html('Edit jadwal')
        }
        $('#exampleModalCenter').modal('show')
    })

    // crud Absen
    $(document).on('click', '.btnAbsenTambahSiswaModal', function () {
        let url = $(this).data('url')
        let id = $(this).data('id')
        let nama = $(this).data('nama')
        $('#absen_id').val(id);
       

        editData2(url, id, nama,'#detailBody','#TambahSiswaModal')
    })
    $(document).on('click', '.btnAbsenEditSiswaModal', function () {
        let url = $(this).data('url')
        let id = $(this).data('id')
        let nama = $(this).data('nama')
        $('#absen_id2').val(id);

        editData2(url, id, nama,'.detailBody','#EditModal')
    })
    $(document).on('click', '.btnAbsenEditModal', function () {
        let url = $(this).data('url')
        let id = $(this).data('id')
        let nama = $(this).data('nama')
       

        editData(url, id, nama,'#dataBody','#EditModal')
    })
    $(document).on('change', '#kelas', function () {
        let id = $(this).val()
        $.get(`/siswa/${id}/kelas`, function (data) {
            console.log(data)
            var html = '';

            for (x in data) {
                var num = +x + 1;
                html += `
                     <tr>
                        <td>${num}</td>
                        <td><input type="hidden" name="id[]" value="${data[x].id}">${data[x].nis}</td>
                        <td>${data[x].nama}</td>
                        <td>
                            <select class="form-control" name="keterangan[]" id="keterangan[]" required>
                                <option value="Hadir" selected>Hadir</option>
                                <option value="Sakit">Sakit</option>
                                <option value="Izin">Izin</option>
                                <option value="Alfa">Alfa</option>
                                <option value="Terlambat">Terlambat</option>
                            </select>
                        </td>
                        <td><input type="text" name="kasus[]" class="form-control" placeholder="Input Kasus"></td>
                        <td><input type="text" name="tindakan[]" class="form-control" placeholder="Input Tindakan"></td>
                    </tr>
                `
            }
            $('#tambahBody').html(html)
        })
    })
    $(document).on('click', '.btnAbsenDetailModal', function () {
        let url = $(this).data('url')
        let id = $(this).data('id')
        let nama = $(this).data('nama')
        $('#detailID').text(id)
        $('#detailNama').text(nama)
        $.get(url, function (data) {

            var html = '';

            for (x in data) {
                html += `
                    <tr>
                        <td>${data[x].tgl_absen}</td>
                        <td>${data[x].keterangan}</td>
                        <td>${data[x].kasus == null ? '-' : data[x].kasus}</td>
                        <td>${data[x].tindakan == null ? '-' : data[x].tindakan}</td>
                    </tr>
                `
            }
            $('#detailBody').html(html)
        })
        $('#DetailModal').modal('show')
    })

    $(document).on('click', '.btnAbsenDetailSiswaModal', function () {
        let url = $(this).data('url')
        let id = $(this).data('id')
        let nama = $(this).data('nama')
        $('#detailID').text(id)
        $('#detailNama').text(nama)
        $.get(url, function (data) {

            var html = '';

            for (x in data) {
                html += `
                    <tr>
                        <td>${data[x].nis}</td>
                        <td>${data[x].nama}</td>
                        <td>${data[x].namaKelas}</td>
                        <td>${data[x].keterangan}</td>
                        <td>${data[x].kasus == null ? '-' : data[x].kasus}</td>
                        <td>${data[x].tindakan == null ? '-' : data[x].tindakan}</td>
                    </tr>
                `
            }
            $('#detailBody').html(html)
        })
        $('#DetailModal').modal('show')
    })

    function editData(url, id, nama,body,modal) {
        $('#editID').text(id)
        $('#editNama').text(nama)
        $.get(url, function (data) {

            var html = '';

            for (x in data) {
                html += `
                    <tr>
                        <td><input type="hidden" name="id[]" value="${data[x].id}">${data[x].tgl_absen}</td>
                        <td>
                            <select class="form-control" name="keterangan[]" id="keterangan[]" required>
                                <option value="Hadir" ${data[x].keterangan == "Hadir" ? "selected" : ''}>Hadir</option>
                                <option value="Sakit" ${data[x].keterangan == "Sakit" ? "selected" : ''}>Sakit</option>
                                <option value="Izin" ${data[x].keterangan == "Izin" ? "selected" : ''}>Izin</option>
                                <option value="Alfa" ${data[x].keterangan == "Alfa" ? "selected" : ''}>Alfa</option>
                                <option value="Terlambat" ${data[x].keterangan == "Terlambat" ? "selected" : ''}>Terlambat</option>
                            </select>
                        </td>
                        <td><input type="text" class="form-control" name="kasus[]" ${data[x].kasus == null ? null : 'value="' + data[x].kasus + '"' }></td>
                        <td><input type="text" class="form-control" name="tindakan[]" ${data[x].tindakan == null ? null : 'value="' + data[x].tindakan + '"' }></td>
                    </tr>
                `
            }
            $(body).html(html)
        })
        $(modal).modal('show')
    }
    function editData2(url, id, nama,body,modal) {
        $('#editID').text(id)
        $('#editNama').text(nama)
        $.get(url, function (data) {

            var html = '';

            for (x in data) {
                html += `
                    <tr>
                        <td><input type="hidden" name="id[]" value="${data[x].id}">${data[x].id}</td>
                        <td>${data[x].nama}</td>
                        <td>${data[x].namaKelas}</td>
                        <td>
                            <select class="form-control" name="keterangan[]" id="keterangan[]" required>
                                <option value="Hadir" ${data[x].keterangan == "Hadir" ? "selected" : ''}>Hadir</option>
                                <option value="Sakit" ${data[x].keterangan == "Sakit" ? "selected" : ''}>Sakit</option>
                                <option value="Izin" ${data[x].keterangan == "Izin" ? "selected" : ''}>Izin</option>
                                <option value="Alfa" ${data[x].keterangan == "Alfa" ? "selected" : ''}>Alfa</option>
                                <option value="Terlambat" ${data[x].keterangan == "Terlambat" ? "selected" : ''}>Terlambat</option>
                            </select>
                        </td>
                        <td><input type="text" class="form-control" name="kasus[]" ${data[x].kasus == null ? null : 'value="' + data[x].kasus + '"' }></td>
                        <td><input type="text" class="form-control" name="tindakan[]" ${data[x].tindakan == null ? null : 'value="' + data[x].tindakan + '"' }></td>
                    </tr>
                `
            }
            $(body).html(html)
        })
        $(modal).modal('show')
    }

    $('.basic-datatables').DataTable();
   
})
