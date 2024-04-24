<?php
require_once "config.php";
$request_method = $_SERVER["REQUEST_METHOD"];

switch($request_method) {
    case 'GET':
        if(!empty($_GET["nim"])) {
            $nim = $_GET["nim"];
            get_nilai_mahasiswa($nim);        
        } else {
            get_all_nilai_mahasiwa();
        }
        break;
    case 'POST':
        if(!empty($_GET["nim"]) && !empty($_GET["kode_mk"])) {
            $nim = $_GET["nim"];
            $kode_mk = $_GET["kode_mk"];
            update_nilai($nim, $kode_mk);
        } else {
            insert_nilai();
        }
        break;
    case 'DELETE':
        $nim = $_GET["nim"];
        $kode_mk = $_GET["kode_mk"];
        delete_nilai($nim, $kode_mk);
        break;
    default:
        header("HTTP/1.0 405 Method Not Allowed");
        break;
    break;
}

// Function untuk mengembalikan semua nilai mahasiswa
function get_all_nilai_mahasiwa() {
    global $mysqli;
    $query = "SELECT * FROM data_mahasiswa";
    $data = array();
    $result = $mysqli->query($query);

    while($row = mysqli_fetch_object($result)) {
        $data[] = $row;
    }

    $response = array(
        'status' => 1,
        'message' => 'Get list nilai mahasiswa succesfully.',
        'data' => $data
    );

    header('Content-Type: application/json');
    echo json_encode($response);
}

// Function untuk mengembalikan nilai mahasiswa berdasarkan nim
function get_nilai_mahasiswa($nim) {
    global $mysqli;
    $query = "SELECT * FROM data_mahasiswa WHERE nim = '$nim'";

    $data = array();
    $result = $mysqli->query($query);

    while($row = mysqli_fetch_object($result)) {
        $data[] = $row;
    }

    $response = array(
        'status' => 1,
        'message' => 'Get nilai mahasiswa successfully.',
        'data' => $data
    );

    header('Content-Type: application/json');
    echo json_encode($response);

}

// Function untuk menambahkan nilai
function insert_nilai() {
    global $mysqli;

    if(!empty($_POST["kode_mk"]) && !empty($_POST["nim"])) {
        $data = $_POST;
    } else {
        $data = json_decode(file_get_contents('php://input'), true);
    }

    $arrcheckpost = array('nim' => '', 'kode_mk' => '', 'nilai' => '');
    $hitung = count(array_intersect_key($data, $arrcheckpost));

    if($hitung == count($arrcheckpost)) {
        $result = mysqli_query($mysqli, "INSERT INTO perkuliahan SET
            nim = '$data[nim]',
            kode_mk = '$data[kode_mk]',
            nilai = '$data[nilai]'");

            if($result) {
                $response = array(
                    'status' => 1,
                    'message' => 'Nilai mahasiswa added successfully.'
                );
            } else {
                $response = array(
                    'status' => 0,
                    'message' => 'Failed to add nilai mahasiswa.'
                );
            }
    } else {
        $response = array(
            'status' => 0,
            'message' => 'Invalid data.'
        );
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}

// Function untuk mengupdate nilai
function update_nilai($nim, $kode_mk) {
    global $mysqli;

    if(!empty($_POST["nilai"])) {
        $data = $_POST;
    } else {
        $data = json_decode(file_get_contents('php://input'), true);
    }

    if(!empty($data['nilai'])) {
        $nilai = intval($data['nilai']);
        $result = mysqli_query($mysqli, "UPDATE perkuliahan SET
            nilai = $nilai
            WHERE nim = '$nim' AND kode_mk = '$kode_mk'");

            if($result) {
                $response = array(
                    'status' => 1,
                    'message' => 'Nilai mahsiswa updated successfully.'
                );
            } else {
                $response = array(
                    'status' => 0,
                    'message' => 'Failed to update nilai mahasiswa.'
                );
            }
    } else {
        $response = array(
            'status' => 0,
            'message' => 'Invalid data.',
            'data' => $data
        );
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}

// Function untuk menghapus nilai
function delete_nilai($nim, $kode_mk) {
    global $mysqli;
    $query = "DELETE FROM perkuliahan WHERE nim = '$nim' AND kode_mk = '$kode_mk'";

    if(mysqli_query($mysqli, $query)) {
        $response = array(
            'status' => 1,
            'message' => 'Nilai mahasiswa deleted successfully.'
        );
    } else {
        $response = array(
            'status' => 0,
            'message' => 'Failed to delete nilai mahasiwa.'
        );
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}

?>