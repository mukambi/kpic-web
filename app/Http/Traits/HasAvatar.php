<?php

namespace App\Http\Traits;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\UrlGenerator;

/**
 * Trait HasAvatar
 *
 * @author Paul Gitau <kinyanjuipaul34@gmail.com>
 * @property HasAvatar defaultAvatarAsset
 * @property HasAvatar emailAttributeName
 * @property HasAvatar enableAvatarFromGravatar
 * @package App\Http\Traits
 */
trait HasAvatar
{
    /**
     * The attribute name containing the email address.
     *
     * @author Paul Gitau <kinyanjuipaul34@gmail.com>
     * @var string
     */
    private $avatarEmail;

    /**
     * Boolean to determine if to get avatar from gravatar or not
     *
     * @author Paul Gitau <kinyanjuipaul34@gmail.com>
     * @var bool
     */
    private $avatarFromGravatar;

    /**
     * The attribute name containing the email address.
     *
     * @author Paul Gitau <kinyanjuipaul34@gmail.com>
     * @var string
     */
    private $defaultAvatar;

    /**
     * Initialize append to the given model instance
     *
     * @author Paul Gitau <kinyanjuipaul34@gmail.com>
     */
    public function initializeHasAvatar()
    {
        // Initialize Default Avatar Asset
        $this->defaultAvatar = $this->getDefaultAvatar();

        // Initialize Email Attribute Name
        $this->avatarEmail = $this->getAvatarEmailAttributeName();

        // Initialize Avatar from Gravatar
        $this->avatarFromGravatar = $this->getAvatarFromGravatar();

        // Initialize appends
        $this->append('avatar');
    }

    /**
     * Get Default Avatar Asset
     *
     * @return HasAvatar|Application|UrlGenerator|string
     * @author Paul Gitau <kinyanjuipaul34@gmail.com>
     */
    public function getDefaultAvatar()
    {
        // Check if environment is local
        if (app()->environment('local')) {
            return url('https://i.stack.imgur.com/Vc2tC.png?s=40&g=1');
        }

        // Get Default Value
        return isset($this->defaultAvatarAsset) && !is_null($this->defaultAvatarAsset)
            ? $this->defaultAvatarAsset
            : asset('/img/default-user-icon.png');
    }

    /**
     * Get Avatar Email Attribute Name
     *
     * @return HasAvatar|string
     * @author Paul Gitau <kinyanjuipaul34@gmail.com>
     */
    public function getAvatarEmailAttributeName()
    {
        return isset($this->emailAttributeName) && !is_null($this->emailAttributeName)
            ? $this->emailAttributeName
            : 'email';
    }

    /**
     * Get Avatar Email Attribute Name
     *
     * @return HasAvatar|string
     * @author Paul Gitau <kinyanjuipaul34@gmail.com>
     */
    public function getAvatarFromGravatar()
    {
        return isset($this->enableAvatarFromGravatar) && !is_bool($this->enableAvatarFromGravatar)
            ? $this->enableAvatarFromGravatar
            : true;
    }

    /**
     * Get the model's Avatar
     *
     * @return string
     * @author Paul Gitau <kinyanjuipaul34@gmail.com>
     */
    public function getAvatarAttribute()
    {
        // Get the avatar
        return $this->avatarFromGravatar && array_key_exists($this->avatarEmail, $this->attributes)
            ? "https://www.gravatar.com/avatar/" . md5(strtolower(trim($this->attributes[$this->avatarEmail]))) . '?d=' . urlencode($this->defaultAvatar)
            : $this->defaultAvatar;
    }
}
