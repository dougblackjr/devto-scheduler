@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Calendar</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <full-calendar :events="events" :config="config"></full-calendar>
                    <modal v-if="showModal" @close="showModal = false">
                        <h3 slot="header">custom header</h3>
                    </modal>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection