<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Peserta</title>
</head>
<body>
    <h2>Tambah Peserta</h2>
    <form id="formTambahPeserta" enctype="multipart/form-data">
        <label for="nama">Nama:</label><br>
        <input type="text" id="nama" name="nama"><br>
        <label for="alamat">Alamat:</label><br>
        <textarea id="alamat" name="alamat"></textarea><br>
        <label for="tanggal_lahir">Tanggal Lahir:</label><br>
        <input type="date" id="tanggal_lahir" name="tanggal_lahir"><br>
        <label for="img">Gambar:</label><br>
        <input type="file" id="img" name="img"><br><br>
        <button type="submit">Tambah Peserta</button>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.getElementById("formTambahPeserta").addEventListener("submit", function(event) {
            event.preventDefault();
            const formData = new FormData(this);

            axios.post('https://salsacameliazahra.000webhostapp.com/API/tambah_peserta.php', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
            .then(function (response) {
                alert(response.data);
                // Arahkan ke tampil.php jika sukses
                window.location.href = 'tampil.php';
            })
            .catch(function (error) {
                console.error('Error:', error);
                alert("Terjadi kesalahan saat menambah peserta.");
            });
        });
    </script>
</body>
</html>
