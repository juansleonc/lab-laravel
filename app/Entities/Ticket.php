<?php

namespace TeachMe\Entities;

class Ticket extends Entity
{
    protected $fillable = ['title', 'status'];

    public function getOpenAttribute()
    {
        return $this->status == 'open';
    }

    public function author()
    {
        return $this->belongsTo(User::getClass(), 'user_id');
    }

    public function voters()
    {
        return $this->belongsToMany(User::getClass(), 'ticket_votes')->withTimestamps();
    }

    public function comments()
    {
        //return $this->hasMany(TicketComment::class); //php > 5.4
        return $this->hasMany(TicketComment::getClass()); //php <= 5.4 create Model Entity
    }
}
