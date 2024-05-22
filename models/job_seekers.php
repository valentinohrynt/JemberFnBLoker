<?php
include_once __DIR__ . '/../app/config/db_connect.php';

class JobSeekers
 {
    static function getAllActiveJobSeekers() {
        global $conn;
        $sql = 'SELECT j.* FROM job_seekers j JOIN users u ON j.user_id = u.id WHERE u.status = "active"';
        $stmt = $conn->prepare( $sql );
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all( MYSQLI_ASSOC );
        $conn->close();
    }
    static function getAllInactiveJobSeekers() {
        global $conn;
        $sql = 'SELECT j.* FROM job_seekers j JOIN users u ON j.user_id = u.id WHERE u.status = "inactive"';
        $stmt = $conn->prepare( $sql );
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all( MYSQLI_ASSOC );
        $conn->close();
    }
    static function createJobSeeker( $data = [] )
 {
        global $conn;

        $name = $data[ 'name' ];
        $phone = $data[ 'phone' ];
        $gender = $data[ 'gender' ];
        $age = $data[ 'age' ];
        $street = $data[ 'street' ];
        $district_id = $data[ 'district_id' ];
        $user_id = $data[ 'user_id' ];
        $lat = $data[ 'lat' ];
        $lng = $data[ 'lng' ];

        $stmt = $conn->prepare( 'INSERT INTO job_seekers (user_id, name, phone, lat, lng, street, district_id) VALUES (?, ?, ?, ?, ?, ?, ?)' );
        $stmt->bind_param( 'issddsi', $user_id, $name, $phone, $lat, $lng, $street, $district_id );
        $stmt->execute();
        $job_seeker_id = $stmt->insert_id;

        return $job_seeker_id;
    }
    static function getJobSeekerByUserId( $id ) {
        global $conn;
        $stmt = $conn->prepare( 'SELECT * FROM job_seekers WHERE user_id = ?' );
        $stmt->bind_param( 'i', $id );
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        return $data;
    }
    static function updateJobSeeker( $data = [] ) {
        global $conn;
        $id = $data[ 'id' ];
        $name = $data[ 'name' ];
        $gender = $data[ 'gender' ];
        $age = $data[ 'age' ];
        $phone = $data[ 'phone' ];
        $street = $data[ 'street' ];
        $district_id = $data[ 'district_id' ];
        $lat = $data[ 'lat' ];
        $lng = $data[ 'lng' ];
        $stmt = $conn->prepare( 'UPDATE job_seekers SET name = ?, phone = ?, gender = ?, age = ?, lat = ?, lng = ?, street = ?, district_id = ? WHERE id = ?' );
        $stmt->bind_param( 'sssiddsii', $name, $phone, $gender, $age, $lat, $lng, $street, $district_id, $id );
        $stmt->execute();
        if ( isset( $data[ 'profile_image' ] ) ) {
            $addProfileImage = self::addProfileImage( $id, $data[ 'profile_image' ] );
            if ( $addProfileImage ) {
                return true;
            } else {
                return false;
            }
        }
        return $stmt->affected_rows > 0 ? true : false;
    }

    static function addProfileImage( $id, $image ) {
        global $conn;
        $file_name = $image[ 'name' ];
        $file_ext = pathinfo( $file_name, PATHINFO_EXTENSION );
        $new_file_name = 'photo_profile_' . $id . '.webp';
        $upload_dir = 'uploads/photo_profile/';

        if ( !file_exists( $upload_dir ) ) {
            mkdir( $upload_dir, 0777, true );
        }
        $upload_path = $upload_dir . $new_file_name;

        $tmp_name = $image[ 'tmp_name' ];
        if ( compressToWebP( $tmp_name, $upload_path ) ) {
            $stmt = $conn->prepare( 'UPDATE job_seekers SET profile_image = ? WHERE id = ?' );
            $stmt->bind_param( 'si', $new_file_name, $id );
            $stmt->execute();
            return true;
        } else {
            return false;
        }
    }

    static function getJobSeekerById($id){
        global $conn;
        $stmt = $conn->prepare('SELECT * FROM job_seekers WHERE id = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        return $data;
    }
}