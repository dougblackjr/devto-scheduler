require('./bootstrap');

window.Vue = require('vue');
import FullCalendar from 'vue-full-calendar'

// Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.use(FullCalendar)

const app = new Vue({
	el: '#app',
	data() {
		return {
			events: [
				{
					title  : 'event1',
					start  : '2010-01-01',
				},
				{
					title  : 'event2',
					start  : '2010-01-05',
					end    : '2010-01-07',
				},
				{
					title  : 'event3',
					start  : '2010-01-09T12:30:00',
					allDay : false,
				},
			]
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