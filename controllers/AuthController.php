<?php
include_once 'models/users.php';
include_once 'models/districts.php';
include_once 'models/job_seekers.php';
include_once 'models/job_creators.php';
include_once 'function/main.php';
include_once 'app/config/static.php';

class AuthController
 {
    static function login()
 {
        view( 'auth/auth_layout', [ 'url' => 'login' ] );
    }

    static function register()
 {
        view( 'auth/auth_layout', [ 'url' => 'register_as' ] );
    }
    static function registerJobSeekers()
 {
        $role_id = 2;
        $districts = Districts::getAllDistricts();
        view( 'auth/auth_layout', [ 'url' => 'register', 'role_id' => $role_id, 'districts' => $districts ] );
    }
    static function registerJobCreators()
 {
        $role_id = 3;
        $districts = Districts::getAllDistricts();
        view( 'auth/auth_layout', [ 'url' => 'register', 'role_id' => $role_id, 'districts' => $districts ] );
    }

    static function sessionLogin() {
        $post = array_map( 'trim', $_POST );
        if ( empty( $post[ 'username' ] ) || empty( $post[ 'password' ] ) ) {
            setFlashMessage( 'danger', 'Harap isi username dan password!' );
            header( 'Location: login?failed=true' );
            exit();
        } elseif ( strlen( $post[ 'password' ] ) < 8 ) {
            setFlashMessage( 'danger', 'Password harus terdiri dari minimal 8 karakter!' );
            header( 'Location: login?failed=true' );
            exit();
        } else {
            $user = Users::login( [
                'username' => $post[ 'username' ],
                'password' => $post[ 'password' ]
            ] );

            if ( $user ) {
                if ( $user[ 'status' ] === 'active' ) {
                    if ( $user[ 'role_id' ] == '1' || $user[ 'role_id' ] == '2' || $user[ 'role_id' ] == '3' ) {
                        $_SESSION[ 'user' ] = $user;
                        setcookie( 'token', $user[ 'token' ], strtotime( $user[ 'token_expires_at' ] ), '/', '', false, true );
                        setFlashMessage( 'success', 'Login Berhasil, Selamat Datang '.$_SESSION[ 'user' ][ 'username' ].'!' );
                        if ( $user[ 'role_id' ] == '1' || $user[ 'role_id' ] == '3' ) {
                            header( 'Location: dashboard' );
                        } elseif ( $user[ 'role_id' ] == '2' ) {
                            header( 'Location: home' );
                        }
                        exit();
                    } else {
                        setFlashMessage( 'danger', 'Peran pengguna tidak valid!' );
                        header( 'Location: login?failed=true' );
                        exit();
                    }
                } else {
                    setFlashMessage( 'danger', 'Akun anda sedang dinonaktifkan, silahkan hubungi admin!' );
                    header( 'Location: login?failed=true' );
                    exit();
                }
            } else {
                setFlashMessage( 'danger', 'Username atau Password salah, silahkan coba lagi!' );
                header( 'Location: login?failed=true' );
                exit();
            }
        }
    }

    static function newRegister() {
        $post = array_map( 'trim', $_POST );
        $phoneRegex = '/^(?:\+?62|0)\d{9,12}$/';
        if ( empty( $post[ 'username' ] ) || empty( $post[ 'password' ] ) || empty( $post[ 'email' ] ) || empty( $post[ 'name' ] ) || empty( $post[ 'phone' ] ) || empty( $post[ 'lat' ] ) || empty( $post[ 'lng' ] ) || empty( $post[ 'street' ] ) || empty( $post[ 'district_id' ] ) || empty( $post[ 'role_id' ] ) ) {
            http_response_code( 400 );
            echo json_encode( [ 'message' => 'Semua bidang harus diisi' ] );
            exit();
        } elseif ( !filter_var( $post[ 'email' ], FILTER_VALIDATE_EMAIL ) ) {
            http_response_code( 400 );
            echo json_encode( [ 'message' => 'Format email tidak valid' ] );
            exit();
        } elseif ( strlen( $post[ 'password' ] ) < 8 ) {
            http_response_code( 400 );
            echo json_encode( [ 'message' => 'Password harus terdiri dari minimal 8 karakter' ] );
            exit();
        } elseif ( strlen( $post[ 'phone' ] ) < 10 ) {
            http_response_code( 400 );
            echo json_encode( [ 'message' => 'Nomor telepon harus terdiri dari minimal 10 karakter' ] );
            exit();
        } elseif ( !preg_match( $phoneRegex, $post[ 'phone' ] ) ) {
            http_response_code( 400 );
            echo json_encode( [ 'message' => 'Format nomor telepon Indonesia tidak valid' ] );
            exit();
        }

        try {
            $existingUser = Users::findUserByUsernameOrEmail( $post[ 'username' ], $post[ 'email' ] );

            if ( $existingUser ) {
                if ( $existingUser[ 'username' ] === $post[ 'username' ] ) {
                    throw new Exception( 'Username already taken' );
                }

                if ( $existingUser[ 'email' ] === $post[ 'email' ] ) {
                    throw new Exception( 'Email already in use' );
                }
            }

            $user_id = Users::register( [
                'username' => $post[ 'username' ],
                'password' => $post[ 'password' ],
                'email' => $post[ 'email' ],
                'role_id' => $post[ 'role_id' ]
            ] );

            if ( $post[ 'role_id' ] === '2' ) {
                $data = JobSeekers::createJobSeeker( [
                    'user_id' => $user_id,
                    'name' => $post[ 'name' ],
                    'phone' => $post[ 'phone' ],
                    'lat' => $post[ 'lat' ],
                    'lng' => $post[ 'lng' ],
                    'street' => $post[ 'street' ],
                    'district_id' => $post[ 'district_id' ]
                ] );
            } elseif ( $post[ 'role_id' ] === '3' ) {
                $data = JobCreators::createJobCreator( [
                    'user_id' => $user_id,
                    'name' => $post[ 'name' ],
                    'phone' => $post[ 'phone' ],
                    'lat' => $post[ 'lat' ],
                    'lng' => $post[ 'lng' ],
                    'street' => $post[ 'street' ],
                    'district_id' => $post[ 'district_id' ]
                ] );
            }

            if ( $data ) {
                header( 'Location: login' );
            }
            exit();
        } catch ( Exception $e ) {
            http_response_code( 400 );

            if ( $e->getMessage() === 'Username already taken' ) {
                echo json_encode( [ 'message' => 'Username sudah digunakan. Silahkan gunakan username lainnya!' ] );
            } elseif ( $e->getMessage() === 'Email already in use' ) {
                echo json_encode( [ 'message' => 'Email sudah digunakan. Silahkan gunakan Email lainnya!' ] );
            } else {
                echo json_encode( [ 'message' => 'Terjadi kesalahan, mohon coba lagi.' ] );
            }
            exit();
        }
    }

    static function logout()
 {

        if ( ini_get( 'session.use_cookies' ) ) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params[ 'path' ],
                $params[ 'domain' ],
                $params[ 'secure' ],
                $params[ 'httponly' ]
            );
        }
        session_destroy();

        header( 'Location: home' );
        exit();
    }
    static function forgotPassword() {
        view( 'auth/auth_layout', [ 'url' => 'forgot_password' ] );
    }
    static function resetPassword() {
        $encrypted_code = $_GET[ 'verification' ];
        $email = $_GET[ 'email' ];
        $check_code = Users::checkVerificationCode( $email, $encrypted_code );
        if ( $check_code === true ) {
            view( 'auth/auth_layout', [ 'url' => 'reset_password' ] );
        } else {
            setFlashMessage( 'danger', 'Url sudah tidak berfungsi, silahkan coba lagi' );
            header( 'Location: login' );
            exit();
        }
    }

    static function forgotPasswordProcess() {

        $post = array_map( 'trim', $_POST );

        // Validasi apakah email telah diinputkan pengguna
        if ( empty( $post[ 'email' ] ) ) {
            setFlashMessage( 'danger', 'Email harus diisi!' );
            header( 'Location: forgotpassword' );
            exit();
        }
        // Validasi format email
        elseif ( !filter_var( $post[ 'email' ], FILTER_VALIDATE_EMAIL ) ) {
            setFlashMessage( 'danger', 'Format email tidak valid!' );
            header( 'Location: forgotpassword' );
            exit();
        } else {
            // Periksa apakah pengguna dengan email yang diinputkan ada
            $user = Users::findUserByEmail( $post[ 'email' ] );
            if ( $user ) {
                // Generate kode baru
                $new_code = mt_rand( 100000, 999999 );
                $encrypted_code = crypt( $new_code, PASSWORD_DEFAULT );
                echo $encrypted_code;
                // Perbarui kode pengguna di database
                Users::updateUserCode( $user[ 'id' ], $new_code );
                // Kirim email kepada pengguna dengan kode
                $sendEmail = sendCodeEmail( $post[ 'email' ], $encrypted_code );
                if ( $sendEmail === true ) {
                    setFlashMessage( 'success', 'Email untuk proses reset password telah dikirim. Periksa kotak masuk Anda.' );
                    header( 'Location: login' );
                    exit();
                } else {
                    setFlashMessage( 'danger', 'Email tidak terkirim, coba lagi' );
                    header( 'Location: forgotpassword' );
                    exit();
                }
            } else {
                setFlashMessage( 'danger', 'Email tidak ditemukan' );
                header( 'Location: forgotpassword' );
                exit();
            }
        }
    }
    static function resetPasswordProcess() {
        $post = array_map( 'trim', $_POST );
        if ( strlen( $post[ 'password' ] ) < 8 ) {
            setFlashMessage( 'danger', 'Password harus terdiri dari minimal 8 karakter' );
            header( 'Location: resetpassword' );
        } elseif ( strlen( $post[ 'password' ] ) !== strlen( $post[ 'confirm_password' ] ) ) {
            setFlashMessage( 'danger', 'Password dan konfirmasi password harus sama' );
            header( 'Location: resetpassword' );
        } else {
            $user = Users::findUserByEmail( $post[ 'email' ] );
            $data = [
                'email'=> $user[ 'email' ],
                'password' => $post[ 'password' ]
            ];
            Users::updatePassword( $data );
            setFlashMessage( 'success', 'Password berhasil diubah, silahkan login' );
            header( 'Location: login' );
            exit();
        }
    }
}
