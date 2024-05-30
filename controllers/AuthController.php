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

    static function sessionLogin(){
        $post = array_map( 'htmlspecialchars', $_POST );
        if (empty(trim($post['username'])) || empty(trim($post['password']))) {
            setFlashMessage('danger', 'Harap isi username dan password!');
            header('Location: login?failed=true');
            exit();
        } else {
            $user = Users::login( [
                'username' => $post[ 'username' ],
                'password' => $post[ 'password' ]
            ] );
    
            if ( $user ) {
                if ( $user[ 'status' ] === 'active' ) {
                    if ( $user[ 'role_id' ] == '1' ) {
                        $_SESSION[ 'user' ] = $user;
                        setcookie( 'token', $user[ 'token' ], strtotime( $user[ 'token_expires_at' ] ), '/', '', false, true );
                        setFlashMessage( 'success', 'Login Berhasil, Selamat Datang!' );
                        header( 'Location: dashboard' );
                        exit();
                    } elseif ( $user[ 'role_id' ] == '2' ) {
                        $_SESSION[ 'user' ] = $user;
                        setcookie( 'token', $user[ 'token' ], strtotime( $user[ 'token_expires_at' ] ), '/', '', false, true );
                        setFlashMessage( 'success', 'Login Berhasil, Selamat Datang!' );
                        header( 'Location: home' );
                        exit();
                    } elseif ( $user[ 'role_id' ] == '3' ) {
                        $_SESSION[ 'user' ] = $user;
                        setcookie( 'token', $user[ 'token' ], strtotime( $user[ 'token_expires_at' ] ), '/', '', false, true );
                        setFlashMessage( 'success', 'Login Berhasil, Selamat Datang!' );
                        header( 'Location: dashboard' );
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
            }
        }
    }

    static function newRegister(){
        $post = array_map( 'htmlspecialchars', $_POST );
        $requiredFields = ['username', 'password', 'email', 'role_id', 'name', 'phone', 'street', 'district_id', 'lat', 'lng'];
        foreach ($requiredFields as $field) {
            if (empty(trim($post[$field]))) {
                http_response_code(400);
                echo json_encode(['message' => 'Harap isi semua kolom yang diperlukan!']);
                exit();
            }
        }
    
        // Validasi email
        if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
            http_response_code(400);
            echo json_encode(['message' => 'Email tidak valid!']);
            exit();
        }
    
        // Validasi nomor telepon
        if (!preg_match('/^[0-9]{10,}$/', $post['phone'])) {
            http_response_code(400);
            echo json_encode(['message' => 'Nomor telepon harus minimal 10 digit angka!']);
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
}
