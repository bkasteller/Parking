<?php

namespace Parking;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    const ADMIN_TYPE = 'admin';
    const DEFAULT_TYPE = 'member';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['last_name', 'first_name', 'email', 'phone_number', 'address', 'postal_code', 'city', 'password'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token', 'activate', 'type', 'rank'];

    protected $dates = ['created_at', 'updated_at'];

    public function isAdmin()
    {
        return $this->type === self::ADMIN_TYPE;
    }

    /*
     * Retourne toute les réservations de l'utilisateur.
     */
    public function bookings()
    {
        return $this->hasMany('\Parking\Booking')->orderBy('created_at', 'desc');
    }

    /*
     * Récupère la dernière réservation de l'utilisateur.
     */
    public function booking()
    {
        return $this->bookings()->first();
    }

    /*
     * Retourne la place actuellement attribué à l'utilisateur ou NULL sinon.
     */
    public function place()
    {
        return exist($this->booking())
              && !$this->booking()->isExpired()
              ? $this->booking()->place : NULL;
    }

    /*
     * Retourne si l'utilisateur est dans la file d'attente.
     */
    public function isRanked()
    {
        return $this->rank != NULL;
    }

    /*
     * Decremente de 1 le rank des utilisateurs supérieur au rank de l'utilisateur actuel, puis passe le rank de l'utilisateur à null.
     */
    public function leaveRank()
    {
        if ( !empty($this->rank) )
        {
            User::whereNotNull('rank')
                ->where('rank', '>', $this->rank)
                ->decrement('rank', 1);
            $this->rank = NULL;
            $this->save();
        }
    }

    /*
     * Ajoute un utilisateur en dernière position de la liste d'attente
     */
    public function joinRank()
    {
        if ( empty($this->rank) )
        {
            $this->rank = lastRank() + 1;
            $this->save();
        }
    }

    /*
     * Ajoute un utilisateur au rang passé en paramètre
     */
    public function updateRank($rank)
    {
        if ( $this->updateRankCondition($rank) )
        {
            $this->leaveRank();
            User::whereNotNull('rank')
                ->where('rank', '>=', $rank)
                ->increment('rank', 1);
            $this->rank = $rank;
            $this->save();
        }
    }

    public function updateRankCondition($rank)
    {
        return exist($this->rank)
              && $rank != $this->rank
              && $rank >= 1
              && $rank <= lastRank();
    }

    public function name()
    {
        return $this->last_name.' '.$this->first_name;
    }

    /*
     * Inverse la valeur du boolean activate.
     * Si l'utilisateur se voit désactiver, ferme sa demande ou sa réservation.
     */
    public function activate()
    {
        $this->cancel_rank();
        $this->cancel_place();
        $this->activate = !$this->activate;
        $this->save();
    }

    /*
     * Annule l'utilisation d'une place.
     */
    public function cancel_rank()
    {
        if ( exist($this->rank) )
        {
            $this->leaveRank();
            return 1;
        }
        return 0;
    }

    /*
     * Annule une demande de reservation.
     */
    public function cancel_place()
    {
        if ( exist($this->place()) )
        {
            $this->booking()->abort();
            return 1;
        }
        return 0;
    }
}
