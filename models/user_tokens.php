<?php
include_once __DIR__ . '/../app/config/db_connect.php';

class UserTokens
{
    public static function getCurrentToken($userId)
    {
        global $conn;

        $result = $conn->query("SELECT token FROM user_tokens WHERE user_id = '$userId' ORDER BY created_at DESC LIMIT 1");

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['token'];
        }

        return null;
    }
}
