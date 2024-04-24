<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventaris Barang</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

    <?php
    $nim = $_GET['nim'];
    $kode_mk = $_GET['kode_mk'];
    $nilai = $_GET['nilai'];
    // $curl= curl_init();
    // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
    // curl_setopt($curl, CURLOPT_URL, 'http://localhost/psait_uts/mahasiswa_api.php?=nim'.$nim.'&kode_mk='.$kode_mk.'');
    // $res = curl_exec($curl);
    // $json = json_decode($res, true);
    ?>

    <section class="vh-100" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-12 p-5 border-secondary-subtle rounded shadow-lg bg-body-tertiary rounded-4">
                    <div class="clearfix">
                        <h1 class="float-start">Update Nilai</h1>
                        <a href="index.php" class="btn btn-outline-primary float-end"><i class="fa fa-angle-left"></i> Kembali</a>
                    </div>
                    <p class="mb-5">Mohon isi formulir ini dan klik simpan untuk memperbarui nilai di database.</p>

                    <form action="updateNilaiDo.php" method="post">
                        <input type = "hidden" name="nim" value="<?php echo $nim;?>">
                        <input type = "hidden" name="kode_mk" value="<?php echo $kode_mk;?>">
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">NIM</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="<?php echo $nim; ?>" disabled>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Kode MK</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="<?php echo $kode_mk; ?>" disabled>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Nilai</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="nilai" value="<?php echo $nilai; ?>">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mt-3" name="submit" value="submit">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
</html>