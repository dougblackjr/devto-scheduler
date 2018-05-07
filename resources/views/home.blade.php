@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-9">
			<div class="card">
				<div class="card-header">Calendar</div>

				<div class="card-body">
					@if (session('status'))
						<div class="alert alert-success">
							{{ session('status') }}
						</div>
					@endif

					<full-calendar :event-sources="eventSources" :config="config"></full-calendar>
					<modal v-if="showModal" @close="showModal = false"></modal>
					<apptmodal 
						:res="allResourceInfo"
						:intitle="selectedTitle"
						:indescription="selectedDescription"
						:instart="selectedStart"
						:inend="selectedEnd"
						:inresourceid="selectedResourceId"
						:lockstart="lockStart"
						:lockend="lockEnd"
						v-if="showApptModal" 
						@close="toggleApptModal()">
					</apptmodal>
					<viewmodal
						:res="allResourceInfo"
						:res="allResourceInfo"
						:inid="selectedId"
						:intitle="selectedTitle"
						:indescription="selectedDescription"
						:instart="selectedStart"
						:inend="selectedEnd"
						:inresourceid="selectedResourceId"
						v-if="showViewModal"
						@close="showViewModal = false">
					</apptmodal>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="card">
				<div class="card-header">Wait List</div>
				<div class="card-body">
					<waitlist
						:incomingwaitlist="waitList">
					</waitlist>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection