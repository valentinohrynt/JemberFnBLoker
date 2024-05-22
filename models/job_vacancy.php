<?php
include_once __DIR__ . '/../app/config/db_connect.php';

class JobVacancy
 {
    static function getAllActiveJobVacancyByJobCreatorId( $id )
 {
        global $conn;
        $stmt = $conn->prepare( "SELECT * FROM job_vacancy WHERE status = 'active' AND job_creator_id = ?" );
        $stmt->bind_param( 'i', $id );
        $stmt->execute();
        $result = $stmt->get_result();
        $rows = array();
        while ( $row = $result->fetch_assoc() ) {
            $rows[] = $row;
        }
        $stmt->close();
        return $rows;
    }
    static function getAllInactiveJobVacancyByJobCreatorId( $id )
 {
        global $conn;
        $stmt = $conn->prepare( "SELECT * FROM job_vacancy WHERE status = 'inactive' AND job_creator_id = ?" );
        $stmt->bind_param( 'i', $id );
        $stmt->execute();
        $result = $stmt->get_result();
        $rows = array();
        while ( $row = $result->fetch_assoc() ) {
            $rows[] = $row;
        }
        $stmt->close();
        return $rows;
    }
    static function getAllActiveJobVacancy()
 {
        global $conn;
        $stmt = $conn->prepare( "SELECT * FROM job_vacancy WHERE status = 'active' ORDER BY created_at DESC" );
        $stmt->execute();
        $result = $stmt->get_result();
        $rows = array();
        while ( $row = $result->fetch_assoc() ) {
            $rows[] = $row;
        }
        $stmt->close();
        return $rows;
    }
    static function getAllInactiveJobVacancy()
 {
        global $conn;
        $stmt = $conn->prepare( "SELECT * FROM job_vacancy WHERE status = 'inactive'" );
        $stmt->execute();
        $result = $stmt->get_result();
        $rows = array();
        while ( $row = $result->fetch_assoc() ) {
            $rows[] = $row;
        }
        $stmt->close();
        return $rows;
    }

    static function updateStatus( $data = [] )
 {
        global $conn;
        $id = $data[ 'id' ];
        $status = $data[ 'status' ];
        $stmt = $conn->prepare( 'UPDATE job_vacancy SET status = ? WHERE id = ?' );
        $stmt->bind_param( 'si', $status, $id );
        $stmt->execute();
        $stmt->close();
        return true;
    }
    static function disableJobVacancyByJobCreatorId( $id )
 {
        global $conn;
        $status = 'inactive';
        $stmt = $conn->prepare( 'UPDATE job_vacancy SET status = ? WHERE job_creator_id = ?' );
        $stmt->bind_param( 'si', $status, $id );
        $stmt->execute();
        $stmt->close();
        return true;
    }

    static function getAllJobVacancy()
 {
        global $conn;
        $stmt = $conn->prepare( 'SELECT * FROM job_vacancy' );
        $stmt->execute();
        $result = $stmt->get_result();
        $rows = array();
        while ( $row = $result->fetch_assoc() ) {
            $rows[] = $row;
        }
        $stmt->close();
        return $rows;
    }
    static function getAllJobVacancyByJobCreatorId( $id )
 {
        global $conn;
        $stmt = $conn->prepare( 'SELECT * FROM job_vacancy WHERE job_creator_id = ?' );
        $stmt->bind_param( 'i', $id );
        $stmt->execute();
        $result = $stmt->get_result();
        $rows = array();
        while ( $row = $result->fetch_assoc() ) {
            $rows[] = $row;
        }
        $stmt->close();
        return $rows;
    }

    static function getAllTodayJobVacancy()
 {
        global $conn;
        $todayDate = date( 'Y-m-d' );
        $stmt = $conn->prepare( 'SELECT * FROM job_vacancy WHERE DATE(created_at) = ?' );
        $stmt->bind_param( 's', $todayDate );
        $stmt->execute();
        $result = $stmt->get_result();
        $rows = array();
        while ( $row = $result->fetch_assoc() ) {
            $rows[] = $row;
        }
        $stmt->close();
        return $rows;
    }

    static function getTotalJobVacancy()
 {
        global $conn;
        $sql = 'SELECT COUNT(id) as total_jobvacancy FROM job_vacancy';
        $result = $conn->query( $sql );
        $row = $result->fetch_assoc();
        return $row[ 'total_jobvacancy' ];
    }

    static function createJobVacancy( $data = [] )
 {
        global $conn;
        $job_creator_id = $data[ 'job_creator_id' ];
        $title = $data[ 'title' ];
        $requirement = $data[ 'requirement' ];
        $job_category_id = $data[ 'job_category_id' ];
        $job_time = $data[ 'job_time' ];
        $workplace = $data[ 'workplace' ];
        $stmt = $conn->prepare( 'INSERT INTO job_vacancy (job_creator_id, title, requirement, job_category_id, job_time, workplace) VALUES (?, ?, ?, ?, ?, ?)' );
        $stmt->bind_param( 'ississ', $job_creator_id, $title, $requirement, $job_category_id, $job_time, $workplace );
        $stmt->execute();
        $id = $stmt->insert_id;

        $file_name = $_FILES[ 'g' ][ 'name' ];
        $file_ext = pathinfo( $file_name, PATHINFO_EXTENSION );
        $new_file_name = 'photo_jobvacancy_' . $id . '.webp';
        $upload_dir = 'uploads/photo_jobvacancy/';

        if ( !file_exists( $upload_dir ) ) {
            mkdir( $upload_dir, 0777, true );
        }
        $upload_path = $upload_dir . $new_file_name;

        $tmp_name = $_FILES[ 'g' ][ 'tmp_name' ];
        if ( compressToWebP( $tmp_name, $upload_path ) ) {
            $stmt = $conn->prepare( 'UPDATE job_vacancy SET photo = ? WHERE id = ?' );
            $stmt->bind_param( 'si', $new_file_name, $id );
            $stmt->execute();

            $result = $stmt->affected_rows > 0 ? true : false;
            return $result;
        } else {
            return false;
        }
    }

    static function getJobVacancyById( $id )
 {
        global $conn;
        $stmt = $conn->prepare( 'SELECT * FROM job_vacancy WHERE id = ?' );
        $stmt->bind_param( 'i', $id );
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    static function updateJobVacancy( $id, $data = [] )
 {
        global $conn;

        $title = $data[ 'title' ];
        $requirement = $data[ 'requirement' ];
        $job_category_id = $data[ 'job_category_id' ];
        $job_time = $data[ 'job_time' ];
        $workplace = $data[ 'workplace' ];

        $stmt = $conn->prepare( 'UPDATE job_vacancy SET title = ?, requirement = ?, job_category_id = ?, job_time = ?, workplace = ? WHERE id = ?' );
        $stmt->bind_param( 'ssissi', $title, $requirement, $job_category_id, $job_time, $workplace, $id );
        $stmt->execute();

        if ( !empty( $_FILES[ 'g' ][ 'name' ] ) ) {
            // Get the old photo name
            $stmt_get_old_photo = $conn->prepare( 'SELECT photo FROM job_vacancy WHERE id = ?' );
            $stmt_get_old_photo->bind_param( 'i', $id );
            $stmt_get_old_photo->execute();
            $stmt_get_old_photo->store_result();
            $stmt_get_old_photo->bind_result( $old_photo_name );
            $stmt_get_old_photo->fetch();
            $stmt_get_old_photo->close();

            // Delete the old photo if it exists
            if ( $old_photo_name ) {
                $old_photo_path = 'uploads/photo_jobvacancy/' . $old_photo_name;
                if ( file_exists( $old_photo_path ) ) {
                    unlink( $old_photo_path );
                }
            }

            $file_name = $_FILES[ 'g' ][ 'name' ];
            $file_ext = pathinfo( $file_name, PATHINFO_EXTENSION );
            $new_file_name = 'photo_jobvacancy_' . $id . '.webp';
            // Save as .webp
            $upload_dir = 'uploads/photo_jobvacancy/';

            if ( !file_exists( $upload_dir ) ) {
                mkdir( $upload_dir, 0777, true );
            }
            $upload_path = $upload_dir . $new_file_name;

            $tmp_name = $_FILES[ 'g' ][ 'tmp_name' ];
            if ( compressToWebP( $tmp_name, $upload_path ) ) {
                $stmt_update_photo = $conn->prepare( 'UPDATE job_vacancy SET photo = ? WHERE id = ?' );
                $stmt_update_photo->bind_param( 'si', $new_file_name, $id );
                $stmt_update_photo->execute();

                $result = $stmt_update_photo->affected_rows > 0 ? true : false;
                $stmt_update_photo->close();

                return $result;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }
    static function getJobVacancyByIds( $ids = [] ) {
        global $conn;
        if ( !empty( $ids ) ) {
            $ids = implode( ',', $ids );
            $stmt = $conn->prepare( "SELECT * FROM job_vacancy WHERE id IN ($ids)" );
            $stmt->execute();
            $result = $stmt->get_result();
            $rows = array();
            while ( $row = $result->fetch_assoc() ) {
                $rows[] = $row;
            }
            $stmt->close();
            return $rows;
        } else {
            return [];
        }
    }
}
