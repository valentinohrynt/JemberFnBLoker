<?php
include_once __DIR__ . '/../app/config/db_connect.php';

class JobApplicationsFiles
 {
    static function getByJobApplicationFilesById( $id ) {
        global $conn;
        $sql = 'SELECT * FROM job_applications_files WHERE id = ?';
        $stmt = $conn->prepare( $sql );
        $stmt->bind_param( 'i', $id );
        $stmt->execute();
        return $stmt->fetch();
    }
    static function getJobApplicationsFilesByApplicationIds($ids = []) {
        if (!empty($ids)){
            global $conn;
            $ids = implode(',', $ids);
            $stmt = $conn->prepare("SELECT * FROM job_applications_files WHERE job_application_id IN ($ids)");
            $stmt->execute();
            $result = $stmt->get_result();
            $rows = [];
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            $stmt->close();
            return $rows;
        }
        else{
            return [];
        }
    }    
    static function createJobApplicationFiles( $job_application_id ) {
        global $conn;
        $files = $_FILES[ 'file' ];
        $success = true;
        $count = 0;
        
        foreach ( $files[ 'name' ] as $key => $file_name ) {
            if ($count >= 3) {
                break; // Exit the loop if already processed three files
            }
            
            $file_tmp_name = $files[ 'tmp_name' ][ $key ];
            $file_type = $files[ 'type' ][ $key ];
            $file_size = $files[ 'size' ][ $key ];
            $file_error = $files[ 'error' ][ $key ];
    
            if ( $file_error === 0 ) {
                $file_unique_name = uniqid( '', true ) . '_' . $file_name;
                $file_destination = 'uploads/job_applications_files/' . $file_unique_name;
    
                if ( move_uploaded_file( $file_tmp_name, $file_destination ) ) {
                    $sql = 'INSERT INTO job_applications_files (job_application_id, file) VALUES (?, ?)';
                    $stmt = $conn->prepare( $sql );
                    $stmt->bind_param( 'is', $job_application_id, $file_destination );
    
                    if ( !$stmt->execute() ) {
                        $success = false;
                    }
    
                    $stmt->close();
                    $count++;
                } else {
                    $success = false;
                }
            } else {
                $success = false;
            }
        }
        return $success;
    }
    
    static function getJobApplicationsFilesByJobApplicationId( $job_application_id ) {
        global $conn;
        $sql = 'SELECT * FROM job_applications_files WHERE job_application_id = ?';
        $stmt = $conn->prepare( $sql );
        $stmt->bind_param( 'i', $job_application_id );
        $stmt->execute();
        return $stmt->get_result();
    }

}