<template id="view-modal">
	<div class="modal-mask" transition="modal">
		<div class="modal-mask">
			<div class="modal-wrapper">
				<div class="modal-container">
					<form>
					<!-- <form v-on:submit.prevent="submit"> -->
						<div class="modal-header">
							<slot name="header">
								Edit Appointment
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
									<toggle-button :value="true" :labels="{checked: 'Now', unchecked: 'Later'}" v-model="showTimes" />
									<div v-if="showTimes">
										<input type="datetime-local" v-model="start" />
										<input type="datetime-local" v-model="end" />
									</div>
								</div>
							</slot>
						</div>

						<div class="modal-footer">
							<slot name="footer">
								<button type="submit" class="modal-success-button" @click.prevent="submit()">
									Edit
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
	const moment = require('moment');

	export default {
		props: [
			'showApptModal',
			'res',
			'inid',
			'intitle',
			'indescription',
			'instart',
			'inend',
			'inresourceid'
		],
		data() {
			return {
				id: this.inid,
				title: this.intitle,
				description: this.indescription,
				start: moment(this.instart).format('YYYY-MM-DD\THH:mm:SS'),
				end: moment(this.inend).format('YYYY-MM-DD\THH:mm:SS'),
				resource_id: this.inresourceid,
				resources: this.res,
				showTimes: true
			}
		},
		methods: {
			submit() {				
				let self = this

				// Submit
				window.axios.put('/appointments/' + this.id,
				{
					title: this.title,
					description: this.description,
					start: moment(this.start).format(),
					end: moment(this.end).format(),
					resource_id: this.resource_id
				})
				.then((response) => {
					// Close the modal
					self.$emit('close');
					window.toastr.info('Resource edited')
					this.$parent.$options.methods.refreshEvents()
				})
			}
		},
		mounted() {
			console.log('View Modal is on!')
			console.log(this.start, this.end)
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