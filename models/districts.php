<?php
include_once __DIR__ . '/../app/config/db_connect.php';

class Districts
{
    static function getAllDistricts()
    {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM districts ORDER BY name ASC");
        $stmt->execute();
        $result = $stmt->get_result();
        $Districts = array();
        while ($row = $result->fetch_assoc()) {
            $Districts[] = $row;
        }
        return $Districts;
        $conn->close();
    }
    static function getDistrictById($id){
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM districts WHERE id = ?");
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $result = $stmt->get_result();
        $District = $result->fetch_assoc();
        return $District;
        $conn->close();
    }
}
