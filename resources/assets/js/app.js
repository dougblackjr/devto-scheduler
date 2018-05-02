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
Vue.use(FullCalendar)

const app = new Vue({
	el: '#app',
	data() {
		return {
			events: [
				{
					title: "test",
					resourceId: "a",
					start: moment(),
					end: moment().add(1, "h")
				},
				{
					title: "test",
					resourceId: "a2",
					start: moment().add(2, "h"),
					end: moment().add(3, "h")
				}
			],
			config: {
				schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
				resourceLabelText: "Rooms",
				resources: [
					{
						id: "a",
						title: "Room A",
						children: [
							{
								id: "a1",
								title: "Room A1"
							},
							{
								id: "a2",
								title: "Room A2"
							}
						]
					}
				],
				defaultView: "timelineDay",
				header: {
					left: "prev,next",
					center: "title",
					right: "timelineDay,agendaDay,month"
				},
			}
		}
	},
	methods: {
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
		eventSources() {
			const self = this;
			return [
				{
					events(start, end, timezone, callback) {
						setTimeout(() => {
							callback(self.events.filter(() => Math.random() > 0.5));
						}, 1000);
					},
				},
			];
		},
	}
});