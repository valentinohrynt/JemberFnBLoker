<?php
include_once __DIR__ . '/../app/config/db_connect.php';

class JobCategories
 {
    static function getAllJobCategories()
 {
        global $conn;
        $stmt = $conn->prepare( 'SELECT * FROM job_categories' );
        $stmt->execute();
        $result = $stmt->get_result();
        $JobCategories = array();
        while ( $row = $result->fetch_assoc() ) {
            $JobCategories[] = $row;
        }
        return $JobCategories;
        $conn->close();
    }
    static function getAllJobCategoriesDataById( $ids = [] )
 {
        global $conn;
        if ( empty( $ids ) ) {
            return [];
        }
        $idsString = implode( ',', $ids );
        $stmt = $conn->prepare( "SELECT * FROM job_categories WHERE id IN ($idsString)" );
        $stmt->execute();
        $result = $stmt->get_result();
        $JobCategories = [];
        while ( $row = $result->fetch_assoc() ) {
            $JobCategories[] = $row;
        }
        $stmt->close();
        return $JobCategories;
    }
    static function getJobCategoryById( $id ) {
        global $conn;
        $stmt = $conn->prepare( 'SELECT * FROM job_categories WHERE id = ?' );
        $stmt->bind_param( 'i', $id );
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
        $conn->close();
    }
}
