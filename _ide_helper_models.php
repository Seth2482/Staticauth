<?php
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\Site
 *
 * @property int $id
 * @property int $status
 * @property string $url
 * @property int $project_id
 * @property string|null $expire_at
 * @property string $extra
 * @property string|null $deleted_at
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Project $project
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Site onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Site whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Site whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Site whereExpireAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Site whereExtra($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Site whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Site whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Site whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Site whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Site whereUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Site withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Site withoutTrashed()
 */
	class Site extends \Eloquent {}
}

namespace App{
/**
 * App\Project
 *
 * @property int $id
 * @property string $name
 * @property string $git
 * @property string $extra
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Site[] $sites
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereExtra($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereGit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereUpdatedAt($value)
 */
	class Project extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 */
	class User extends \Eloquent {}
}

