require('./bootstrap');

window.Vue = require('vue')
import FullCalendar from 'vue-full-calendar'
import 'fullcalendar-scheduler'
const moment = require('moment');
import 'fullcalendar/dist/fullcalendar.min.css'
import 'fullcalendar-scheduler/dist/scheduler.min.css'

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
					start: moment().add(2, "h").subtract(3, 'h'),
					end: moment().add(3, "h")
				}
			],
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
			config: {
				schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
				defaultView: "timelineDay",
				header: {
					left: "prev,next",
					center: "title",
					right: "timelineDay,timelineWeek,timelineMonth"
				},
				views: {
					timelineOneDay: {
						type: 'timeline',	
						duration: { days: 1 },
						buttonText: 'One Day'
					},
					agenda: {
						eventLimit: 3
					}
				}
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