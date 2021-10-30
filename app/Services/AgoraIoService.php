<?php

namespace App\Services;
use App\Services\AgoraDynamicKey\RtcTokenBuilder;

class AgoraIoService
{
    public function generateToken($channelName, $privilegeExpiredTs)
    {
        $appId = config('agoraio.app_id');
        $appCertificate  = config('agoraio.app_certficate');
        $role = RtcTokenBuilder::RoleAttendee;

        return RtcTokenBuilder::buildTokenWithUserAccount(
            $appId,
            $appCertificate,
            $channelName,
            0,
            $role,
            $privilegeExpiredTs
        );
    }
}
