<?php

namespace Devyousef\Visitor\Traits;

use App\Models\User;
use Devyousef\Visitor\Models\Visitor;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * Trait Visitorable
 *
 * @package Dev\Visitor\Traits
 */
trait Visitorable
{
    /**
     * Get the visitors for the model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function visitor(): MorphMany
    {
        return $this->morphMany(Visitor::class, 'visitorable');
    }

    /**
     * Add a visitor for the model.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function visit(User $user): void
    {
        if (!($this->isVisitor($user))) {
            $this->addVisitor($user);
        }
    }

    /**
     * Check if a user is a visitor for the model.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    private function isVisitor(User $user): bool
    {
        return $this->visitor()->where('user_id', $user->id)
            ->where('visitorable_id', $this->id)
            ->where('visitorable_type', get_class($this))
            ->exists();
    }

    /**
     * Add a visitor for the model.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    private function addVisitor(User $user): void
    {
        $this->visitor()->create([
            'visitorable_id'   => $this->id,
            'visitorable_type' => get_class($this),
            'user_id'          => $user->id,
        ]);
    }

    /**
     * Get the visitor count for the model.
     *
     * @return int
     */
    public function visitorCount(): int
    {
        return $this->visitor->count();
    }
}
