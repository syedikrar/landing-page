<template>
    <b-card no-body class="mb-1 iq-accordion-block">
        <b-card-header header-tag="header" class="py-1 col-12 border-0" role="tab">
            <span style="line-height: 2.2; color:black; ">{{field.label ? field.label: 'Date Picker'}}</span>
            <span class="float-right">
            <b-link  v-b-toggle="'accordion-'+sectionCounter+'-'+ counter" class="btn btn-default text-success px-0 " >
              <i class="fa fa-pen" />
            </b-link> 
           <button type="button" @click="removeField(sectionCounter,counter)" data-action-type="remove" class="btn btn-default text-danger px-0 " >
                <i class="fa fa-trash"></i>
            </button>   
            </span>           
        </b-card-header>

        <b-collapse :id="'accordion-'+sectionCounter+'-'+ counter"  accordion="my-accordion" role="tabpanel">
            <b-card-body>
                <div class="border py-3 rounded mx-0 ">
                 <div class="col-md-8">
                 <b-form-group
                        class="row"
                        label-cols-sm="2"
                        label="Required"
                        label-for="date_field_required[]" >
                     
                        <b-form-checkbox name="date_field_required[]" class="mt-2"
                        v-model="field.required"
                        value="1"
                        ></b-form-checkbox>
                            
                    </b-form-group>
                    <b-form-group
                        class="row"
                        label-cols-sm="2"
                        label="Input Label"
                        label-for="date_field_label[]" >
                        <ValidationProvider name="Label" rules="required" v-slot="{ errors }">
                            <b-form-input name="date_field_label[]" placeholder="Label for the input" 
                            v-model="field.label"
                            :class="(errors.length > 0 ? ' is-invalid' : '')"></b-form-input>
                                <div class="invalid-feedback">
                                    <span>{{ errors[0] }}</span>
                                </div>
                        </ValidationProvider>
                    </b-form-group>
                    <b-form-group
                        class="row"
                        label-cols-sm="2"
                        label="Hide Label"
                        label-for="date_field_hide_label[]" >
                     
                        <b-form-checkbox name="date_field_hide_label[]" class="mt-2"
                        v-model="field.hideLabel"
                        value="1"
                        ></b-form-checkbox>
                            
                    </b-form-group>
                    <b-form-group
                        class="row"
                        label-cols-sm="2"
                        label="Placeholder"
                        label-for="date_field_placeholder[]" >
                        <ValidationProvider name="Placeholder" rules="required" v-slot="{ errors }">
                            <b-form-input name="date_field_placeholder[]" placeholder="Placeholder for the input"  v-model="field.placeholder"
                            :class="(errors.length > 0 ? ' is-invalid' : '')"></b-form-input>
                            <div class="invalid-feedback">
                                    <span>{{ errors[0] }}</span>
                                </div>
                        </ValidationProvider>
                    </b-form-group>
                    <b-form-group
                        class="row"
                        label-cols-sm="2"
                        label="Name Attribute"
                        label-for="date_field_name_attribute[]">
                        <ValidationProvider name="Name attribute" rules="required|alpha_dash" v-slot="{ errors }">
                            <b-form-input name="date_field_name_attribute[]" placeholder="Name attribute for the input"  v-model="field.nameAttribute"
                            :class="(errors.length > 0 ? ' is-invalid' : '')"></b-form-input>
                            <div class="invalid-feedback">
                                <span>{{ errors[0] }}</span>
                            </div>
                        </ValidationProvider>
                    </b-form-group>
                    <h5 class="mb-3">Valid Dates</h5>   
                    <b-form-group
                        class="row"
                        label-cols-sm="2"
                        label="All Valid"
                        label-for="date_field_valid[]" >
                     
                        <b-form-checkbox name="date_field_valid[]" class="mt-2"
                        v-model="field.allValid"
                        value="1"
                        ></b-form-checkbox>
                            
                    </b-form-group>
                    <b-form-group  label="Valid date from" label-for="from"    v-if="!field.allValid"
                        class="row"
                        label-cols-sm="2">
                        <ValidationProvider name="Valid date from" rules="required" v-slot="{ errors }">
                            <b-form-input 
                                v-model="field.validDateFrom"
                                type="date" value=""
                                :class="(errors.length > 0 ? ' is-invalid' : '')"
                                placeholder="Valid input"></b-form-input>
                            <div class="invalid-feedback">
                                <span>{{ errors[0] }}</span>
                            </div>
                        </ValidationProvider>
                    </b-form-group>
                    <b-form-group  label="Valid date to" label-for="to"   v-if="!field.allValid"
                        class="row"
                        label-cols-sm="2">
                        <ValidationProvider name="Valid date to" rules="required" v-slot="{ errors }">
                            <b-form-input 
                                v-model="field.validDateTo"
                                type="date" value=""
                                :class="(errors.length > 0 ? ' is-invalid' : '')"
                                placeholder="Valid input"></b-form-input>
                            <div class="invalid-feedback">
                                <span>{{ errors[0] }}</span>
                            </div>
                        </ValidationProvider>
                    </b-form-group>
                  
                   
                  </div>
                    
                </div>
            </b-card-body>
        </b-collapse>
    </b-card>  
</template>

<script>
    export default {
        name:'Date',
        props: ['counter','sectionCounter','field'],
        methods: {
            removeField(sectionCounter,counter) {
                this.$emit('removeField',sectionCounter,counter)
            }
        }
    }
</script>

