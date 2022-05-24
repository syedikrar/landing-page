<?php

namespace App\Observers;

use App\Models\Campaign;
use App\Traits\ManageLandingPagesStatus;

class CampaignObserver
{
    /**
     * Handle the Campaign "created" event.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return void
     */
    public function created(Campaign $campaign)
    {
        $campaign->update([
            'code' => 'C-'.$campaign->id.$campaign->user_id 
        ]);
    }

    /**
     * Handle the Campaign "updated" event.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return void
     */
    public function updated(Campaign $campaign)
    {
        $campaign->status == 'active'
            ? ManageLandingPagesStatus::activeLandingPages($campaign->id)
            : ManageLandingPagesStatus::deactiveLandingPages($campaign->id);
    }

    /**
     * Handle the Campaign "deleted" event.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return void
     */
    public function deleted(Campaign $campaign)
    {
        ManageLandingPagesStatus::softDeleteLandingPages($campaign->id);
    }

    /**
     * Handle the Campaign "restored" event.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return void
     */
    public function restored(Campaign $campaign)
    {
        //
    }

    /**
     * Handle the Campaign "force deleted" event.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return void
     */
    public function forceDeleted(Campaign $campaign)
    {
        //
    }
}
