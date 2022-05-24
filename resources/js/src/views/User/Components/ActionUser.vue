<template>
  <div class="user-actions" :id="this.params.data.id">
    <inertia-link href="">
      <button
        type="button"
        :attr="this.params.data.id"
        data-action-type="edit"
        class="btn btn-default text-success"
      >
        <i class="fa fa-pencil"></i> Edit
      </button>
    </inertia-link>
    <button
      type="button"
      :attr="this.params.data.id"
      @click="removeData(params.data.id)"
      data-action-type="remove"
      class="btn btn-default text-danger"
    >
      <i class="fa fa-trash"></i> Delete
    </button>
  </div>
</template>

<script>
import Vue from "vue";
import { core } from "../../../config/pluginInit";

export default Vue.extend({
  mixins: [
    {
      data() {
        return {};
      },
      methods: {
        removeData(id) {
          core.showSnackbar("success", "User has been remove successfully.&nbsp");
        }
      }
    }
  ]
});
</script>
