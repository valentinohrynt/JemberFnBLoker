<?php
include_once 'models/job_creators.php';
include_once 'models/districts.php';
include_once 'models/job_seekers.php';
include_once 'function/main.php';
include_once 'app/config/static.php';

class ProfileController
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
            $userId = $_SESSION[ 'user' ][ 'id' ];
            $roleId = $_SESSION[ 'user' ][ 'role_id' ];
            if ( $roleId === '2' ) {
                $profile = JobSeekers::getJobSeekerByUserId( $userId );
                $profile[ 'district' ] = Districts::getDistrictById( $profile[ 'district_id' ] );
                return view( 'profile/profile_layout', [ 'url' => 'profile', 'profile' => $profile ] );
            } else if ( $roleId === '3' ) {
                $profile = JobCreators::getJobCreatorByUserId( $userId );
                $profile[ 'district' ] = Districts::getDistrictById( $profile[ 'district_id' ] );
                return view( 'profile/profile_layout', [ 'url' => 'profile', 'profile' => $profile ] );
            } else {
                return view( 'home/home_layout', [ 'url' => 'home' ] );
            }
        }
    }
    static function ubahprofil() {
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
            $userId = $_SESSION[ 'user' ][ 'id' ];
            $roleId = $_SESSION[ 'user' ][ 'role_id' ];
            if ( $roleId === '2' ) {
                $profile = JobSeekers::getJobSeekerByUserId( $userId );
                $profile[ 'district' ] = Districts::getDistrictById( $profile[ 'district_id' ] );
                $districts = Districts::getAllDistricts();
                return view( 'profile/ubahprofile_layout', [ 'url' => 'ubahprofile', 'profile' => $profile, 'districts' => $districts ] );
            } else if ( $roleId === '3' ) {
                $profile = JobCreators::getJobCreatorByUserId( $userId );
                $profile[ 'district' ] = Districts::getDistrictById( $profile[ 'district_id' ] );
                $districts = Districts::getAllDistricts();
                return view( 'profile/ubahprofile_layout', [ 'url' => 'ubahprofile', 'profile' => $profile, 'districts' => $districts ] );
            } else {
                return view( 'home/home_layout', [ 'url' => 'home' ] );
            }       
        }
    }

    static function simpanubahprofil() {
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
            try {
                $userId = $_SESSION[ 'user' ][ 'id' ];
                $roleId = $_SESSION[ 'user' ][ 'role_id' ];
                $post = array_map( 'htmlspecialchars', $_POST );
                foreach ( $post as $key => $value ) {
                    $post[ $key ] = htmlspecialchars_decode( $value );
                }
                $oldUsername = $_SESSION[ 'user' ][ 'username' ];
                $oldEmail = $_SESSION[ 'user' ][ 'email' ];
    
                if ( $roleId === '2' ) {
                    $profile = JobSeekers::getJobSeekerByUserId( $userId );
                    $jobSeekerId = $profile[ 'id' ];
                    $data = [
                        'id' => $userId,
                        'password' => $post[ 'password' ],
                    ];
                    $checkPassword = Users::checkPassword( $data );
                    if ( $checkPassword === true ) {
                        // Cek duplikasi username
                        if ( $post[ 'username' ] !== $oldUsername ) {
                            $isUsernameTaken = Users::isUsernameTaken( $post[ 'username' ], $userId );
                            if ( $isUsernameTaken ) {
                                echo json_encode( [ 'status' => 'error', 'message' => 'Username sudah digunakan' ] );
                                return;
                            }
                        }
    
                        // Cek duplikasi email
                        if ( $post[ 'email' ] !== $oldEmail ) {
                            $isEmailTaken = Users::isEmailTaken( $post[ 'email' ], $userId );
                            if ( $isEmailTaken ) {
                                echo json_encode( [ 'status' => 'error', 'message' => 'Email sudah digunakan' ] );
                                return;
                            }
                        }
    
                        // Update data user jika ada perubahan
                        $dataUser = [
                            'id' => $userId
                        ];
                        if ( $post[ 'username' ] !== $oldUsername ) {
                            $dataUser[ 'username' ] = $post[ 'username' ];
                        }
                        if ( $post[ 'email' ] !== $oldEmail ) {
                            $dataUser[ 'email' ] = $post[ 'email' ];
                        }
    
                        // Jika ada perubahan username atau email, lakukan update
                        if ( count( $dataUser ) > 1 ) {
                            $userUpdated = Users::updateUser( $dataUser );
                            if ( !$userUpdated ) {
                                throw new Exception( 'Gagal memperbarui profil pengguna.' );
                            }
                        }
    
                        // Update data job seeker
                        $dataJobSeeker = [
                            'id' => $jobSeekerId,
                            'name' => $post[ 'name' ],
                            'phone' => $post[ 'phone' ],
                            'gender' => $post[ 'gender' ],
                            'age' => $post[ 'age' ],
                            'lat' => $post[ 'lat' ],
                            'lng' => $post[ 'lng' ],
                            'street' => $post[ 'street' ],
                            'district_id' => $post[ 'district_id' ],
                        ];
                        if ( !isset( $_FILES[ 'image' ][ 'error' ] ) == UPLOAD_ERR_OK ) {
                            $dataJobSeeker[ 'profile_image' ] = $_FILES[ 'image' ];
                        }
                        $jobSeekerUpdated = JobSeekers::updateJobSeeker( $dataJobSeeker );
                        if ( !$jobSeekerUpdated ) {
                            throw new Exception( 'Gagal memperbarui profil pencari kerja, pastikan ada perubahan data.' );
                        }
    
                        echo json_encode( [ 'status' => 'success', 'message' => 'Profil berhasil diubah' ] );
                    } else {
                        echo json_encode( [ 'status' => 'error', 'message' => 'Password lama tidak sesuai' ] );
                        return;
                    }
                } else if ( $roleId === '3' ) {
                    $profile = JobCreators::getJobCreatorByUserId( $userId );
                    $jobSeekerId = $profile[ 'id' ];
                    $data = [
                        'id' => $userId,
                        'password' => $post[ 'password' ],
                    ];
                    $checkPassword = Users::checkPassword( $data );
                    if ( $checkPassword === true ) {
                        // Cek duplikasi username
                        if ( $post[ 'username' ] !== $oldUsername ) {
                            $isUsernameTaken = Users::isUsernameTaken( $post[ 'username' ], $userId );
                            if ( $isUsernameTaken ) {
                                echo json_encode( [ 'status' => 'error', 'message' => 'Username sudah digunakan' ] );
                                return;
                            }
                        }
                        // Cek duplikasi email
                        if ( $post[ 'email' ] !== $oldEmail ) {
                            $isEmailTaken = Users::isEmailTaken( $post[ 'email' ], $userId );
                            if ( $isEmailTaken ) {
                                echo json_encode( [ 'status' => 'error', 'message' => 'Email sudah digunakan' ] );
                                return;
                            }
                        }
                        // Update data user jika ada perubahan
                        $dataUser = [
                            'id' => $userId,
                            'username' => $post[ 'username' ],
                            'email' => $post[ 'email' ],
                        ];
    
                        // Jika ada perubahan username atau email, lakukan update
                        if ( count( $dataUser ) > 1 ) {
                            $userUpdated = Users::updateUser( $dataUser );
                            if ( !$userUpdated ) {
                                throw new Exception( 'Gagal memperbarui profil pengguna.' );
                            }
                        }
    
                        // Update data job seeker
                        $dataJobCreator = [
                            'id' => $jobSeekerId,
                            'name' => $post[ 'name' ],
                            'phone' => $post[ 'phone' ],
                            'lat' => $post[ 'lat' ],
                            'lng' => $post[ 'lng' ],
                            'street' => $post[ 'street' ],
                            'district_id' => $post[ 'district_id' ],
                        ];
                        if ( !isset( $_FILES[ 'image' ][ 'error' ] ) == UPLOAD_ERR_OK ) {
                            $dataJobCreator[ 'profile_image' ] = $_FILES[ 'image' ];
                        }
                        $jobCreatorUpdated = JobCreators::updateJobCreator( $dataJobCreator );
                        if ( !$jobCreatorUpdated ) {
                            throw new Exception( 'Gagal memperbarui profil pembuat kerja, pastikan ada perubahan data.' );
                        }
    
                        echo json_encode( [ 'status' => 'success', 'message' => 'Profil berhasil diubah' ] );
                    } else {
                        echo json_encode( [ 'status' => 'error', 'message' => 'Password lama tidak sesuai' ] );
                        return;
                    }
                } else {
                    echo json_encode( [ 'status' => 'view', 'view' => 'home/home_layout', 'data' => [ 'url' => 'home' ] ] );
                    return;
                }
            } catch ( Exception $e ) {
                error_log( $e->getMessage() );
                echo json_encode( [ 'status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage() ] );
                return;
            }
        }
    }
}