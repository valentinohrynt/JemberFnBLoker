<?php
include_once 'models/visitor_logs.php';
include_once 'models/users.php';
include_once 'models/job_vacancy.php';
include_once 'models/job_creators.php';
include_once 'models/job_categories.php';
include_once 'models/districts.php';
include_once 'models/roles.php';
include_once 'function/main.php';
include_once 'app/config/static.php';

class DashboardController
 {
    static function index()
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
            if ( $user[ 'role_id' ] == '1' ) {
                if ( $_SERVER[ 'REQUEST_METHOD' ] === 'GET' && isset( $_SERVER[ 'HTTP_X_REQUESTED_WITH' ] ) && strtolower( $_SERVER[ 'HTTP_X_REQUESTED_WITH' ] ) === 'xmlhttprequest' ) {
                    $loker = JobVacancy::getAllTodayJobVacancy();
                    $total_visitors = VisitorLogs::getTotalVisitors();
                    $total_loker = JobVacancy::getTotalJobVacancy();
                    $jobCreatorIds = array_column( $loker, 'job_creator_id' );
                    $job_creator = JobCreators::getAllJobCreatorsDataById( $jobCreatorIds );
                    $jobCreatorMap = [];
                    foreach ( $job_creator as $jobCreator ) {
                        $jobCreatorMap[ $jobCreator[ 'id' ] ] = $jobCreator;
                    }
                    foreach ( $loker as &$job ) {
                        $jobCreatorId = $job[ 'job_creator_id' ];
                        if ( isset( $jobCreatorMap[ $jobCreatorId ] ) ) {
                            $job[ 'jc_name' ] = $jobCreatorMap[ $jobCreatorId ][ 'name' ];
                        } else {
                            $job[ 'jc_name' ] = 'Unknown';
                        }
                    }
                    unset( $job );
                    $user = $_SESSION[ 'user' ];
                    $response = [
                        'user' => $user,
                        'loker' => $loker,
                        'total_visitors' => $total_visitors,
                        'total_loker' => $total_loker
                    ];
                    echo json_encode( $response );
                    exit;
                } else {
                    return view( 'dashboard/dashboard_layout', [ 'url' => 'dashboard' ] );
                }
            }
            if ( $user[ 'role_id' ] == '2' ) {
                header( 'Location: home' );
                exit;
            }
            if ( $user[ 'role_id' ] == '3' ) {
                $job_creator = JobCreators::getJobCreatorByUserId( $user[ 'id' ] );
                if ( $_SERVER[ 'REQUEST_METHOD' ] === 'GET' && isset( $_SERVER[ 'HTTP_X_REQUESTED_WITH' ] ) && strtolower( $_SERVER[ 'HTTP_X_REQUESTED_WITH' ] ) === 'xmlhttprequest' ) {
                    $loker = JobVacancy::getAllJobVacancyByJobCreatorId( $job_creator[ 'id' ] );
                    $total_visitors = VisitorLogs::getTotalVisitors();
                    $total_loker = JobVacancy::getTotalJobVacancy();
                    $user = $_SESSION[ 'user' ];
                    $response = [
                        'user' => $user,
                        'loker' => $loker,
                        'total_visitors' => $total_visitors,
                        'total_loker' => $total_loker
                    ];

                    echo json_encode( $response );
                    exit;
                } else {
                    return view( 'dashboard/dashboard_layout', [ 'url' => 'dashboard' ] );
                }
            }
        }
    }

    static function getTotalVisitorsperDay() {
        try {
            $total_visitors_data = VisitorLogs::getTotalVisitorsperDay();
            header( 'Content-Type: application/json' );
            echo json_encode( $total_visitors_data );
            exit;
        } catch ( Exception $e ) {
            header( 'Content-Type: application/json' );
            echo json_encode( array( 'success' => false, 'error' => $e->getMessage() ) );
            exit;
        }
    }

    static function buatloker()
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
            if ( $user[ 'role_id' ] == '2' ) {
                header( 'Location: home' );
                exit;
            } elseif ( $user[ 'role_id' ] == '3' ) {

                $data_wilayah = Districts::getAllDistricts();
                $data_posisi_lowongan = JobCategories::getAllJobCategories();
                return view( 'dashboard/dashboard_layout', [ 'url' => 'buatloker', 'wilayah' => $data_wilayah, 'posisi_lowongan' => $data_posisi_lowongan ] );
            } else {
                header( 'Location: dashboard' );
                exit;
            }
        }
    }

    static function daftarloker()
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
            if ( $user[ 'role_id' ] == '1' ) {
                if ( $_SERVER[ 'REQUEST_METHOD' ] === 'GET' && isset( $_SERVER[ 'HTTP_X_REQUESTED_WITH' ] ) && strtolower( $_SERVER[ 'HTTP_X_REQUESTED_WITH' ] ) === 'xmlhttprequest' ) {
                    $loker = JobVacancy::getAllJobVacancy();
                    $active_loker = JobVacancy::getAllActiveJobVacancy();
                    $inactive_loker = JobVacancy::getAllInactiveJobVacancy();
                    $data_posisi_lowongan = JobCategories::getAllJobCategories();
                    $jobCreatorIds_active_loker = array_column( $active_loker, 'job_creator_id' );
                    $job_creator_active_loker = JobCreators::getAllJobCreatorsDataById( $jobCreatorIds_active_loker );
                    // Mapping job_creator_id ke job_creator data
                    $jobCreatorMap = [];
                    foreach ( $job_creator_active_loker as $jobCreator ) {
                        $jobCreatorMap[ $jobCreator[ 'id' ] ] = $jobCreator;
                    }
                    foreach ( $active_loker as &$job ) {
                        $jobCreatorId = $job[ 'job_creator_id' ];
                        if ( isset( $jobCreatorMap[ $jobCreatorId ] ) ) {
                            $job[ 'jc_name' ] = $jobCreatorMap[ $jobCreatorId ][ 'name' ];
                        } else {
                            $job[ 'jc_name' ] = 'Unknown';
                        }
                    }
                    unset( $job );
                    $jobCreatorIds_inactive_loker = array_column( $inactive_loker, 'job_creator_id' );
                    $job_creator_inactive_loker = JobCreators::getAllJobCreatorsDataById( $jobCreatorIds_inactive_loker );
                    $jobCreatorMap = [];
                    foreach ( $job_creator_inactive_loker as $jobCreator ) {
                        $jobCreatorMap[ $jobCreator[ 'id' ] ] = $jobCreator;
                    }
                    foreach ( $inactive_loker as &$job ) {
                        $jobCreatorId = $job[ 'job_creator_id' ];
                        if ( isset( $jobCreatorMap[ $jobCreatorId ] ) ) {
                            $job[ 'jc_name' ] = $jobCreatorMap[ $jobCreatorId ][ 'name' ];
                        } else {
                            $job[ 'jc_name' ] = 'Unknown';
                        }
                    }
                    unset( $job );
                    $user = $_SESSION[ 'user' ];
                    $response = [
                        'user' => $user,
                        'active_loker' => $active_loker,
                        'inactive_loker' => $inactive_loker,
                        'posisi_lowongan' => $data_posisi_lowongan
                    ];
                    echo json_encode( $response );
                    exit;
                } else {
                    return view( 'dashboard/dashboard_layout', [ 'url' => 'daftarloker' ] );
                }
            }
            if ( $user[ 'role_id' ] == '2' ) {
                header( 'Location: home' );
                exit;
            }
            if ( $user[ 'role_id' ] == '3' ) {
                $job_creator = JobCreators::getJobCreatorByUserId( $user[ 'id' ] );
                if ( $_SERVER[ 'REQUEST_METHOD' ] === 'GET' && isset( $_SERVER[ 'HTTP_X_REQUESTED_WITH' ] ) && strtolower( $_SERVER[ 'HTTP_X_REQUESTED_WITH' ] ) === 'xmlhttprequest' ) {
                    $active_loker = JobVacancy::getAllActiveJobVacancyByJobCreatorId( $job_creator[ 'id' ] );
                    $inactive_loker = JobVacancy::getAllInactiveJobVacancyByJobCreatorId( $job_creator[ 'id' ] );
                    $data_posisi_lowongan = JobCategories::getAllJobCategories();
                    $user = $_SESSION[ 'user' ];
                    $response = [
                        'active_loker' => $active_loker,
                        'inactive_loker' => $inactive_loker,
                        'user' => $user,
                        'posisi_lowongan' => $data_posisi_lowongan
                    ];
                    echo json_encode( $response );
                    exit;
                } else {
                    return view( 'dashboard/dashboard_layout', [ 'url' => 'daftarloker' ] );
                }
            }
        }
    }

    static function createJobVacancy() {
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
            if ( $user[ 'role_id' ] == '3' ) {
                $post = array_map( 'htmlspecialchars', $_POST );
                foreach ( $post as $key => $value ) {
                    $post[ $key ] = htmlspecialchars_decode( $value );
                }
                $userId = $_SESSION[ 'user' ][ 'id' ];

                $job_creator = JobCreators::getJobCreatorByUserId( $userId );
                $job_creatorId = $job_creator[ 'id' ];
                $JobVacancy = JobVacancy::createJobVacancy( [
                    'job_creator_id' => $job_creatorId,
                    'title' => $post[ 'd' ],
                    'job_category_id' => $post[ 'e' ],
                    'requirement' => $post[ 'f' ],
                    'job_time' => $post[ 'h' ],
                    'workplace' => $post[ 'i' ],
                ] );

                if ( $JobVacancy ) {
                    echo json_encode( [ 'success' => true ] );
                } else {
                    echo json_encode( [ 'success' => false, 'message' => 'Terjadi kesalahan saat membuat informasi loker. (Pastikan semua inputan sudah diisi!)' ] );
                }

            } else {
                header( 'Location: ' .BASEURL. 'dashboard' );
                exit;
            }
        }
    }

    static function updateJobVacancy()
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
            if ( $user [ 'role_id' ] == '3' || $user [ 'role_id' ] == '1' ) {
                $post = array_map( 'htmlspecialchars', $_POST );
                foreach ( $post as $key => $value ) {
                    $post[ $key ] = htmlspecialchars_decode( $value );
                }
                $id = $post[ 'id' ];
                $data = [
                    'title' => $post[ 'd' ],
                    'job_category_id' => $post[ 'e' ],
                    'requirement' => $post[ 'f' ],
                    'job_time' => $post[ 'h' ],
                    'workplace' => $post[ 'i' ],
                ];
                $result = JobVacancy::updateJobVacancy( $id, $data );

                if ( $result ) {
                    echo json_encode( [ 'success' => true ] );
                    exit;
                } else {
                    echo json_encode( [ 'success' => false, 'message' => 'Failed to update data' ] );
                    exit;
                }
            } else {
                header( 'Location: home' );
                exit;
            }
        }

    }

    static function updateStatus()
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
            if ( $user [ 'role_id' ] == '3' || $user [ 'role_id' ] == '1' ) {
                $post = array_map( 'htmlspecialchars', $_POST );
                foreach ( $post as $key => $value ) {
                    $post[ $key ] = htmlspecialchars_decode( $value );
                }
                $data = [
                    'id' => $post[ 'id' ],
                    'status' => $post[ 'status' ]
                ];
                $result = JobVacancy::updateStatus( $data );

                if ( $result ) {
                    echo json_encode( [ 'success' => true ] );
                    exit;
                } else {
                    echo json_encode( [ 'success' => false, 'message' => 'Gagal mengubah status!' ] );
                    exit;
                }

            } else {
                header( 'Location: home' );
                exit;
            }
        }
    }

    static function pengguna()
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
        }
        if ( $user[ 'role_id' ] == '1' ) {
            $rolesData = Users::getUsersData();
            $labels = [];
            $data = [];

            foreach ( $rolesData[ 'labels' ] as $roleId ) {
                $roleName = Roles::getRoleNameById( $roleId );

                $labels[] = $roleName;
            }
            $data = $rolesData[ 'data' ];

            return view ( 'dashboard/dashboard_layout', [ 'url' => 'pengguna', 'labels' => $labels, 'data' => $data ] );
        } else {
            header( 'Location: '.BASEURL.'dashboard' );
            exit;
        }
    }
    static function lamaran() {
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
            if ( $user[ 'role_id' ] == '3' ) {
                $userId = $_SESSION[ 'user' ][ 'id' ];
                $jobCreator = JobCreators::getJobCreatorByUserId( $userId );
                $loker = JobVacancy::getAllJobVacancyByJobCreatorId( $jobCreator[ 'id' ] );
                // Initialize an empty array to store job vacancies with applications
                $lokerWithApplications = [];

                foreach ( $loker as $job ) {
                    $jobApplications = JobApplications::getJobApplicationsByJobVacancyId( $job[ 'id' ] );

                    // Check if there are applications for this job vacancy
                    if ( !empty( $jobApplications ) ) {
                        $job[ 'applications' ] = $jobApplications;
                        // Add applications to the job vacancy
                        $job[ 'application_count' ] = count( $jobApplications );
                        // Count of applications
                        $lokerWithApplications[] = $job;
                        // Add this job vacancy to the list
                    }
                }

                return view( 'dashboard/dashboard_layout', [ 'url' => 'lamaran', 'loker' => $lokerWithApplications ] );
            } else {
                header( 'Location: ' .BASEURL. 'dashboard' );
                exit;
            }
        }
    }
    static function daftarlamaran() {
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
            if ( $user[ 'role_id' ] == '3' ) {
                $loker_id = $_GET[ 'id' ];
                $userId = $_SESSION[ 'user' ][ 'id' ];
                $lamaran = JobApplications::getProcessJobApplicationsByJobVacancyId( $loker_id );
                $lamaranConfirmed = JobApplications::getConfirmedJobApplicationsByJobVacancyId( $loker_id );
                $lamaranWithJobSeekers = [];
                $lamaranConfirmedWithJobSeekers = [];

                foreach ( $lamaran as $application ) {
                    $jobSeeker = JobSeekers::getJobSeekerById( $application[ 'job_seeker_id' ] );

                    // Ambil data district jika ada
                    if ( isset( $jobSeeker[ 'district_id' ] ) ) {
                        $district = Districts::getDistrictById( $jobSeeker[ 'district_id' ] );
                        $jobSeeker[ 'district' ] = $district;
                    }

                    $application[ 'job_seeker' ] = $jobSeeker;
                    $lamaranWithJobSeekers[] = $application;
                }

                foreach ( $lamaranConfirmed as $application ) {
                    $jobSeeker = JobSeekers::getJobSeekerById( $application[ 'job_seeker_id' ] );

                    // Ambil data district jika ada
                    if ( isset( $jobSeeker[ 'district_id' ] ) ) {
                        $district = Districts::getDistrictById( $jobSeeker[ 'district_id' ] );
                        $jobSeeker[ 'district' ] = $district;
                    }

                    $application[ 'job_seeker' ] = $jobSeeker;
                    $lamaranConfirmedWithJobSeekers[] = $application;
                }

                return view( 'dashboard/dashboard_layout', [ 'url' => 'daftarlamaran', 'lamaran' => $lamaranWithJobSeekers, 'lamaranConfirmed' => $lamaranConfirmedWithJobSeekers ] );
            } else {
                header( 'Location: ' .BASEURL. 'dashboard' );
                exit;
            }
        }
    }
    static function detaillamaran() {
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
            if ( $user[ 'role_id' ] == '3' ) {
                $lamaran_id = $_GET[ 'id' ];
                $lamaran = JobApplications::getJobApplicationById( $lamaran_id );
                $loker = JobVacancy::getJobVacancyById( $lamaran[ 'job_vacancy_id' ] );
                $jobSeeker = JobSeekers::getJobSeekerById( $lamaran[ 'job_seeker_id' ] );
                $district = Districts::getDistrictById( $jobSeeker[ 'district_id' ] );
                $dokumen = JobApplicationsFiles::getJobApplicationsFilesByJobApplicationId( $lamaran_id );
                $jobSeekerUser = Users::getUserById( $jobSeeker[ 'user_id' ] );
                $posisi = JobCategories::getJobCategoryById( $loker[ 'job_category_id' ] );
                return view( 'dashboard/dashboard_layout', [ 'url' => 'detaillamaran', 'lamaran' => $lamaran, 'loker' => $loker, 'jobSeeker' => $jobSeeker, 'district' => $district, 'dokumen' => $dokumen, 'jobSeekerUser' => $jobSeekerUser, 'posisi' => $posisi ] );
            } else {
                header( 'Location: '. BASEURL .'dashboard' );
                exit;
            }
        }
    }
    static function konfirmasilamaran()
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
            if ( $user[ 'role_id' ] == '3' ) {
                $post = array_map( 'htmlspecialchars', $_POST );
                foreach ( $post as $key => $value ) {
                    $post[ $key ] = htmlspecialchars_decode( $value );
                }
                $data = [
                    'id' => $post[ 'id' ],
                    'status' => $post[ 'status' ]
                ];
                $result = JobApplications::updateStatus( $data );

                if ( $result ) {
                    echo json_encode( [ 'success' => true ] );
                    exit;
                } else {
                    echo json_encode( [ 'success' => false, 'message' => 'Gagal mengubah status!' ] );
                    exit;
                }
            } else {
                header( 'Location:' . BASEURL . 'dashboard' );
                exit;
            }
        }
    }
    static function pengguna_jobcreator() {
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
            if ( $user[ 'role_id' ] == '1' ) {
                $jobCreator = JobCreators::getAllActiveJobCreators();
                $jobCreatorInactive = JobCreators::getAllInactiveJobCreators();

                $jcWithDistrict = [];
                $inactivejcWithDistrict = [];

                foreach ( $jobCreator as $jc ) {
                    $district = Districts::getDistrictById( $jc[ 'district_id' ] );
                    $jc[ 'district' ] = $district;
                    $jcWithDistrict[] = $jc;
                }
                foreach ( $jobCreatorInactive as $jc ) {
                    $district = Districts::getDistrictById( $jc[ 'district_id' ] );
                    $jc[ 'district' ] = $district;
                    $inactivejcWithDistrict[] = $jc;
                }

                return view( 'dashboard/dashboard_layout', [ 'url' => 'pengguna_jobcreator', 'jobCreator' => $jcWithDistrict, 'jobCreatorInactive' => $inactivejcWithDistrict ] );
            } else {
                header( 'Location:' . BASEURL . 'dashboard' );
                exit;
            }
        }
    }
    static function pengguna_jobseeker() {
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
            if ( $user[ 'role_id' ] == '1' ) {
                $jobSeeker = JobSeekers::getAllActiveJobSeekers();
                $jobSeekerInactive = JobSeekers::getAllInactiveJobSeekers();

                $jcWithDistrict = [];
                $inactivejcWithDistrict = [];

                foreach ( $jobSeeker as $jc ) {
                    $district = Districts::getDistrictById( $jc[ 'district_id' ] );
                    $jc[ 'district' ] = $district;
                    $jcWithDistrict[] = $jc;
                }
                foreach ( $jobSeekerInactive as $jc ) {
                    $district = Districts::getDistrictById( $jc[ 'district_id' ] );
                    $jc[ 'district' ] = $district;
                    $inactivejcWithDistrict[] = $jc;
                }

                return view( 'dashboard/dashboard_layout', [ 'url' => 'pengguna_jobseeker', 'jobSeeker' => $jcWithDistrict, 'jobSeekerInactive' => $inactivejcWithDistrict ] );
            } else {
                header( 'Location:' . BASEURL . 'dashboard' );
                exit;
            }
        }
    }
    static function detailpengguna_jobcreator() {
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
            if ( $user[ 'role_id' ] == '1' ) {
                $id = $_GET[ 'id' ];
                $data = JobCreators::getJobCreatorById( $id );
                $dataUser = Users::getUserById( $data[ 'user_id' ] );
                $district = Districts::getDistrictById( $data[ 'district_id' ] );
                return view( 'dashboard/dashboard_layout', [ 'url' => 'detailpengguna_jobcreator', 'data' => $data, 'dataUser' => $dataUser, 'district' => $district ] );
            } else {
                header( 'Location:' . BASEURL . 'dashboard' );
                exit;
            }
        }
    }
    static function detailpengguna_jobseeker() {
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
            if ( $user[ 'role_id' ] == '1' ) {
                $id = $_GET[ 'id' ];
                $data = JobSeekers::getJobSeekerById( $id );
                $dataUser = Users::getUserById( $data[ 'user_id' ] );
                $district = Districts::getDistrictById( $data[ 'district_id' ] );
                return view( 'dashboard/dashboard_layout', [ 'url' => 'detailpengguna_jobseeker', 'data' => $data, 'dataUser' => $dataUser, 'district' => $district ] );
            } else {
                header( 'Location:' . BASEURL . 'dashboard' );
                exit;
            }
        }
    }
    static function nonaktifkan_jobcreator() {
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
            if ( $user[ 'role_id' ] == '1' ) {
                $post = array_map( 'htmlspecialchars', $_POST );
                foreach ( $post as $key => $value ) {
                    $post[ $key ] = htmlspecialchars_decode( $value );
                }
                $userId = $post[ 'a' ];
                $jcId = $post[ 'b' ];
                $nonaktifkan = Users::disableUser( $userId );
                $nonaktifkanLoker = JobVacancy::disableJobVacancyByJobCreatorId( $jcId );
                if ( $nonaktifkan && $nonaktifkanLoker ) {
                    setFlashMessage( 'success', 'Berhasil menonaktifkan pengguna!' );
                    header( 'Location:' . BASEURL . 'dashboard/pengguna/jobcreator' );
                    exit;
                } else {
                    setFlashMessage( 'danger', 'Gagal menonaktifkan pengguna!' );
                    header( 'Location:' . BASEURL . 'dashboard/pengguna/jobcreator/detailjobcreator?id=' . $jcId . '' );
                    exit;
                }
            } else {
                header( 'Location:' . BASEURL . 'dashboard' );
                exit;
            }
        }
    }

    static function nonaktifkan_jobseeker() {
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
            if ( $user[ 'role_id' ] == '1' ) {
                $post = array_map( 'htmlspecialchars', $_POST );
                foreach ( $post as $key => $value ) {
                    $post[ $key ] = htmlspecialchars_decode( $value );
                }
                $userId = $post[ 'a' ];
                $jsId = $post[ 'b' ];
                $nonaktifkan = Users::disableUser( $userId );
                if ( $nonaktifkan ) {
                    setFlashMessage( 'success', 'Berhasil menonaktifkan pengguna!' );
                    header( 'Location:' . BASEURL . 'dashboard/pengguna/jobseeker' );
                    exit;
                } else {
                    setFlashMessage( 'danger', 'Gagal menonaktifkan pengguna!' );
                    header( 'Location:' . BASEURL . 'dashboard/pengguna/jobseeker/detailjobseeker?id=' . $jsId . '' );
                    exit;
                }
            } else {
                header( 'Location:' . BASEURL . 'dashboard' );
                exit;
            }
        }
    }

}