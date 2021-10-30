var client = AgoraRTC.createClient({ mode: "rtc", codec: "vp8" });

/*
 * Clear the video and audio tracks used by `client` on initiation.
 */
var localTracks = {
    videoTrack: null,
    audioTrack: null
};

/*
 * On initiation no users are connected.
 */
var remoteUsers = {};

/*
 * On initiation. `client` is not attached to any project or channel for any specific user.
 */
var options = {
    appid: null,
    channel: null,
    uid: null,
    token: null
};

/*
 * When this page is called with parameters in the URL, this procedure
 * attempts to join a Video Call channel using those parameters.
 */
// $(() => {
//     var urlParams = new URL(location.href).searchParams;
//     options.appid = urlParams.get("appid");
//     options.channel = urlParams.get("channel");
//     options.token = urlParams.get("token");
//     options.uid = urlParams.get("uid");
//     if (options.appid && options.channel) {
//         $("#uid").val(options.uid);
//         $("#appid").val(options.appid);
//         $("#token").val(options.token);
//         $("#channel").val(options.channel);
//         $("#join-form").submit();
//     }
// })

/*
 * When a user clicks Join or Leave in the HTML form, this procedure gathers the information
 * entered in the form and calls join asynchronously. The UI is updated to match the options entered
 * by the user.
 */
$(document).ready(async function() {
    try {
        options.appid = process.env.MIX_AGORA_APP_ID;
        options.token = $("#token").val();
        options.channel = $("#channel").val();
        options.uid = Number($("#specialist_id").val());
        await join();
    } catch (error) {
        console.error(error);
    }
});

/*
 * Join a channel, then create local video and audio tracks and publish them to the channel.
 */
async function join() {
    // Add an event listener to play remote tracks when remote user publishes.
    client.on("user-published", handleUserPublished);
    client.on("user-unpublished", handleUserUnpublished);

    // Join a channel and create local tracks. Best practice is to use Promise.all and run them concurrently.
    [
        options.uid,
        localTracks.audioTrack,
        localTracks.videoTrack
    ] = await Promise.all([
        // Join the channel.
        client.join(
            options.appid,
            options.channel,
            options.token || null,
            options.uid || null
        ),
        // Create tracks to the local microphone and camera.
        AgoraRTC.createMicrophoneAudioTrack(),
        AgoraRTC.createCameraVideoTrack()
    ]);

    // Play the local video track to the local browser and update the UI with the user ID.
    localTracks.videoTrack.play("local-player");

    // Publish the local video and audio tracks to the channel.
    await client.publish(Object.values(localTracks));
    console.log("publish success");
}

/*
 * Stop all local and remote tracks then leave the channel.
 */
async function leave() {
    for (trackName in localTracks) {
        var track = localTracks[trackName];
        if (track) {
            track.stop();
            track.close();
            localTracks[trackName] = undefined;
        }
    }

    // Remove remote users and player views.
    remoteUsers = {};
    $("#remote-playerlist").html("");

    // leave the channel
    await client.leave();

    $("#join").attr("disabled", false);
    $("#leave").attr("disabled", true);
    console.log("client leaves channel success");
}

/*
 * Add the local use to a remote channel.
 *
 * @param  {IAgoraRTCRemoteUser} user - The {@link  https://docs.agora.io/en/Voice/API%20Reference/web_ng/interfaces/iagorartcremoteuser.html| remote user} to add.
 * @param {trackMediaType - The {@link https://docs.agora.io/en/Voice/API%20Reference/web_ng/interfaces/itrack.html#trackmediatype | media type} to add.
 */
async function subscribe(user, mediaType) {
    const uid = user.uid;
    // subscribe to a remote user
    await client.subscribe(user, mediaType);
    console.log("subscribe success");
    if (mediaType === "video") {
        const player = $(`
      <div id="player-wrapper-${uid}">
        <div id="player-${uid}" class="player"></div>
      </div>
    `);
        $("#remote-playerlist").append(player);
        user.videoTrack.play(`player-${uid}`);
    }
    if (mediaType === "audio") {
        user.audioTrack.play();
    }
}

/*
 * Add a user who has subscribed to the live channel to the local interface.
 *
 * @param  {IAgoraRTCRemoteUser} user - The {@link  https://docs.agora.io/en/Voice/API%20Reference/web_ng/interfaces/iagorartcremoteuser.html| remote user} to add.
 * @param {trackMediaType - The {@link https://docs.agora.io/en/Voice/API%20Reference/web_ng/interfaces/itrack.html#trackmediatype | media type} to add.
 */
function handleUserPublished(user, mediaType) {
    const id = user.uid;
    remoteUsers[id] = user;
    subscribe(user, mediaType);
}

/*
 * Remove the user specified from the channel in the local interface.
 *
 * @param  {string} user - The {@link  https://docs.agora.io/en/Voice/API%20Reference/web_ng/interfaces/iagorartcremoteuser.html| remote user} to remove.
 */
function handleUserUnpublished(user) {
    const id = user.uid;
    delete remoteUsers[id];
    $(`#player-wrapper-${id}`).remove();
}
