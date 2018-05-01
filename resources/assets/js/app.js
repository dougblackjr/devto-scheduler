require('./bootstrap');

window.Vue = require('vue')
import FullCalendar from 'vue-full-calendar'
import 'fullcalendar-scheduler'
import 'fullcalendar/dist/fullcalendar.min.css'
import 'fullcalendar-scheduler/dist/scheduler.min.css'

// Vue.component('example-component', require('./components/ExampleComponent.vue'))
Vue.use(FullCalendar)

const app = new Vue({
	el: '#app',
	data() {
		return {
			config: {
			        defaultView: 'timelineMonth',
			        events: [
			          // events go here
			        ],
			        resources: [
			          // resources go here
			        ]
			        // other options go here...
			      },
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