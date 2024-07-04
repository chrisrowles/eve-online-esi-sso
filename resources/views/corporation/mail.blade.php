@extends('layouts.app')

@section('additional_styles')
@endsection

@section('content')
    <div id="mail">
        <div class="container py-2">
            <div class="row mt-3">
                <div class="col-12 d-flex flex-lg-wrap align-items-center justify-content-between ">
                    <h1>{{ $mail->subject }} <small class="text-muted">(from {{ $mail->from }})</small></h1>
                    <a class="btn btn-secondary btn-sm" href="{{ route('corporation.mailbox') }}">
                        <i class="fas fa-arrow-left"></i> Back to mailbox
                    </a>
                </div>
            </div>
            <hr>
            <div class="row mt-4">
                <div class="col-12">
                    <div id="mail_content" class="card shadow d-none">
                        <div class="card-body">
                            <form>
                                <div class="form-row px-4">
                                    <div class="col-12">
                                        <label class="m-0" for="from">From:</label>
                                        <strong>{{ $mail->from }}</strong>
                                    </div>
                                    <div class="col-12">
                                        <label class="m-0" for="to">To:</label>
                                        <strong>{{ $mail->to }}</strong>
                                    </div>
                                    <div class="col-12">
                                        <label class="m-0" for="subject">Subject:</label>
                                        <strong>{{ $mail->subject }}</strong>
                                    </div>
                                    <div class="col-12">
                                        <label class="m-0" for="subject">Date:</label>
                                        <strong>{{ date('jS F H:i', strtotime($mail->timestamp)) }}</strong>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-row px-4 pb-4">
                                    <div class="col-12">
                                        <div id="mail-message">
                                            {!! $mail->body !!}
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('additional_scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('font').forEach((font) => {
                font.size = 'initial';
                font.color = document.querySelector('body').classList.contains('dark-mode')
                    ? 'white'
                    : 'black';
            });

            document.querySelector('#mail_content')
                .classList
                .remove('d-none');
        });
    </script>
@endsection
