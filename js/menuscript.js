const toggleArrow = document.getElementById('toggleArrow');
    const menuContainer = document.getElementById('menuContainer');
    const contentWrapper = document.getElementById('content');

    toggleArrow.addEventListener('click', function() {
        // Toggle menu
        if (menuContainer.style.display === 'none' || menuContainer.style.display === '') {
            menuContainer.style.display = 'flex'; // Menampilkan menu
            toggleArrow.innerHTML = '▲'; // Mengubah panah menjadi atas
            toggleArrow.classList.add('rotated'); // Menambahkan kelas rotasi pada panah
            contentWrapper.style.marginRight = '220px'; // Memberi ruang untuk menu
        } else {
            menuContainer.style.display = 'none'; // Menyembunyikan menu
            toggleArrow.innerHTML = '▼'; // Mengubah panah menjadi bawah
            toggleArrow.classList.remove('rotated'); // Menghapus kelas rotasi pada panah
            contentWrapper.style.marginRight = '0'; // Mengembalikan margin konten
        }
    });