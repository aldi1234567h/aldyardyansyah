<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Peserta</title>
</head>
<body>
    <h2>Edit Peserta</h2>
    <form id="editForm" enctype="multipart/form-data">
        <input type="hidden" id="id" name="id">
        <label for="nama">Nama:</label><br>
        <input type="text" id="nama" name="nama"><br>
        <label for="alamat">Alamat:</label><br>
        <input type="text" id="alamat" name="alamat"><br>
        <label for="tanggal_lahir">Tanggal Lahir:</label><br>
        <input type="date" id="tanggal_lahir" name="tanggal_lahir"><br>
        <label for="url_image">Gambar:</label><br>
        <input type="file" id="url_image" name="url_image"><br><br>
        <button type="submit">Simpan</button>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        // Function to fetch and populate data into form fields
        async function fetchData() {
            const urlParams = new URLSearchParams(window.location.search);
            const id = urlParams.get('id');
            try {
                const response = await axios.get(`https://salsacameliazahra.000webhostapp.com/API/selectdata.php?id=${id}`);
                const data = response.data;
                document.getElementById('id').value = data.id;
                document.getElementById('nama').value = data.nama;
                document.getElementById('alamat').value = data.alamat;
                document.getElementById('tanggal_lahir').value = data.tanggal_lahir;
            } catch (error) {
                console.error('Error fetching data:', error);
            }
        }

        // Function to handle form submission
        async function handleSubmit(event) {
            event.preventDefault();
            const formData = new FormData(document.getElementById('editForm'));
            try {
                await axios.post('https://salsacameliazahra.000webhostapp.com/API/edit.php', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                });
                alert('Data berhasil diubah');
                // Redirect to a page after successful submission if needed
                // window.location.href = 'success_page.php';
            } catch (error) {
                console.error('Error submitting form:', error);
                alert('Gagal mengubah data');
            }
        }

        // Fetch data when the page loads
        window.onload = () => {
            fetchData();
            document.getElementById('editForm').addEventListener('submit', handleSubmit);
        };
    </script>
</body>
</html>
