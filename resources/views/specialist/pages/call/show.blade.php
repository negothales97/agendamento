@extends('specialist.templates.default')

@section('title', 'Chamada de vídeo')

@section('description', 'Descrição')

@section('content')

    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-sm-12">
                    <div class="box">
                        <div class="box-body">
                            <input type="hidden" id="specialist_id" value="{{ auth()->id() }}">
                            <input type="hidden" id="channel" value="{{ $schedule->agoraio_channel }}">
                            <input type="hidden" id="token" value="{{ $schedule->agoraio_token }}">
                            <div class="row-player">
                                <div class="col-player">
                                    <div id="local-player" class="player"></div>
                                </div>
                                <div class="col-player">
                                    <div id="remote-playerlist"></div>
                                </div>
                            </div>
                            <div class="controls">
                                {{-- <button class="btn-action btn-unmute">
                                    <i class="fa fa-microphone"></i>
                                </button>
                                <button class="btn-action btn-mute">
                                    <i class="fa fa-microphone-slash"></i>
                                </button> --}}
                                <button class="btn-action btn-dismiss"
                                    onclick="window.location.href='{{ route('specialist.call.index') }}'">
                                    <i class="fa  fa-phone"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('scripts')
    <script src="https://download.agora.io/sdk/release/AgoraRTC_N.js"></script>
    <script src="{{ asset('js/agoraio-videocall.js') }}"></script>
@endsection
