<?php
include_once __DIR__ . '/../app/config/db_connect.php';

class JobApplications
 {
    static function createJobApplication( $data ) {
        global $conn;
        $job_seeker_id = $data[ 'job_seeker_id' ];
        $job_vacancy_id = $data[ 'job_vacancy_id' ];
        $sql = 'INSERT INTO job_applications (job_seeker_id, job_vacancy_id) VALUES (?, ?)';
        $stmt = $conn->prepare( $sql );
        $stmt->bind_param( 'ii', $job_seeker_id, $job_vacancy_id );
        $stmt->execute();
        return $stmt->insert_id;
    }
    static function updateJobApplication( $data ) {
        global $conn;
    }
    static function updateStatusJobApplication( $data ) {
        global $conn;
    }
    static function getJobApplicationsByJobSeekerId( $job_seeker_id ) {
        //fungsi ini hanya ngambil yang active saja
        global $conn;
        $sql = 'SELECT ja.* FROM job_applications ja
                INNER JOIN job_vacancy jv ON ja.job_vacancy_id = jv.id
                WHERE ja.job_seeker_id = ? AND jv.status = "active"';
        $stmt = $conn->prepare( $sql );
        $stmt->bind_param( 'i', $job_seeker_id );
        $stmt->execute();
        $result = $stmt->get_result();
        $rows = $result->fetch_all( MYSQLI_ASSOC );
        return $rows;
    }
    static function getJobApplicationByJobSeekerIdandJobVacancyId( $job_seeker_id, $job_vacancy_id ) {
        global $conn;
        $sql = 'SELECT * FROM job_applications WHERE job_seeker_id = ? AND job_vacancy_id = ?';
        $stmt = $conn->prepare( $sql );
        $stmt->bind_param( 'ii', $job_seeker_id, $job_vacancy_id );
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    static function getJobApplicationsByJobVacancyId( $job_vacancy_id ) {
        global $conn;
        $sql = 'SELECT * FROM job_applications WHERE job_vacancy_id = ?';
        $stmt = $conn->prepare( $sql );
        $stmt->bind_param( 'i', $job_vacancy_id );
        $stmt->execute();
        $result = $stmt->get_result();
        $rows = array();
        while ( $row = $result->fetch_assoc() ) {
            $rows[] = $row;
        }
        $stmt->close();
        return $rows;
    }
    static function getProcessJobApplicationsByJobVacancyId( $job_vacancy_id ) {
        global $conn;
        $sql = 'SELECT * FROM job_applications WHERE job_vacancy_id = ? AND status = "process"';
        $stmt = $conn->prepare( $sql );
        $stmt->bind_param( 'i', $job_vacancy_id );
        $stmt->execute();
        $result = $stmt->get_result();
        $rows = array();
        while ( $row = $result->fetch_assoc() ) {
            $rows[] = $row;
        }
        $stmt->close();
        return $rows;
    }
    static function getConfirmedJobApplicationsByJobVacancyId( $job_vacancy_id ) {
        global $conn;
        $sql = 'SELECT * FROM job_applications WHERE job_vacancy_id = ? AND (status = "accepted" OR status = "rejected")';
        $stmt = $conn->prepare( $sql );
        $stmt->bind_param( 'i', $job_vacancy_id );
        $stmt->execute();
        $result = $stmt->get_result();
        $rows = array();
        while ( $row = $result->fetch_assoc() ) {
            $rows[] = $row;
        }
        $stmt->close();
        return $rows;
    }
    static function getJobApplicationById( $id ) {
        global $conn;
        $sql = 'SELECT * FROM job_applications WHERE id = ?';
        $stmt = $conn->prepare( $sql );
        $stmt->bind_param( 'i', $id );
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row;
    }
    static function updateStatus( $data = [] ) {
        global $conn;
        $sql = 'UPDATE job_applications SET status = ? WHERE id = ?';
        $stmt = $conn->prepare( $sql );
        $stmt->bind_param( 'si', $data[ 'status' ], $data[ 'id' ] );
        $stmt->execute();
        $stmt->close();
    }
}
