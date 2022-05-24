<template>
    <b-card no-body class="mb-1 iq-accordion-block">
        <b-card-header header-tag="header" class="py-1 col-12 border-0" role="tab">
           <span style="line-height: 2.2; color:black;">{{field.label ? field.label: 'Select/Dropdown Block'}}</span>
           <span class="float-right">
            <b-link  v-b-toggle="'accordion-'+sectionCounter+'-'+ counter" class="btn btn-default text-success px-0 " >
              <i class="fa fa-pen" />
            </b-link> 
           <button type="button" @click="removeField(sectionCounter,counter)" data-action-type="remove" class="btn btn-default text-danger px-0 " >
                <i class="fa fa-trash"></i>
            </button>   
            </span>                
        </b-card-header>

        <b-collapse :id="'accordion-'+sectionCounter+'-'+counter"  accordion="my-accordion" role="tabpanel">
            <b-card-body>
                <div class="border py-3 rounded mx-0 ">
                 <div class="col-md-8">
                 <b-form-group
                        class="row"
                        label-cols-sm="2"
                        label="Required"
                        label-for="select_field_required[]" >
                        <b-form-checkbox name="select_field_required[]" class="mt-2"
                        v-model="field.required"
                        value="1"
                        ></b-form-checkbox>
                            
                    </b-form-group>
                    <b-form-group
                        class="row"
                        label-cols-sm="2"
                        label="Input Label"
                        label-for="select_field_label[]" >
                        <ValidationProvider :name="'select_field_label'+counter" rules="required" v-slot="{ errors }">
                            <b-form-input name="select_field_label[]" placeholder="Label for the input" 
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
                        label-for="select_field_hide_label[]" >
                     
                        <b-form-checkbox name="select_field_hide_label[]" class="mt-2"
                        v-model="field.hideLabel"
                        value="1"
                        ></b-form-checkbox>
                            
                    </b-form-group>
                    <b-form-group
                        class="row"
                        label-cols-sm="2"
                        label="Placeholder"
                        label-for="select_field_placeholder[]" >
                        <ValidationProvider :name="'select_field_placeholder'+counter" rules="required" v-slot="{ errors }">
                            <b-form-input name="select_field_placeholder[]" placeholder="Placeholder for the input" 
                             v-model="field.placeholder"
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
                        label-for="select_field_name_attribute[]">
                        <ValidationProvider :name="'select_field_name_attribute'+counter" rules="required|alpha_dash" v-slot="{ errors }">
                            <b-form-input name="select_field_name_attribute[]" placeholder="Name attribute for the input"  
                            v-model="field.nameAttribute"
                            :class="(errors.length > 0 ? ' is-invalid' : '')"></b-form-input>
                            <div class="invalid-feedback">
                                <span>{{ errors[0] }}</span>
                            </div>
                        </ValidationProvider>
                    </b-form-group>
                    <h5 class="mb-3">Options</h5>
                        <Option  v-for="(options, index) in field.options"
                         @removeOption="removeOption"
                                :key="index"
                                :counter="counter"
                                :optionCounter="index"
                                :field="field"
                                :sectionCounter="sectionCounter"
                                 ></Option>
                        <b-button class=" mb-4" variant="primary" @click="addOption(counter)" >Add Option</b-button>
                        <b-form-group
                        class="row"
                        label-cols-sm="2"
                        label="Add options with csv file"
                        label-for="radio_field_csv[]">
                         <b-form-file name="radio_field_csv[]" accept=".csv,.xlxx"
                            v-model="field.csv"
                            placeholder="Choose a file or drop it here..."
                            drop-placeholder="Drop file here..."
                            ></b-form-file>
                        </b-form-group>

                   </div>
                    
                </div>
            </b-card-body>
        </b-collapse>
    </b-card>  
</template>

<script>
    import Option from './Option';
    export default {
        name:'Select',
        components: {
        Option: Option
        },
        props: ['counter','sectionCounter','field'],
        methods: {
            removeField(sectionCounter,counter) {
                this.$emit('removeField',sectionCounter,counter)
            },
            addOption () {          
                this.field.options.push( {value:'option', valid:1});               
            },
            removeOption(counter, optionCounter) {
                this.field.options.splice(optionCounter,1);
            }
        }
    }
</script>