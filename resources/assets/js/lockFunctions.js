let moment = require('moment');

window.lockFxns = {

	lockTimeSlot(resource_id, start_date, end_date, lock = true) {

		let newStart = (typeof start_date != 'object' ? moment(start_date, 'X') : start_date);

		let sendData = {
				type: 'slot',
				id: resource_id,
				date: newStart.format('YYYY-MM-DD'),
				data: (typeof start_date == 'object' ? start_date.format('X') + '-' + end_date.format('X') : start_date + '-' + end_date),
			};

		let url = (lock ? '/lock' : '/unlock')

		window.axios.post(url, sendData)
			.then((response) => {
				console.log(response.data)
			})

	},

	unlockTimeSlot(resource_id, start_date, end_date) {
		this.lockTimeSlot(resource_id, start_date, end_date, false);
	},

	lock(type, id, lock = true) {
		let sendData = {
			type: type,
			id: id
		};

		let url = (lock ? '/lock' : '/unlock')

		window.axios.post(url, sendData)
			.then((response) => {
				console.log(response.data)
			})
	},

	unlock(type, id) {
		this.lock(type, id, false);
	}

}