<?php
include_once __DIR__ . '/../app/config/db_connect.php';

class JobCreators
 {
    static function getAllActiveJobCreators() {
        global $conn;
        $sql = 'SELECT j.* FROM job_creators j JOIN users u ON j.user_id = u.id WHERE u.status = "active"';
        $stmt = $conn->prepare( $sql );
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all( MYSQLI_ASSOC );
        $conn->close();
    }
    static function getAllInactiveJobCreators() {
        global $conn;
        $sql = 'SELECT j.* FROM job_creators j JOIN users u ON j.user_id = u.id WHERE u.status = "inactive"';
        $stmt = $conn->prepare( $sql );
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all( MYSQLI_ASSOC );
        $conn->close();
    }
    static function getJobCreatorByUserId( $user_id )
 {
        global $conn;
        $sql = 'SELECT * FROM job_creators WHERE user_id = ?';
        $stmt = $conn->prepare( $sql );
        $stmt->bind_param( 'i', $user_id );
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
        $conn->close();
    }
    static function getJobCreatorById( $id )
 {
        global $conn;
        $sql = 'SELECT * FROM job_creators WHERE id = ?';
        $stmt = $conn->prepare( $sql );
        $stmt->bind_param( 'i', $id );
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
        $conn->close();
    }

    static function getAllJobCreatorsDataById( $ids = [] )
 {
        global $conn;
        if ( empty( $ids ) ) {
            return [];
        }
        $idsString = implode( ',', $ids );
        $stmt = $conn->prepare( "SELECT * FROM job_creators WHERE id IN ($idsString)" );
        $stmt->execute();
        $result = $stmt->get_result();
        $jobCreators = [];
        while ( $row = $result->fetch_assoc() ) {
            $jobCreators[] = $row;
        }
        $stmt->close();
        return $jobCreators;
    }

    static function createJobCreator( $data = [] )
 {
        global $conn;

        $name = $data[ 'name' ];
        $phone = $data[ 'phone' ];
        $street = $data[ 'street' ];
        $district_id = $data[ 'district_id' ];
        $user_id = $data[ 'user_id' ];
        $lat = $data[ 'lat' ];
        $lng = $data[ 'lng' ];

        $stmt = $conn->prepare( 'INSERT INTO job_creators (user_id, name, phone, lat, lng, street, district_id) VALUES (?, ?, ?, ?, ?, ?, ?)' );
        $stmt->bind_param( 'issddsi', $user_id, $name, $phone, $lat, $lng, $street, $district_id );
        $stmt->execute();
        $job_creator_id = $stmt->insert_id;

        return $job_creator_id;
    }
    static function updateJobCreator( $data = [] ) {
        global $conn;
        $id = $data[ 'id' ];
        $name = $data[ 'name' ];
        $phone = $data[ 'phone' ];
        $street = $data[ 'street' ];
        $district_id = $data[ 'district_id' ];
        $lat = $data[ 'lat' ];
        $lng = $data[ 'lng' ];
        $stmt = $conn->prepare( 'UPDATE job_creators SET name = ?, phone = ?, lat = ?, lng = ?, street = ?, district_id = ? WHERE id = ?' );
        $stmt->bind_param( 'ssddsii', $name, $phone, $lat, $lng, $street, $district_id, $id );
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
            $stmt = $conn->prepare( 'UPDATE job_creators SET profile_image = ? WHERE id = ?' );
            $stmt->bind_param( 'si', $new_file_name, $id );
            $stmt->execute();
            return true;
        } else {
            return false;
        }
    }
}
