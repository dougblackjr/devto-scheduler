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

					<full-calendar :event-sources="eventSources" :config="config"></full-calendar>
					<modal v-if="showModal" @close="showModal = false"></modal>
					<apptmodal 
						:res="allResourceInfo"
						:intitle="selectedTitle"
						:indescription="selectedDescription"
						:instart="selectedStart"
						:inend="selectedEnd"
						:inresourceid="selectedResourceId"
						v-if="showApptModal" 
						@close="showApptModal = false">
					</apptmodal>
					<viewmodal
						:res="allResourceInfo"
						v-if="showViewModal"
						@close="showViewModal = false">
					</apptmodal>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection