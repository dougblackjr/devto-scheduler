<template>
	<aside>
		<div
			v-for="card in waitList"
			:key="card.id"
			class="wait-list-card"
			draggable="true"
			v-bind:id='"wait-list-card-" + card.id'
			v-bind:data-id='card.id'
			v-bind:data-title='card.title'
			v-bind:data-description="card.description"
			v-bind:class="{ locked: card.locked }"
			>
		</div>
	</aside>
</template>

<script>

	let self = this;

	export default {
		props: [
			'incomingwaitlist'
		],
		data() {
			return {
				waitList: this.incomingwaitlist
			}
		},
		computed: {

		},
		methods: {
			lock: function(id) {
				console.log('click', id)
				// window.lockFxns.lock('wait', id)
			}
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