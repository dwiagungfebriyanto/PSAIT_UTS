<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Nilai Mahasiswa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="assets/style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <section class="vh-100" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-12 p-5 border-secondary-subtle rounded shadow-lg bg-body-tertiary rounded-4" style="height: 90%;">
                    <div class="clearfix">
                        <h1 class="float-start">Data Nilai Mahasiswa</h1>
                        <a href="insertNilai.php" class="btn btn-primary float-end"><i class="fa fa-plus"></i> Tambah Nilai</a>
                    </div>
                    <p class="mb-5">Selamat datang di tugas UTS mata kuliah PSAIT!</p>

                    <div class="table-responsive">
                    <?php
                    $curl = curl_init();
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($curl, CURLOPT_URL, 'http://localhost/psait_uts/mahasiswa_api.php');
                    $result = curl_exec($curl);
                    $json = json_decode($result, true);

                    echo '<table class="table table-light table-hover">';
                        echo '<thead>';
                            echo '<tr>';
                                echo '<th>NIM</th>';
                                echo '<th>Nama</th>';
                                echo '<th>Alamat</th>';
                                echo '<th>Tanggal Lahir</th>';
                                echo '<th>Kode MK</th>';
                                echo '<th>Nama MK</th>';
                                echo '<th>SKS</th>';
                                echo '<th>Nilai</th>';
                                echo '<th>Aksi</th>';
                            echo '</tr>';
                        echo '</thead>';
                        echo '<tbody>';
                        foreach($json['data'] as $row) {
                            echo '<tr>';
                                echo '<td>' . $row['nim'] . '</td>';
                                echo '<td>' . $row['nama'] . '</td>';
                                echo '<td>' . $row['alamat'] . '</td>';
                                echo '<td>' . $row['tanggal_lahir'] . '</td>';
                                echo '<td>' . $row['kode_mk'] . '</td>';
                                echo '<td>' . $row['nama_mk'] . '</td>';
                                echo '<td>' . $row['sks'] . '</td>';
                                echo '<td>' . $row['nilai'] . '</td>';
                                echo '<td>';
                                    echo '<a href="updateNilai.php?nim=' . $row['nim'] . '&kode_mk=' . $row['kode_mk'] . '&nilai=' . $row['nilai'] . '" class="me-3" title="Update data '. $row['nama'] .'" data-toggle="tooltip"><i class="fas fa-edit"></i></a>';
                                    echo '<a href="deleteNilaiDo.php?nim=' . $row['nim'] . '&kode_mk=' . $row['kode_mk'] . '" class="text-danger" title="Delete nilai '. $row['nama'] .'" data-toggle="tooltip"><i class="fas fa-trash"></i></a>';
                                echo '</td>';
                            echo '</tr>';
                        }
                        echo '</tbody>';
                    echo '</table>';
                    
                    curl_close($curl);
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>