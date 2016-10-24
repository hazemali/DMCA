<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model {

    /**
     * fillable fileds for a new notice
     * 
     * @var array
     */
    protected $fillable = [
        'infringing_title',
        'infringing_link',
        'original_link',
        'original_description',
        'template',
        'provider_id',
        'content_removed'
    ];

    /**
     * open a new notice
     * 
     * @param array $artibutes
     * @return \static
     */
    public static function open(array $artibutes) {

        return new static($artibutes);
    }

    /**
     * set the email template to the notice
     * 
     * @param string $template
     * @return \App\Notice
     */
    public function useTemplate($template) {
        $this->template = $template;

        return $this;
    }

    /**
     * A notice belongs to a provider
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {

        return $this->belongsTo('App\User');
    }

    /**
     * get the email address for owner of the notice
     * 
     * @return strign
     */
    public function getOwnerEmail() {

        return $this->user->email;
    }

    /**
     * A notice belongs to a provider
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function provider() {
        return $this->belongsTo('App\provider');
    }

    /**
     * get the email address for the Recipient of the DMCA
     * 
     * @return string
     */
    public function getRecipientEmail() {

        return $this->provider->copyright_email;
    }

}
