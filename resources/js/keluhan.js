document.addEventListener('DOMContentLoaded', function () {
    const detailButtons = document.querySelectorAll('.detail-btn');
    const doneButtons = document.querySelectorAll('.done-btn');

    detailButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            alert('Lihat detail keluhan.');
        });
    });

    doneButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            alert('Keluhan ditandai sebagai selesai.');
        });
    });
});
