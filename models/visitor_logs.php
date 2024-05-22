<?php
include_once __DIR__ . '/../app/config/db_connect.php';

class VisitorLogs
{
    static function recordVisitor($ip_address)
    {
        global $conn;
        $sql = "INSERT INTO visitor_logs (ip_address) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $ip_address);
        $stmt->execute();
    }

    static function getTotalVisitors()
    {
        global $conn;
        $sql = "SELECT COUNT(id) as total_visitors FROM visitor_logs";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        return $row['total_visitors'];
    }
}
