// Script tambahan jika ingin notifikasi interaktif
document.querySelectorAll('.notification').forEach(note => {
    note.addEventListener('click', () => {
        alert('Notification clicked:\n' + note.textContent);
    });
});
