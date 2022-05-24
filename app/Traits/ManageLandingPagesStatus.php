<?php
namespace App\Traits;

use App\Models\Landing;

trait ManageLandingPagesStatus
{
    /**
     * To activate all landing pages of a campaign.
     *
     * @param $campaignId
     */
    public static function activeLandingPages($campaignId)
    {
        $landings = Landing::where('campaign_id', $campaignId)->get();
        foreach ($landings as $landing) {
            $status = !empty($landing->previous_status) ? $landing->previous_status : 'inactive';
            $landing->update(['status' => $status]);
        }
    }

    /**
     * To deactivate all landing pages of a campaign.
     *
     * @param $campaignId
     */
    public static function deactiveLandingPages($campaignId)
    {
        Landing::where('campaign_id', $campaignId)->update(['status' => 'inactive']);
    }

    /**
     * To soft delete all landing pages of a campaign.
     *
     * @param $campaignId
     */
    public static function softDeleteLandingPages($campaignId)
    {
        Landing::where('campaign_id', $campaignId)->delete();
    }
}
