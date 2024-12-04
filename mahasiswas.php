<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include "ModelMahasiswa.php";
$mahasiswa = new ModelMahasiswa();
$method = $_SERVER['REQUEST_METHOD'];
$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri_segments = explode('/', $request_uri);

switch ($method) {
    case 'GET':
        $id = end($uri_segments);
        if (is_numeric($id)) {
            $mahasiswa->id = $id;
            $result = $mahasiswa->readSingle();
            $row = $result->fetch_assoc();
            echo json_encode($row);
        } else {
            $result = $mahasiswa->read();
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            echo json_encode($data);
        }
        break;
    case 'POST':
        $data = json_decode(file_get_contents("php://input"));
        $mahasiswa->nim = $data->nim;
        $mahasiswa->nama = $data->nama;
        $mahasiswa->prodi = $data->prodi;
        $mahasiswa->email = $data->email;
        if ($mahasiswa->create()) {
            http_response_code(201);
            echo json_encode(["message" => "Mahasiswa berhasil ditambahkan"]);
        } else {
            http_response_code(503);
            echo json_encode(["message" => "Gagal membuat mahasiswa"]);
        }
        break;
    case 'PUT':
        $id = end($uri_segments);
        $data = json_decode(file_get_contents("php://input"));
        $mahasiswa->id = $id;
        $mahasiswa->nim = $data->nim;
        $mahasiswa->nama = $data->nama;
        $mahasiswa->prodi = $data->prodi;
        $mahasiswa->email = $data->email;
        if ($mahasiswa->update()) {
            http_response_code(200);
            echo json_encode(["message" => "Mahasiswa berhasil diperbarui"]);
        } else {
            http_response_code(503);
            echo json_encode(["message" => "Gagal memperbarui mahasiswa"]);
        }
        break;
    case 'DELETE':
        $id = end($uri_segments);
        $mahasiswa->id = $id;
        if ($mahasiswa->delete()) {
            http_response_code(200);
            echo json_encode(["message" => "Mahasiswa berhasil dihapus"]);
        } else {
            http_response_code(503);
            echo json_encode(["message" => "Gagal menghapus mahasiswa"]);
        }
        break;
}
?>