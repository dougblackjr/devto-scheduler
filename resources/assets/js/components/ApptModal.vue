<template id="modal-template">
	<div class="modal-mask" transition="modal">
		<div class="modal-mask">
			<div class="modal-wrapper">
				<div class="modal-container">
					<form>
					<!-- <form v-on:submit.prevent="submit"> -->
						<div class="modal-header">
							<slot name="header">
								Add Appointment
							</slot>
						</div>

						<div class="modal-body">
							<slot name="body">
								<input type="text" name="apptTitle" placeholder="Your appt title" v-model="title"/>
								<input type="text" name="apptDescription" placeholder="Your appt description" v-model="description"/>
								<datetime format="MM/DD/YYYY" width="300px" v-model='start'></datetime>
								<datetime format="MM/DD/YYYY" width="300px" v-model='end'></datetime>
								<select v-model="resource_id">
									<option v-for="t in resources" v-bind:value="t.id">
										{{ t.title }}
									</option>
								</select>
							</slot>
						</div>

						<div class="modal-footer">
							<slot name="footer">
								<button type="submit" class="modal-success-button" @click.prevent="submit()">
									Submit
								</button>
								<button type="cancel" class="modal-default-button" @click.prevent="$emit('close')">
									Close
								</button>
							</slot>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import datetime from 'vuejs-datetimepicker';

	export default {
		components: {datetime},
		props: [
			'showApptModal',
			'res'
		],
		data() {
			return {
				title: '',
				description: '',
				start: '',
				end: '',
				resource_id: 0,
				resources: this.res
			}
		},
		methods: {
			submit() {
				// Get the title
				// this.title = submitEvent.target.elements.resourceTitle.value
				
				// CLose the modal
				this.$emit('close');

				// Submit
				if (this.title != '') {
					$('#calendar').fullCalendar(
						'addResource',
						{ title: this.title },
						true
					);

					window.axios.post('/resources',
					{
						title: this.title
					})
					.then((response) => {
						window.toastr.info('Resource added')
					})
				}
			}
		},
		mounted() {
			console.log('APpt Modal is on!')
			console.log('props', this.resources)
		}
	}
</script>

<style scoped>
	.modal-mask {
		position: fixed;
		z-index: 9998;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		background-color: rgba(0, 0, 0, .5);
		display: table;
		transition: opacity .3s ease;
	}

	.modal-wrapper {
		display: table-cell;
		vertical-align: middle;
	}

	.modal-container {
		width: 400px;
		margin: 0px auto;
		padding: 20px 30px;
		background-color: #fff;
		border-radius: 2px;
		box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
		transition: all .3s ease;
		font-family: Helvetica, Arial, sans-serif;
	}

	.modal-header h3 {
		margin-top: 0;
		color: #42b983;
	}

	.modal-body {
		margin: 20px 0;
	}

	.modal-default-button {
		float: right;
	}

	.modal-success-button {
		float: left;
	}

	.modal-enter {
		opacity: 0;
	}

	.modal-leave-active {
		opacity: 0;
	}

	.modal-enter .modal-container,
	.modal-leave-active .modal-container {
		-webkit-transform: scale(1.1);
		transform: scale(1.1);
	}
</style>