<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name', 'email', 'password', 'role', 'is_active', 'avatar', 'last_login_at'];
    protected $hidden   = ['password', 'remember_token'];
    protected $casts    = ['is_active' => 'boolean', 'last_login_at' => 'datetime'];

    public function isSuperAdmin(): bool    { return $this->role === 'super_admin'; }
    public function isAdminMarketing(): bool { return $this->role === 'admin_marketing'; }
    public function isAdminSdm(): bool       { return $this->role === 'admin_sdm'; }
    public function canAccess(string $section): bool {
        return match($section) {
            'users'              => $this->isSuperAdmin(),
            'banner','artikel','layanan','dokter','poli','partner','faq','fasilitas','promo','kategori-artikel' => $this->isSuperAdmin() || $this->isAdminMarketing(),
            'karir','lamaran'    => $this->isSuperAdmin() || $this->isAdminSdm(),
            default              => $this->isSuperAdmin(),
        };
    }
    public function getRoleLabel(): string {
        return match($this->role) {
            'super_admin'     => 'Super Admin',
            'admin_marketing' => 'Admin Marketing',
            'admin_sdm'       => 'Admin SDM',
            default           => $this->role,
        };
    }
    public function getRoleBadgeClass(): string {
        return match($this->role) {
            'super_admin'     => 'badge-super',
            'admin_marketing' => 'badge-marketing',
            'admin_sdm'       => 'badge-sdm',
            default           => 'badge-secondary',
        };
    }
}
