$(document).ready(function () {
    var current_fs, next_fs, previous_fs; //fieldsets
    var opacity;
    var current = 1;
    var steps = $("fieldset").length;

    setProgressBar(current);

    $(".next").click(function () {
        current_fs = $(this).parent();
        next_fs = $(this).parent().next();

        //Add Class Active
        $("#progressbar li")
            .eq($("fieldset").index(next_fs))
            .addClass("active");

        //show the next fieldset
        next_fs.show();
        //hide the current fieldset with style
        current_fs.animate(
            { opacity: 0 },
            {
                step: function (now) {
                    // for making fielset appear animation
                    opacity = 1 - now;

                    current_fs.css({
                        display: "none",
                        position: "relative",
                    });
                    next_fs.css({ opacity: opacity });
                },
                duration: 500,
            }
        );
        setProgressBar(++current);

        // Memanggil fungsi displayPreviousInputs() saat langkah keempat ditampilkan
        if (current === 4) {
            displayPreviousInputs();
            
        }
    });

    $(".previous").click(function () {
        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();

        //Remove class active
        $("#progressbar li")
            .eq($("fieldset").index(current_fs))
            .removeClass("active");

        //show the previous fieldset
        previous_fs.show();

        //hide the current fieldset with style
        current_fs.animate(
            { opacity: 0 },
            {
                step: function (now) {
                    // for making fielset appear animation
                    opacity = 1 - now;

                    current_fs.css({
                        display: "none",
                        position: "relative",
                    });
                    previous_fs.css({ opacity: opacity });
                },
                duration: 500,
            }
        );
        setProgressBar(--current);
    });

    function setProgressBar(curStep) {
        var percent = parseFloat(100 / steps) * curStep;
        percent = percent.toFixed();
        $(".progress-bar").css("width", percent + "%");
    }

    document.querySelector('form').addEventListener('submit', function() {
        document.getElementById('').disabled = false;

    $("#prosesDaftar").submit(function () {
        // Panggil fungsi displayPreviousInputs() sebelum submit formulir
        displayPreviousInputs();
        // Lanjutkan proses submit formulir
        return true;
    });
});

function displayPreviousInputs() {
    // Menampilkan data inputan dari langkah-langkah sebelumnya di langkah terakhir
    document.getElementById("namaLengkap").textContent = $("input[name='nama']").val();
    document.getElementById("emailPelanggan").textContent = $("input[name='email']").val();
    document.getElementById("pekerjaanPelanggan").textContent = $("input[name='pekerjaan']").val();
    document.getElementById("no_identitasPelanggan").textContent = $("input[name='no_identitas']").val();
    document.getElementById("no_teleponPelanggan").textContent = $("input[name='no_telepon']").val();
    var selectedDukuh = $("#dukuh option:selected").text();
    document.getElementById("dukuhPelanggan").textContent = selectedDukuh !== "" ? selectedDukuh : "Belum dipilih";
    
    document.getElementById("rtPelanggan").textContent = $("input[name='rt']").val();
    document.getElementById("rwPelanggan").textContent = $("input[name='rw']").val();
    var selectedDesa = $("#desa option:selected").text();
    document.getElementById("desaPelanggan").textContent = selectedDesa !== "" ? selectedDesa : "Belum dipilih";
    var selectedKecamatan = $("#kecamatan option:selected").text();
    document.getElementById("kecamatanPelanggan").textContent = selectedKecamatan !== "" ? selectedKecamatan : "Belum dipilih";
    var selectedUnit = $("#nm_unit option:selected").text();
    document.getElementById("unitPelanggan").textContent = selectedUnit !== "" ? selectedUnit : "Belum dipilih";
    document.getElementById("jalanPelanggan").textContent = $("input[name='nama_jalan']").val();
    document.getElementById("jumlahPenghuni").textContent = $("input[name='jmlh_penghuni']").val();
    document.getElementById("posPelanggan").textContent = $("input[name='kode_pos']").val();
    document.getElementById("keteranganPelanggan").textContent = $("input[name='no_sambungan']").val() + " / " + $("input[name='nm_sambungan']").val();


    const IdentitasInput = $("input[name='foto_identitas']")[0];
    if (IdentitasInput.files && IdentitasInput.files[0]) {
        const reader = new FileReader();
        reader.onload = function (e) {
            $('#uploadedIdentitas').attr('src', e.target.result);
        }
        reader.readAsDataURL(IdentitasInput.files[0]);
    }
    const logoInput = $("input[name='foto_rumah']")[0];
    if (logoInput.files && logoInput.files[0]) {
        const reader = new FileReader();
        reader.onload = function (e) {
            $('#uploadedRumah').attr('src', e.target.result);
        }
        reader.readAsDataURL(logoInput.files[0]);
    }
}

document.getElementById('checkbox').addEventListener('change', function() {
    var formFields = document.getElementById('formFields');
    if (this.checked) {
        formFields.style.display = 'block';
    } else {
        formFields.style.display = 'none';
    }
});

});