<script>
export default {
	name: "AtaiButton",
	props: {
		after: String,
		before: String,
		disabled: Boolean,
		help: String,
		icon: String,
		label: String,
		required: Boolean,
		when: String,
		value: String,
		target: String,
	},
	data() {
		return {
			isLoading: false,
		}
	},
	methods: {
		onInput($event) {
			this.$emit("input", $event);
		},
		async handleClick() {
			this.isLoading = true;
			let uuid = null;
			switch (window.panel.view.component) {
				case 'k-file-view':
					uuid = this.$attrs["form-data"]?.uuid;
					break;
				case 'k-page-view':
					uuid = this.$attrs["form-data"]?.[this.target]?.[0]?.uuid;
					break;
			}
			if(!uuid) {
				this.$panel.error('No uuid found. Target: "' + this.target + '"');
				this.isLoading = false;
				return;
			}
			try {
				let data = {
					image: uuid,
					lang: window.panel.language.code,
					page: window.panel.view.props.model.parent
				}
				const response = await this.$api.post('/atai-image', data);
				if(!response.error_code) {
					this.value = response.alt_text;
					this.onInput(response.alt_text);
				} else {
					this.$panel.error(response.error || 'Failed to generate alt text');
				}
			} catch (e) {
				this.$panel.error(e.message || 'Failed to generate alt text');
			} finally {
				this.isLoading = false;
			}
		}
	}
}
</script>

<template>
	<div>
			<k-field class="k-atai-field"
							 :label="label"
							 :disabled="disabled"
							 :help="help"
							 :required="required"
							 :when="when">
				<k-button :icon="isLoading ? 'loader' : 'add'" size="xs" slot="options" variant="filled" @click="handleClick" :disabled="isLoading">
					Generate Alt-Text
				</k-button>
				<k-input
					:after="after"
					:before="before"
					:icon="icon"
					theme="field"
					type="text"
					name="textfield"
					:value="value"
					@input="onInput($event)"/>
			</k-field>
	</div>

</template>

<style scoped>

</style>
