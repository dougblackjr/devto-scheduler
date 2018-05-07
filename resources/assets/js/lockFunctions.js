window.lockFxns = {

	lockTimeSlot(resource_id, start_date, end_date, lock = true) {

		let sendData = {
				type: 'slot',
				id: resource_id,
				date: start_date.format('YYYY-MM-DD'),
				data: start_date.utc().format('X') + '-' + end_date.utc().format('X'), 
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