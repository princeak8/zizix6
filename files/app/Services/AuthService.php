<?php 

    namespace App\Services;

    use Illuminate\Support\Facades\Auth;

    class AuthService
    {

        public function refreshToken($guard)
        {
            return $guard->refresh();
        }

        public function checkToRefreshToken($guard)
        {
            // Auth::guard('api');
            session(['key' => 'value']);
            if(session('tokenExpiry')) {
                $expiry = session('tokenExpiry');
                if(($expiry - time()) < (60 * 60)) {
                    return $this->refreshToken($guard);
                }
            }
            return null;
        }

        public function storeTokenExpiry($mins)
        {
            session(['tokenExpiry' => time() + ($mins * 60)]);
        }

    }