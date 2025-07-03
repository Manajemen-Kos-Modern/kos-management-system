document.addEventListener("DOMContentLoaded", function () {
    const fileInput = document.getElementById("bukti_transfer");
    const fileName = document.getElementById("file-name");
    if (fileInput && fileName) {
        fileInput.addEventListener("change", function (e) {
            fileName.textContent =
                e.target.files[0]?.name || "Belum ada file dipilih";
        });
    }

    // Salin jumlah harga
    const salinJumlahBtn = document.getElementById("salin-jumlah");
    if (salinJumlahBtn) {
        salinJumlahBtn.addEventListener("click", function () {
            const jumlah = this.getAttribute("data-jumlah");
            navigator.clipboard.writeText(jumlah);
        });
    }

    // Salin no rekening
    const salinRekBtn = document.getElementById("salin-rekening");
    if (salinRekBtn) {
        salinRekBtn.addEventListener("click", function () {
            const norek = this.getAttribute("data-norek");
            navigator.clipboard.writeText(norek);
        });
    }
});
