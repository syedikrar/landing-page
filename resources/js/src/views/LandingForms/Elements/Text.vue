<template>
    <b-card no-body class="mb-1 iq-accordion-block">
        <b-card-header header-tag="header" class="py-1 col-12 border-0" role="tab">
            <span style="line-height: 2.2; color:black; ">{{field.label ? field.label: 'Text Block'}}</span>
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
                        label-for="text_field_required[]" >
                     
                        <b-form-checkbox name="text_field_required[]" class="mt-2"
                        v-model="field.required"
                        value="1"
                        ></b-form-checkbox>
                            
                    </b-form-group>
                    <b-form-group
                        class="row"
                        label-cols-sm="2"
                        label="Input Label"
                        label-for="text_field_label[]" >
                        <ValidationProvider :name="'text_field_label'+ counter" rules="required" v-slot="{ errors }">
                            <b-form-input name="text_field_label[]" placeholder="Label for the input" 
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
                        label-for="text_field_hide_label[]" >
                     
                        <b-form-checkbox name="text_field_hide_label[]" class="mt-2"
                        v-model="field.hideLabel"
                        value="1"
                        ></b-form-checkbox>
                            
                    </b-form-group>
                    <b-form-group
                        class="row"
                        label-cols-sm="2"
                        label="Placeholder"
                        label-for="text_field_placeholder[]" >
                        <ValidationProvider :name="'text_field_placeholder'+ counter" rules="required" v-slot="{ errors }">
                            <b-form-input name="text_field_placeholder[]" placeholder="Placeholder for the input"  v-model="field.placeholder"
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
                        label-for="text_field_name_attribute[]">
                        <ValidationProvider :name="'text_field_name_attribute'+ counter" rules="required|alpha_dash" v-slot="{ errors }">
                            <b-form-input name="text_field_name_attribute[]" placeholder="Name attribute for the input"  v-model="field.nameAttribute"
                            :class="(errors.length > 0 ? ' is-invalid' : '')"></b-form-input>
                            <div class="invalid-feedback">
                                <span>{{ errors[0] }}</span>
                            </div>
                        </ValidationProvider>
                    </b-form-group>
                    <b-form-group label="Valid input rule" label-for="rule" 
                        class="row"
                        label-cols-sm="2">
                        <ValidationProvider name="rule" rules="" v-slot="{ errors }">
                            <b-form-select plain   v-model="field.validationRule"
                                :class="(errors.length > 0 ? ' is-invalid' : '')">
                                <template v-slot:first>
                                    <b-form-select-option value="contains" >
                                        Contains
                                    </b-form-select-option>
                                    <b-form-select-option value="equals to" >
                                        Equals to
                                    </b-form-select-option>
                                    
                                </template>
                            </b-form-select>
                            <div class="invalid-feedback">
                                <span>{{ errors[0] }}</span>
                            </div>
                            <div class="invalid-feedback d-block" ></div>
                        </ValidationProvider>
                    </b-form-group>
                                   
                    <b-form-group  label="Valid Input" label-for="input"   
                        class="row"
                        label-cols-sm="2">
                        <ValidationProvider name="input" rules="" v-slot="{ errors }">
                            <b-form-input  type="text" v-model="field.validInput"
                                placeholder="Valid input"
                                :class="(errors.length > 0 ? ' is-invalid' : '')"></b-form-input>
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
        name:'TextElement',
        props: ['counter','sectionCounter','field'],
        methods: {
            removeField(sectionCounter,counter) {
                this.$emit('removeField',sectionCounter,counter)
            }
        }
    }
</script>

