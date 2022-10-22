<?php
 
namespace App\Models\Scopes;
 
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;
 
class OwnedScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
		if (Auth::user()) {
			$builder->where('owner_id', '=', Auth::id());
		}
    }

	/**
     * Extend the query builder with the needed functions.
     *
     * @param Builder $builder
     */
    public function extend(Builder $builder)
    {
        $builder->macro('withoutOwner', function (Builder $builder) {
            return $builder->withoutGlobalScope($this);
        });
    }
}