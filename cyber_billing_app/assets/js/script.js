document.addEventListener('DOMContentLoaded', () => {
    // Set waktu mulai sesuai dengan waktu laptop (client-side)
    const waktuMulaiInput = document.querySelector('input[name="waktu_mulai"]');
    if (waktuMulaiInput) {
        const now = new Date();
        const year = now.getFullYear();
        const month = String(now.getMonth() + 1).padStart(2, '0');
        const day = String(now.getDate()).padStart(2, '0');
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        waktuMulaiInput.value = `${year}-${month}-${day}T${hours}:${minutes}`;
    }

    // Header clock widget (updates every second) — time and date, with icon
    const headerClockTime = document.getElementById('headerClockTime');
    const headerClockDate = document.getElementById('headerClockDate');
    function updateHeaderClock() {
        if (!headerClockTime) return;
        const now = new Date();
        headerClockTime.textContent = now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', second: '2-digit' });
        if (headerClockDate) {
            headerClockDate.textContent = now.toLocaleDateString([], { weekday: 'short', day: '2-digit', month: 'short' });
        }
    }
    updateHeaderClock();
    setInterval(updateHeaderClock, 1000);

    // Pencarian tabel (filtering) — search input with id "searchTable"
    const searchInput = document.querySelector('#searchTable');
    if (searchInput) {
        searchInput.addEventListener('keyup', () => {
            const keyword = searchInput.value.toLowerCase();
            document.querySelectorAll('tbody tr').forEach(row => {
                row.style.display = row.textContent.toLowerCase().includes(keyword) ? '' : 'none';
            });
        });
    }

    // Preview total biaya sewa (durasi * tarif) in real-time
    const durasiInput = document.querySelector('#durasi');
    const tarifInput = document.querySelector('#tarif');
    const previewTotal = document.querySelector('#previewTotal');

    // Function untuk menghitung dan menampilkan total biaya sewa
    function hitungPreview() {
        if (!durasiInput || !tarifInput || !previewTotal) return;
        const durasi = parseFloat(durasiInput.value || 0);
        const tarif = parseFloat(tarifInput.value || 0);
        const total = durasi * tarif;
        previewTotal.textContent = new Intl.NumberFormat('id-ID', { // format angka dengan separator ribuan
            style: 'currency', currency: 'IDR', maximumFractionDigits: 0
        }).format(total);
    }
    // Event listener untuk input durasi dan tarif
    if (durasiInput && tarifInput) {
        durasiInput.addEventListener('input', hitungPreview);
        tarifInput.addEventListener('input', hitungPreview);
        hitungPreview();
    }

    const pageContent = document.querySelector('.page-content');
    if (pageContent) {
        window.requestAnimationFrame(() => pageContent.classList.add('loaded'));
    }
    
    document.querySelectorAll('a.nav-link[href*="index.php?page="]').forEach(link => {
        link.addEventListener('click', event => {
            const targetHref = link.getAttribute('href');
            if (!targetHref || link.target === '_blank' || event.metaKey || event.ctrlKey) return;
            event.preventDefault();
            if (pageContent) {
                pageContent.classList.add('exiting');
            }
            setTimeout(() => {
                window.location.href = targetHref;
            }, 180);
        });
    });
});
