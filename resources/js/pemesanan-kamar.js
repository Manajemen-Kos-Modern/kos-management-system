document.addEventListener("DOMContentLoaded", function () {
    // Preview gambar bukti transfer
    const input = document.querySelector('input[name="bukti_transfer"]');
    const preview = document.createElement("img");
    preview.style.maxWidth = "120px";
    preview.style.marginTop = "10px";

    if (input) {
        input.addEventListener("change", function (e) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (ev) {
                    preview.src = ev.target.result;
                    input.parentNode.appendChild(preview);
                };
                reader.readAsDataURL(input.files[0]);
            }
        });
    }
});
