<?php
require "koneksi.php";
class ModelMahasiswa extends Connection
{
    private $id;
    private $nim;
    private $nama;
    private $prodi;
    private $email;
    public function __get($atribute)
    {
        if (property_exists($this, $atribute)) {
            return $this->$atribute;
        }
    }
    public function __set($atribut, $value)
    {
        if (property_exists($this, $atribut)) {

            $this->$atribut = $value;

        }
    }
    // Membaca Semua Mahasiswa
    public function read()
    {
        $query = "SELECT * FROM mahasiswa";
        return $this->conn->query($query);
    }
    // Membaca Satu Mahasiswa
    public function readSingle()
    {
        $query = "SELECT * FROM mahasiswa where id =" . $this->id;
        return $this->conn->query($query);
    }
    // Membuat Mahasiswa Baru
    public function create()
    {
        $query = "INSERT INTO mahasiswa (nim, nama, prodi, email) VALUES ('$this->nim', '$this->nama', '$this->prodi', '$this->email')";
        return $this->conn->query($query);
    }
    // Memperbarui Mahasiswa
    public function update()
    {
        $query = "UPDATE mahasiswa SET nama='$this->nama', nim='$this->nim', email='$this->email', prodi='$this->prodi' WHERE id=" . $this->id;
        return $this->conn->query($query);
    }
    // Menghapus Mahasiswa
    public function delete()
    {
        $query = "DELETE FROM mahasiswa WHERE id =" . $this->id;
        return $this->conn->query($query);
    }
}