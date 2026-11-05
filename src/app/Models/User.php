<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Concerns\LogsContext;
use Filament\Auth\MultiFactor\Email\Concerns\InteractsWithEmailAuthentication;
use Filament\Auth\MultiFactor\Email\Contracts\HasEmailAuthentication;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Override;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser, HasEmailAuthentication, MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, TwoFactorAuthenticatable, InteractsWithEmailAuthentication, LogsActivity, LogsContext;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'role',
                'lrn',
                'name',
                'batch.batch',
                'is_dismissed',
                'assignedInstructor.name',
                'initial_proficiency_lvls',
                'middle_proficiency_lvls',
                'final_proficiency_lvls',
            ])
            ->logOnlyDirty()            // only changed attributes on update
            ->dontLogEmptyChanges()
            ->useLogName('User Accounts');
    }

    protected function activityContext(): array
    {
        return [
            'user'       => $this->name,
            'role'       => $this->role,
            'lrn'        => $this->lrn,
            'email'      => $this->email,
            'batch'      => $this->batch?->name,
            'instructor' => $this->assignedInstructor?->name,
        ];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'role',
        'lrn',
        'name',
        'email',
        'password',
        'batch_id',
        'is_dismissed',
        'assigned_instructor_id',
        'has_email_authentication',
        'initial_proficiency_lvls',
        'middle_proficiency_lvls',
        'final_proficiency_lvls',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'initial_proficiency_lvls' => 'array',
            'middle_proficiency_lvls' => 'array',
            'final_proficiency_lvls' => 'array',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    /**
     * Relationships
     */
    public function masteryRecords()
    {
        return $this->hasMany(MasteryRecords::class);
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class, 'batch_id');
    }

    public function assignedInstructor()
    {
        return $this->belongsTo(User::class, 'assigned_instructor_id');
    }

    public function assignedStudents()
    {
        return $this->hasMany(User::class, 'assigned_instructor_id');
    }

    public function subjects()
    {
        return $this->belongsToMany(Subjects::class);
    }

    public function questionResponses()
    {
        return $this->hasMany(QuestionResponse::class);
    }

    public function learningMaterialViews()
    {
        return $this->hasMany(LearningMaterialViews::class, 'student_user_id');
    }

    /**
     * Authorization
     */
    public function isRoot(): bool
    {
        return $this->role === 'root';
    }

    public function isInstructor(): bool
    {
        return $this->role === 'instructor';
    }

    public function isStudent(): bool
    {
        return $this->role === 'student';
    }

    public function canAccessPanel(Panel $panel): bool
    {
        if ($panel->getId() === 'admin') {
            return $this->isRoot() || $this->isInstructor();
        }

        return true;
    }
}
