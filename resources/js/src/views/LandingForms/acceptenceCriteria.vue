<template>
  <b-container fluid>
    <vue-confirm-dialog class="confirm-dialog-custom"></vue-confirm-dialog>
    <div class="row">
      <div class="col-md-12">
        <b-row>
          <b-col cols="12 text-right">
            <b-modal id="criteria" centered title="Update criteria" hide-footer>
              <ValidationObserver v-slot="{ invalid }">
                <b-form
                  @submit.prevent="submitForm(criteria)"
                  ref="createcriteriaForm"
                >
                  <b-row>
                    <b-col cols="6">
                      <b-form-group label="Name">
                        <ValidationProvider
                          name="Name"
                          rules="required"
                          v-slot="{ errors }"
                        >
                          <b-input
                            v-model="criteria.name"
                            type="text"
                            :class="errors.length > 0 ? ' is-invalid' : ''"
                          >
                          </b-input>
                          <div class="invalid-feedback">
                            <span>{{ errors[0] }}</span>
                          </div>
                          <div
                            class="invalid-feedback d-block"
                            v-if="$props.errors"
                          >
                            <span>{{ $props.errors.criteriaErrors.name }}</span>
                          </div>
                        </ValidationProvider>
                      </b-form-group>
                    </b-col>
                    <b-col cols="6">
                      <b-form-group label="Set Lead Status To">
                        <ValidationProvider
                          name="leading_status"
                          rules="required"
                          v-slot="{ errors }"
                        >
                          <b-input
                            v-model="criteria.leading_status"
                            type="text"
                            :class="errors.length > 0 ? ' is-invalid' : ''"
                          >
                          </b-input>
                          <div class="invalid-feedback">
                            <span>{{ errors[0] }}</span>
                          </div>
                          <div
                            class="invalid-feedback d-block"
                            v-if="$props.errors"
                          >
                            <span>{{
                              $props.errors.criteriaErrors.leading_status
                            }}</span>
                          </div>
                        </ValidationProvider>
                      </b-form-group>
                    </b-col>
                    <b-col cols="6">
                      <b-form-group label="Match Type">
                        <ValidationProvider
                          name="match_type"
                          rules="required"
                          v-slot="{ errors }"
                        >
                          <b-form-select
                            plain
                            v-model="criteria.match_type"
                            @change="changeMatchType()"
                            :class="errors.length > 0 ? ' is-invalid' : ''"
                          >
                            <template v-slot:first>
                              <b-form-select-option value="Response Body">
                                Response Body
                              </b-form-select-option>
                              <b-form-select-option value="Response Code">
                                Response Code
                              </b-form-select-option>
                              <b-form-select-option value="Other">
                                Other
                              </b-form-select-option>
                            </template>
                          </b-form-select>
                          <!-- <b-input
                            v-model="criteria.match_type"
                            type="text"
                            :class="errors.length > 0 ? ' is-invalid' : ''"
                          >
                          </b-input> -->
                          <div class="invalid-feedback">
                            <span>{{ errors[0] }}</span>
                          </div>
                          <div
                            class="invalid-feedback d-block"
                            v-if="$props.errors"
                          >
                            <span>{{
                              $props.errors.criteriaErrors.match_type
                            }}</span>
                          </div>
                        </ValidationProvider>
                      </b-form-group>
                    </b-col>
                    <b-col cols="6">
                      <b-form-group label="Set Forwarding Status To">
                        <ValidationProvider
                          name="forwarding_status"
                          rules="required"
                          v-slot="{ errors }"
                        >
                        {{criteria.forwarding_status}}
                        <!-- <select :class="(errors.length > 0 ? ' is-invalid' : '')" v-html="optionsList" v-model="criteria.forwarding_status"></select> -->
                          <b-form-select
                            plain
                            v-model="criteria.forwarding_status"
                            :class="errors.length > 0 ? ' is-invalid' : ''"
                          >
                            <template v-slot:first>
                                <b-form-select-option value="Fail">
                                    Fail
                                </b-form-select-option>
                                <b-form-select-option value="Success">
                                    Success
                                </b-form-select-option>
                                <b-form-select-option value="Unauthenticated">
                                    Unauthenticated
                                </b-form-select-option>    
                            </template>
                          </b-form-select>
                          <!-- <b-input
                            v-model="criteria.forwarding_status"
                            type="text"
                            :class="errors.length > 0 ? ' is-invalid' : ''"
                          >
                          </b-input> -->
                          <div class="invalid-feedback">
                            <span>{{ errors[0] }}</span>
                          </div>
                          <div
                            class="invalid-feedback d-block"
                            v-if="$props.errors"
                          >
                            <span>{{
                              $props.errors.criteriaErrors.forwarding_status
                            }}</span>
                          </div>
                        </ValidationProvider>
                      </b-form-group>
                    </b-col>
                    <b-col cols="12">
                      <b-form-group label="Response">
                        <ValidationProvider
                          name="response"
                          rules="required"
                          v-slot="{ errors }"
                        >
                          <b-input
                            v-model="criteria.response"
                            type="text"
                            :class="errors.length > 0 ? ' is-invalid' : ''"
                          >
                          </b-input>
                          <div class="invalid-feedback">
                            <span>{{ errors[0] }}</span>
                          </div>
                          <div
                            class="invalid-feedback d-block"
                            v-if="$props.errors"
                          >
                            <span>{{
                              $props.errors.criteriaErrors.response
                            }}</span>
                          </div>
                        </ValidationProvider>
                      </b-form-group>
                    </b-col>
                  </b-row>
                  <div class="d-flex justify-content-end">
                    <b-button
                      variant=" iq-bg-primary"
                      class="iq-waves-effect"
                      @click="closeModal()"
                      >Cancel</b-button
                    >
                    <b-button
                      variant="primary ml-2"
                      class="iq-waves-effect"
                      type="submit"
                      :disabled="invalid || loader"
                    >
                      {{ criteria.id ? "Update" : "Submit" }}
                      <div
                        v-if="loader"
                        class="spinner-border spinner-border-sm text-secondary"
                        role="status"
                      ></div>
                    </b-button>
                  </div>
                </b-form>
              </ValidationObserver>
            </b-modal>
          </b-col>
        </b-row>
        <b-row>
          <b-col lg="12">
            <iq-card>
              <template v-slot:headerTitle v-if="criteria.data.length">
                <h4 class="card-title">Criteria</h4>
                <div v-if="$page.props.flash.error" class="text-danger">
                  {{ $page.props.flash.error }}
                </div>
              </template>

              <!-- table -->
              <template v-if="criteria.data.length">
                <b-table
                  responsive
                  :items="criteria.data"
                  :fields="fields"
                  :sort-by.sync="sortBy"
                  :sort-asc.sync="sortAsc"
                  sort-icon-left
                  :filter="filter"
                  :filter-included-fields="filterOn"
                  class="mb-0 table-borderlesss"
                >
                  <template v-slot:cell(actions)="data">
                    <button
                      type="button"
                      @click="showRejectionReason(data.item)"
                      class="btn btn-default text-danger px-1"
                      v-if="data.item.status == 'rejected'"
                    >
                      <i class="fa fa-info-circle"></i>
                    </button>
                    <button
                      v-b-tooltip.hover.bottomleft
                      title="Edit criteria"
                      type="button"
                      class="btn btn-default text-success px-1"
                    >
                      <i
                        class="fa fa-pen"
                        v-b-modal.criteria
                        @click="editCriteria(data)"
                      />
                    </button>
                  </template>
                  <template v-slot:cell(status)="data">
                    <b-badge
                      pill
                      :variant="
                        data.item.status == 'active' ? 'success' : 'danger'
                      "
                      >{{ data.item.status }}</b-badge
                    >
                  </template>
                  <template v-slot:cell(landings)="data">
                    <inertia-link
                      :href="
                        route('client.landing.index', {
                          criteria: data.item.id,
                        })
                      "
                      >{{ data.item.landings }}</inertia-link
                    >
                  </template>
                </b-table>
              </template>
              <template v-slot:body v-else>
                <div class="text-center">
                  <img
                    :src="
                      require('../../assets/images/email-campaign-animate.svg')
                    "
                    class="img-fluid mb-0"
                    alt="logo"
                    width="360px"
                  />

                  <h2 class="mb-3 mt-0">
                    Hi, Let's create your first criteria!
                  </h2>
                  <b-button
                    class="mb-3"
                    variant="primary"
                    @click="showModal('create')"
                    >Get Started</b-button
                  >
                </div>
              </template>
            </iq-card>
          </b-col>
        </b-row>
      </div>
    </div>
  </b-container>
</template>

<script>
import { core } from "../../config/pluginInit";
import { ValidationProvider, extend } from "vee-validate";
import { required } from "vee-validate/dist/rules";

extend("required", {
  ...required,
  message: "This field is required",
});

export default {
  name: "Index",
  mounted() {
    core.index();
  },
  props: {
    criteria: Object,
    errors: Object,
  },
  data() {
    return {
      loader: false,
      sortBy: "id",
      sortAsc: true,
      filter: null,
      hasAccess: false,
      // permissionsArray: this.$page.props.auth.user.permissions,
      filterOn: [],
      testimonial: [],
      description: "",
      // crietarea: this.defaultCriteria(),
      fields: [
        { key: "name", label: "Name", sortable: true },
        { key: "leading_status", label: "leading_status", sortable: true },
        { key: "match_type", label: "match_type", sortable: true },
        { key: "forwarding_status", label: "forwarding_status", sortable: true,},
        { key: "response", label: "response", sortable: true,},
        { key: "actions" },
      ],
      // criteria: [],
    };
  },
  methods: {
    onChange(e) {},
    closeModal() {
      this.$bvModal.hide("criteria");
      this.criteria.name = "";
      this.criteria.id = null;
      requestAnimationFrame(() => {
        this.$refs.criteriaObserver.reset();
      });
    },

    showModal(type) {
      if (type == "create") {
        this.criteria.name = "";
        this.criteria.id = null;
      }
      this.$bvModal.show("criteria");
    },
    // changeMatchType() {
    //     console.log(this.criteria.match_type);
        
    //     switch (this.criteria.match_type) {
    //         case 'Response Body':
    //         this.optionsList = '<option value="success">Response Body: success</option><option value="fail">Response Body: fail</option><option value="duplicate">Response Body: duplicate</option>'
    //         console.log("jsldfj", this.optionsList);
    //         break;
    //         case 'Response Code':
    //         this.optionsList = '<option value="200">Response Code: 200</option><option value="400">Response Code: 400</option><option value="500">Response Code: 500</option>'
    //         console.log("jsldfj", this.optionsList);
    //         break;
    //         case 'Other':
    //         this.optionsList = '<option value="other">other</option><option value="other">other</option><option value="other">other</option>'
    //         break;
    //     }
    // },
    defaultCriteria() {
      return {
        id: null,
        name: "",
        status: "active",
      };
    },

    submitForm(criteria) {
      console.log(criteria);
      if (criteria.id) {
        this.updatecriteria(criteria);
      }
    },

    async savecriteria(criteria) {
      this.isLoading(true);
      this.$inertia.post(this.route("client.criteria.store"), criteria, {
        onSuccess: () => {
          // if(this.$page.props.criteria.total > 2){
          //     if( this.$props.testimonial_count < 1){
          //         this.$bvModal.show('testimonial')
          //     }
          // }

          if (!this.$page.props.flash.error) {
            core.showSnackbar("success", "criteria added successfully.&nbsp");
          }
          this.closeModal();
          this.isLoading(false);
        },
        onError: () => {
          this.isLoading(false);
        },
        errorBag: "criteriaErrors",
      });
    },

    editCriteria(criteria) {
      this.criteria = { ...criteria.item };
    },

    async updatecriteria(criteria) {
      this.isLoading(true);
      this.$inertia.put(
        this.route("client.criteria.update", criteria.id),
        criteria,
        {
          onSuccess: () => {
            core.showSnackbar("success", "criteria updated successfully.&nbsp");
            this.criteria = this.defaultCriteria();
            this.closeModal();
            this.isLoading(false);
          },
          onError: () => {
            this.isLoading(false);
          },
          errorBag: "criteriaErrors",
        }
      );
    },

    isLoading(value) {
      this.loader = value;
    },
  },
  components: {
    ValidationProvider,
  },
};
</script>
