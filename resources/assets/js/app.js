require('./bootstrap');

// Dependencies
window.Vue = require('vue')
import FullCalendar from 'vue-full-calendar'
import 'fullcalendar-scheduler'
const moment = require('moment');
const toastr = require('toastr');

// Stylesheets
import 'fullcalendar/dist/fullcalendar.min.css'
import 'fullcalendar-scheduler/dist/scheduler.min.css'
import 'toastr/build/toastr.min.css';

// Vue.component('example-component', require('./components/ExampleComponent.vue'))
Vue.component('modal', require('./components/Modal.vue'))
Vue.use(FullCalendar)

const app = new Vue({
	el: '#app',

	data() {
		return {
			showModal: false,
			eventSources: [
			{
				events(start, end, timezone, callback) {
					window.axios.post('/appointments', {
						startDate: start,
						endDate: end
					})
					.then((response) => {
						console.log(response.data)
						callback(response.data)
					})
				}
			}],
			config: {
				schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
				resourceLabelText: "Rooms",
				resources: function(callback, start, end, timezone) {
					window.axios.get('/resources')
						.then((response) => {
							console.log(response.data)
							callback(response.data)
						}
					)
				},
				customButtons: {
					promptResource: {
						text: '+ room',
						click: function(event) {
							var title = prompt('Room name');
							if (title) {
								$('#calendar').fullCalendar(
									'addResource',
									{ title: title },
									true
								);

								window.axios.post('/resources',
								{
									title: title
								})
								.then((response) => {
									toastr.info('Resource added')
								})
							}
						}
					}
				},
				defaultView: "timelineDay",
				header: {
					left: "promptResource today prev,next",
					center: "title",
					right: "agendaDay,timelineDay,agendaWeek,month"
				},
			}
		}
	},
	methods: {
		broadcastResource(resource) {
			
		},
		refreshEvents() {
			this.$refs.calendar.$emit('refetch-events');
		},

		removeEvent() {
			this.$refs.calendar.$emit('remove-event', this.selected);
			this.selected = {};
		},

		eventSelected(event) {
			this.selected = event;
		},

		eventCreated(...test) {
			console.log(test);
		},
	},

	computed: {
		
	}
});