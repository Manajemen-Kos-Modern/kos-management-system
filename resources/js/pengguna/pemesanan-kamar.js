document.addEventListener("DOMContentLoaded", function () {
    // Harga per bulan dari window variable
    const hargaPerBulan = window.hargaPerBulan || 0;
    const durasiSelect = document.getElementById("durasi_sewa");
    const waktuPembayaranSelect = document.getElementById("waktu_pembayaran");
    const totalPembayaran = document.getElementById("totalPembayaran");

    function setInitialValue() {
        const urlParams = new URLSearchParams(window.location.search);
        const durasi = urlParams.get("durasi");
        const waktu = urlParams.get("tipe_pembayaran");
        if (durasi && durasiSelect) durasiSelect.value = durasi;
        if (waktu && waktuPembayaranSelect)
            waktuPembayaranSelect.value =
                waktu === "lunas" ? "Lunas" : "Per Bulan";
    }

    function updateTotal() {
        const durasi = parseInt(durasiSelect.value);
        const waktu = waktuPembayaranSelect.value;
        let total = 0;

        if (waktu === "Lunas") {
            total = hargaPerBulan * durasi;
        } else {
            total = hargaPerBulan;
        }
        totalPembayaran.textContent = "Rp" + total.toLocaleString("id-ID");
    }

    if (durasiSelect && waktuPembayaranSelect && totalPembayaran) {
        setInitialValue();
        durasiSelect.addEventListener("change", updateTotal);
        waktuPembayaranSelect.addEventListener("change", updateTotal);
        updateTotal();
    }

    // Salin jumlah pembayaran
    const salinJumlahBtn = document.getElementById("salin-jumlah");
    if (salinJumlahBtn && totalPembayaran) {
        salinJumlahBtn.addEventListener("click", function () {
            const angka = totalPembayaran.textContent.replace(/[^\d]/g, "");
            navigator.clipboard.writeText(angka);
        });
    }

    // Salin no rekening
    const salinRekBtn = document.getElementById("salin-rekening");
    if (salinRekBtn) {
        salinRekBtn.addEventListener("click", function () {
            navigator.clipboard.writeText("1234567890");
        });
    }

    // Modal sukses (jika ingin trigger dari JS)
    const successModal = document.getElementById("successModal");
    if (successModal) {
        const closeBtn = successModal.querySelector("button");
        if (closeBtn) {
            closeBtn.addEventListener("click", function () {
                successModal.style.display = "none";
            });
        }
    }
});
