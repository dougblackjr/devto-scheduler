<template>
	<aside
		class="wait-list-card"
		draggable="true"
		v-bind:class="{ locked: isLocked }"
		v-bind:data-id="id"
		v-bind:data-title="title"
		v-bind:data-description="description"
		>
		<h2>{{ title }}<br />
			<small v-if="isLocked">{{ lockedDescription }}</small>
			<small v-else>{{ dateSinceCreated }}</small>
		</h2>
	</aside>
</template>

<script>
	const moment = require('moment');

	let self = this;

	export default {
		props: [
			'inid',
			'intitle',
			'indescription',
			'increateddate',
			'inlocked',
			'inlockeddescription'
		],
		data() {
			return {
				id: this.inid,
				title: this.intitle,
				description: this.indescription,
				createdDate: this.increateddate,
				locked: this.inlocked,
				lockedDescription: this.inlockeddescription
			}
		},
		computed: {
			dateSinceCreated() {
				let now = moment().utc(),
					date = moment(this.createdDate),
					diff = now.diff(date, 'minutes')
				console.log(now.format(), date.format(), diff)

				return diff + " " + (diff == 1 ? 'minute' : 'minutes')
			},
			isLocked() {
				return this.locked;
			}
		},
		methods: {

		},
		mounted() {
			$('.wait-list-card:not(.locked)').draggable({
				helper: 'clone',
				revert: function(is_valid_drop) {
					if(!is_valid_drop) {
						window.lockFxns.unlock('wait', this.id)
					}

					return true;
				},
				cursor: 'move'
			});
		}

	}

</script>

<style scoped>
	.wait-list-card {
		background-color: #89b4ce;
		border-radius: 10px;
		border: 1px solid #4e4e4e;
		text-align: center;
		margin: 1rem;
	}

	h2 {
		font-size: 1rem;
		font-weight: bold;
		padding: 2px;
	}

	small {
		font-size: 0.8rem;
	}

	.locked {
		opacity: 0.5;
	}
</style>