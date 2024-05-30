<?php
class Koneksi {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "tp_survey";
    private $kon;

    public function __construct() {
        $this->kon = mysqli_connect($this->host, $this->username, $this->password, $this->database);

        if (mysqli_connect_error()) {
            echo "Koneksi database gagal : " . mysqli_connect_error();
            exit(); 
        }
    }

    public function getConnection() {
        return $this->kon;
    }

    public function closeConnection() {
        mysqli_close($this->kon);
    }
}
?>
