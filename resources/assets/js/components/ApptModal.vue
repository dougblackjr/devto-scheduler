<template id="appt-modal">
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
								<div class="modal-body-left">
									<input type="text" name="apptTitle" placeholder="Your appt title" v-model="title"/>
									<input type="text" name="apptDescription" placeholder="Your appt description" v-model="description"/>
									<label for="apptResource">Resource</label>
									<select name="apptResource" v-model="resource_id">
										<option v-for="t in resources" v-bind:value="t.id">
											{{ t.title }}
										</option>
									</select>
								</div>
								<div class="modal-body-right">
									<label>Schedule Now or Later</label>
									<toggle-button :value="true" :labels="{checked: 'Now', unchecked: 'Later'}" v-model="showTimes" :height="45" :width="75" />
									<div v-if="showTimes">
										<input type="datetime-local" v-model="start" />
										<input type="datetime-local" v-model="end" />
									</div>
								</div>
							</slot>
						</div>

						<div class="modal-footer">
							<slot name="footer">
								<button type="submit" class="modal-success-button" @click.prevent="submitAppointment()">
									Submit
								</button>
								<button type="cancel" class="modal-default-button" @click.prevent="closeModal()">
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
	const moment = require('moment');

	import datetime from 'vuejs-datetimepicker';

	export default {
		components: {datetime},
		props: [
			'showApptModal',
			'res',
			'intitle',
			'indescription',
			'instart',
			'inend',
			'inresourceid'
		],
		data() {
			return {
				title: this.intitle,
				description: this.indescription,
				start: this.instart,
				end: this.inend,
				resource_id: this.inresourceid,
				resources: this.res,
				showTimes: true
			}
		},
		methods: {
			closeModal() {
				console.log('close event');
				window.lockFxns.unlockTimeSlot(this.inresourceid, moment(this.instart), moment(this.inend));
				this.$emit('close');

			},
			submitAppointment() {
				let self = this

				window.lockFxns.unlockTimeSlot(this.resource_id, moment(this.start), moment(this.end));

				// Submit
				if (this.title != '') {

					console.log('this.showTimes', this.showTimes)
					let sendData = {

						title: this.title,
						description: this.description,
						resource_id: this.resource_id,
						start: this.showTimes ? moment(this.start).format() : null,
						end: this.showTimes ? moment(this.end).format() : null
					}

					window.axios.post('/appointments/add', sendData)
					.then((response) => {
						// Close the modal
						self.$emit('close');
						window.toastr.info('Appointment added')
						this.$parent.$options.methods.refreshEvents()
					})
				}
			}
		},
		mounted() {
			console.log('Appt Modal is on!')
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
		width: calc(100% - 200px);
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
		display: flex;
		justify-content: space-between;
	}

	.modal-body-left, .modal-body-right {
		display: flex;
		flex-direction: column;
		width: 40%;
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