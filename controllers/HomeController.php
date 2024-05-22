<?php
include_once 'models/visitor_logs.php';
include_once 'models/job_vacancy.php';
include_once 'models/job_categories.php';
include_once 'models/job_creators.php';
include_once 'models/districts.php';
include_once 'models/job_seekers.php';
include_once 'models/job_applications.php';
include_once 'models/job_applications_files.php';
include_once 'models/users.php';
include_once 'function/main.php';
include_once 'app/config/static.php';

class HomeController
 {
    static function index()
 {
        $ip_address = $_SERVER[ 'REMOTE_ADDR' ];
        VisitorLogs::recordVisitor( $ip_address );
        return view( 'home/home_layout', [ 'url' => 'home' ] );
    }

    static function cariloker()
 {
        if ( $_SERVER[ 'REQUEST_METHOD' ] === 'GET' && isset( $_SERVER[ 'HTTP_X_REQUESTED_WITH' ] ) && strtolower( $_SERVER[ 'HTTP_X_REQUESTED_WITH' ] ) === 'xmlhttprequest' ) {
            $active_loker = JobVacancy::getAllActiveJobVacancy();
            $data_posisi_lowongan = JobCategories::getAllJobCategories();
            $jobCreatorIds_active_loker = array_column( $active_loker, 'job_creator_id' );
            $job_creator_active_loker = JobCreators::getAllJobCreatorsDataById( $jobCreatorIds_active_loker );
            $district_data = Districts::getAllDistricts();
            $districtMap = [];
            foreach ( $job_creator_active_loker as $jobCreator ) {
                $districtId = $jobCreator[ 'district_id' ];
                foreach ( $district_data as $district ) {
                    if ( $district[ 'id' ] == $districtId ) {
                        $districtMap[ $districtId ] = $district;
                        break;
                    }
                }
            }
            $jobCreatorMap = [];
            foreach ( $job_creator_active_loker as $jobCreator ) {
                $jobCreatorMap[ $jobCreator[ 'id' ] ] = $jobCreator;
            }
            foreach ( $active_loker as &$job ) {
                $jobCreatorId = $job[ 'job_creator_id' ];
                if ( isset( $jobCreatorMap[ $jobCreatorId ] ) ) {
                    $job[ 'jc_name' ] = $jobCreatorMap[ $jobCreatorId ][ 'name' ];
                    $districtId = $jobCreatorMap[ $jobCreatorId ][ 'district_id' ];
                    if ( isset( $districtMap[ $districtId ] ) ) {
                        $job[ 'district' ] = $districtMap[ $districtId ][ 'name' ];
                    } else {
                        $job[ 'district' ] = 'Unknown';
                    }
                } else {
                    $job[ 'jc_name' ] = 'Unknown';
                    $job[ 'district' ] = 'Unknown';
                }
            }
            unset( $job );
            $jobCategoryIds_active_loker = array_column( $active_loker, 'job_category_id' );
            $job_category_active_loker = JobCategories::getAllJobCategoriesDataById( $jobCategoryIds_active_loker );
            $jobCategoryMap = [];
            foreach ( $job_category_active_loker as $jobCategory ) {
                $jobCategoryMap[ $jobCategory[ 'id' ] ] = $jobCategory;
            }
            foreach ( $active_loker as &$jobc ) {
                $jobCategoryId = $jobc[ 'job_category_id' ];
                if ( isset( $jobCategoryMap[ $jobCategoryId ] ) ) {
                    $jobc[ 'jcat_name' ] = $jobCategoryMap[ $jobCategoryId ][ 'name' ];
                } else {
                    $jobc[ 'jcat_name' ] = 'Unknown';
                }
            }
            unset( $jobc );

            if ( isset( $_SESSION[ 'user' ] ) ) {
                $user = $_SESSION[ 'user' ];
                $response = [
                    'active_loker' => $active_loker,
                    'posisi_lowongan' => $data_posisi_lowongan
                ];
                echo json_encode( $response );
            } else {
                $response = [
                    'active_loker' => $active_loker,
                    'posisi_lowongan' => $data_posisi_lowongan
                ];
                echo json_encode( $response );
            }
            exit;
        }
        return view( 'home/home_layout', [ 'url' => 'cariloker' ] );
    }

    static function detailloker()
 {
        if ( !isset( $_GET[ 'id' ] ) ) {
            setFlashMessage( 'danger', 'Maaf, loker tidak ditemukan' );
            header( 'Location: ' . BASEURL . 'home/cariloker' );
            exit;
        } else {
            $loker = JobVacancy::getJobVacancyById( $_GET[ 'id' ] );
            if ( $loker === null ) {
                setFlashMessage( 'danger', 'Maaf, loker tidak ditemukan' );
                header( 'Location: ' . BASEURL . 'home/cariloker' );
                exit;
            } else {
                $loker_category = JobCategories::getJobCategoryById( $loker[ 'job_category_id' ] );
                $loker_creator = JobCreators::getJobCreatorById( $loker[ 'job_creator_id' ] );
                $district = Districts::getDistrictById( $loker_creator[ 'district_id' ] );
                return view( 'home/home_layout', [ 'url' => 'detailloker', 'loker' => $loker, 'loker_category' => $loker_category, 'loker_creator' => $loker_creator, 'district' => $district ] );
            }
        }
    }

    static function lamarkerja()
 {
        if ( !isset( $_COOKIE[ 'token' ] ) || !isset( $_SESSION[ 'user' ] ) ) {
            header( 'Location: ' . BASEURL . 'login' );
            exit;
        }
        $token = $_COOKIE[ 'token' ];
        $user = Users::getUserByToken( $token );
        if ( !$user || $user[ 'username' ] !== $_SESSION[ 'user' ][ 'username' ] ) {
            unset( $_SESSION[ 'user' ] );
            setcookie( 'token', '', time() - 3600, '/' );
            header( 'Location: ' . BASEURL . 'login' );
            exit;
        } else {
            if ( $user[ 'role_id' ] != 2 ) {
                setFlashMessage( 'danger', 'Maaf, hanya pelamar yang bisa melamar lowongan kerja' );
                header( 'Location: '. BASEURL .'home/cariloker' );
                exit;
            } else {
                $id = $_GET[ 'id' ];
                $userId = $_SESSION[ 'user' ][ 'id' ];
                $jobseeker = JobSeekers::getJobSeekerByUserId( $userId );
                $jobseekerId = $jobseeker[ 'id' ];

                $existingApplications = JobApplications::getJobApplicationsByJobSeekerId( $jobseekerId );
                foreach ( $existingApplications as $application ) {
                    if ( $application[ 'job_vacancy_id' ] == $id ) {
                        setFlashMessage( 'danger', 'Maaf, anda sudah pernah melamar lowongan kerja ini' );
                        header( 'Location: ' . BASEURL . 'home/cariloker/detailloker?id=' . $id );
                        exit;
                    }
                }
                $loker = JobVacancy::getJobVacancyById( $id );
                if ( $loker === null ) {
                    setFlashMessage( 'danger', 'Maaf, loker tidak ditemukan' );
                    header( 'Location: ' . BASEURL . 'home/cariloker' );
                    exit;
                } else {
                    $loker_category = JobCategories::getJobCategoryById( $loker[ 'job_category_id' ] );
                    $loker_creator = JobCreators::getJobCreatorById( $loker[ 'job_creator_id' ] );
                    $district = Districts::getDistrictById( $loker_creator[ 'district_id' ] );
                    return view( 'home/home_layout', [ 'url' => 'lamarkerja', 'id' => $id, 'loker' => $loker, 'loker_category' => $loker_category, 'loker_creator' => $loker_creator, 'district' => $district ] );
                }
            }
        }
    }

    static function createJobApplication() {
        if ( !isset( $_COOKIE[ 'token' ] ) || !isset( $_SESSION[ 'user' ] ) ) {
            header( 'Location: ' . BASEURL . 'login' );
            exit;
        }
        $token = $_COOKIE[ 'token' ];
        $user = Users::getUserByToken( $token );
        if ( !$user || $user[ 'username' ] !== $_SESSION[ 'user' ][ 'username' ] ) {
            unset( $_SESSION[ 'user' ] );
            setcookie( 'token', '', time() - 3600, '/' );
            header( 'Location: ' . BASEURL . 'login' );
            exit;
        } else {
            $post = array_map( 'htmlspecialchars', $_POST );
            foreach ( $post as $key => $value ) {
                $post[ $key ] = htmlspecialchars_decode( $value );
            }
            $userId = $_SESSION[ 'user' ][ 'id' ];
            $jobseeker = JobSeekers::getJobSeekerByUserId( $userId );
            $jobseekerId = $jobseeker[ 'id' ];
            $jobvacancyId = $post[ 'id' ];

            $existingApplications = JobApplications::getJobApplicationsByJobSeekerId( $jobseekerId );
            foreach ( $existingApplications as $application ) {
                if ( $application[ 'job_vacancy_id' ] == $jobvacancyId ) {
                    echo json_encode( [ 'success' => false, 'message' => 'Anda sudah pernah mengirimkan lamaran untuk lowongan pekerjaan ini' ] );
                    exit;
                }
            }

            $data = [
                'job_seeker_id' => $jobseekerId,
                'job_vacancy_id' => $jobvacancyId
            ];
            $jobapplicationId = JobApplications::createJobApplication( $data );
            if ( $jobapplicationId ) {
                $result = JobApplicationsFiles::createJobApplicationFiles( $jobapplicationId );
                if ( $result == true ) {
                    echo json_encode( [ 'success' => true ] );
                    exit;
                } elseif ( $result == false ) {
                    echo json_encode( [ 'success' => false ] );
                    exit;
                }
            }
        }
    }
    static function riwayatlamaran() {
        if ( !isset( $_COOKIE[ 'token' ] ) || !isset( $_SESSION[ 'user' ] ) ) {
            header( 'Location: ' . BASEURL . 'login' );
            exit;
        }
        $token = $_COOKIE[ 'token' ];
        $user = Users::getUserByToken( $token );
        if ( !$user || $user[ 'username' ] !== $_SESSION[ 'user' ][ 'username' ] ) {
            unset( $_SESSION[ 'user' ] );
            setcookie( 'token', '', time() - 3600, '/' );
            header( 'Location: ' . BASEURL . 'login' );
            exit;
        } else {
            if ( $_SERVER[ 'REQUEST_METHOD' ] === 'GET' && isset( $_SERVER[ 'HTTP_X_REQUESTED_WITH' ] ) && strtolower( $_SERVER[ 'HTTP_X_REQUESTED_WITH' ] ) === 'xmlhttprequest' ) {
                if ( isset( $_SESSION[ 'user' ] ) ) {
                    $user = $_SESSION[ 'user' ];
                    $userId = $user[ 'id' ];
                    $jobSeeker = JobSeekers::getJobSeekerByUserId( $userId );
                    if ( $jobSeeker ) {
                        $jobSeekerId = $jobSeeker[ 'id' ];
                        $lamaran = JobApplications::getJobApplicationsByJobSeekerId( $jobSeekerId );
                        $jobVacancyIds = array_column( $lamaran, 'job_vacancy_id' );
                        $loker = JobVacancy::getJobVacancyByIds( $jobVacancyIds );
                        $jobApplicationIds = array_column( $lamaran, 'id' );
                        $dokumen_lamaran = JobApplicationsFiles::getJobApplicationsFilesByApplicationIds( $jobApplicationIds );

                        $data_posisi_lowongan = JobCategories::getAllJobCategories();
                        $jobCreatorIds_loker = array_column( $loker, 'job_creator_id' );
                        $job_creator_loker = JobCreators::getAllJobCreatorsDataById( $jobCreatorIds_loker );
                        $district_data = Districts::getAllDistricts();
                        $districtMap = [];
                        foreach ( $job_creator_loker as $jobCreator ) {
                            $districtId = $jobCreator[ 'district_id' ];
                            foreach ( $district_data as $district ) {
                                if ( $district[ 'id' ] == $districtId ) {
                                    $districtMap[ $districtId ] = $district;
                                    break;
                                }
                            }
                        }
                        $jobCreatorMap = [];
                        foreach ( $job_creator_loker as $jobCreator ) {
                            $jobCreatorMap[ $jobCreator[ 'id' ] ] = $jobCreator;
                        }
                        foreach ( $loker as &$job ) {
                            $jobCreatorId = $job[ 'job_creator_id' ];
                            if ( isset( $jobCreatorMap[ $jobCreatorId ] ) ) {
                                $job[ 'jc_name' ] = $jobCreatorMap[ $jobCreatorId ][ 'name' ];
                                $districtId = $jobCreatorMap[ $jobCreatorId ][ 'district_id' ];
                                if ( isset( $districtMap[ $districtId ] ) ) {
                                    $job[ 'district' ] = $districtMap[ $districtId ][ 'name' ];
                                } else {
                                    $job[ 'district' ] = 'Unknown';
                                }
                            } else {
                                $job[ 'jc_name' ] = 'Unknown';
                                $job[ 'district' ] = 'Unknown';
                            }
                        }
                        unset( $job );
                        $jobCategoryIds_loker = array_column( $loker, 'job_category_id' );
                        $job_category_loker = JobCategories::getAllJobCategoriesDataById( $jobCategoryIds_loker );
                        $jobCategoryMap = [];
                        foreach ( $job_category_loker as $jobCategory ) {
                            $jobCategoryMap[ $jobCategory[ 'id' ] ] = $jobCategory;
                        }
                        foreach ( $loker as &$jobc ) {
                            $jobCategoryId = $jobc[ 'job_category_id' ];
                            if ( isset( $jobCategoryMap[ $jobCategoryId ] ) ) {
                                $jobc[ 'jcat_name' ] = $jobCategoryMap[ $jobCategoryId ][ 'name' ];
                            } else {
                                $jobc[ 'jcat_name' ] = 'Unknown';
                            }
                        }
                        unset( $jobc );
                        $response = [
                            'lamaran' => $lamaran,
                            'loker' => $loker,
                            'dokumen_lamaran' => $dokumen_lamaran,
                            'posisi_lowongan' => $data_posisi_lowongan
                        ];

                        echo json_encode( $response );
                        exit;
                    } else {
                        $errorResponse = [
                            'error' => 'Job seeker profile not found for the user'
                        ];
                        echo json_encode( $errorResponse );
                        exit;
                    }
                } else {
                    $errorResponse = [
                        'error' => 'Maaf, Anda belum login'
                    ];
                    echo json_encode( $errorResponse );
                    exit;
                }
            }
            return view( 'home/home_layout', [ 'url' => 'riwayatlamaran' ] );
        }
    }

    static function detailriwayatlamaran() {
        if ( !isset( $_COOKIE[ 'token' ] ) || !isset( $_SESSION[ 'user' ] ) ) {
            header( 'Location: ' . BASEURL . 'login' );
            exit;
        }
        $token = $_COOKIE[ 'token' ];
        $user = Users::getUserByToken( $token );
        if ( !$user || $user[ 'username' ] !== $_SESSION[ 'user' ][ 'username' ] ) {
            unset( $_SESSION[ 'user' ] );
            setcookie( 'token', '', time() - 3600, '/' );
            header( 'Location: ' . BASEURL . 'login' );
            exit;
        } else {
            if ( !isset( $_GET[ 'id' ] ) ) {
                setFlashMessage( 'danger', 'Maaf, loker tidak ditemukan' );
                header( 'Location: ' . BASEURL . 'home/cariloker' );
                exit;
            } else {
                if ( isset( $_SESSION[ 'user' ] ) ) {
                    $user = $_SESSION[ 'user' ];
                    $userId = $user[ 'id' ];
                    $jobSeeker = JobSeekers::getJobSeekerByUserId( $userId );
                    if ( $jobSeeker ) {
                        $jobSeekerId = $jobSeeker[ 'id' ];
                        $jobvacancyId = $_GET[ 'id' ];
                        $loker = JobVacancy::getJobVacancyById( $jobvacancyId );
                        $lamaran = JobApplications::getJobApplicationByJobSeekerIdandJobVacancyId( $jobSeekerId, $jobvacancyId );
                        $dokumen_lamaran = JobApplicationsFiles::getJobApplicationsFilesByJobApplicationId( $lamaran[ 'id' ] );
                        if ( $loker === null ) {
                            setFlashMessage( 'danger', 'Maaf, loker tidak ditemukan' );
                            header( 'Location: ' . BASEURL . 'home/cariloker' );
                            exit;
                        } else {
                            $loker_category = JobCategories::getJobCategoryById( $loker[ 'job_category_id' ] );
                            $loker_creator = JobCreators::getJobCreatorById( $loker[ 'job_creator_id' ] );
                            $district = Districts::getDistrictById( $loker_creator[ 'district_id' ] );
                            return view( 'home/home_layout', [ 'url' => 'detailriwayatlamaran', 'loker' => $loker, 'loker_category' => $loker_category, 'loker_creator' => $loker_creator, 'district' => $district, 'lamaran' => $lamaran, 'dokumen_lamaran' => $dokumen_lamaran ] );
                        }
                    }
                } else {
                    setFlashMessage( 'danger', 'Maaf, Anda belum login' );
                    header( 'Location: ' . BASEURL . 'login' );
                    exit;
                }
            }
        }
    }

}
