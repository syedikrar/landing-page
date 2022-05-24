<template>
    <b-container fluid>
        <vue-confirm-dialog class="confirm-dialog-custom"></vue-confirm-dialog>
        <div class="row">
            <b-col lg="12">
                <navbar :landing="landing"></navbar>
            </b-col>
            <div class="col-md-12">
                <b-row>
                    <b-col cols="12 text-right">
                        <!-- <b-button class="" variant="primary" target="_blank" :href="'//'+url" >  <i class="fa fa-eye"></i> Preview</b-button> -->

                        <b-button class="" variant="primary" @click="showModal('create_section')" v-if="landingForm.sections.length " >  <i class="fas fa-plus-circle"></i> Add Section</b-button>
                        <b-modal id="field_model" centered :title="'Add Field'" hide-footer>
                            <ValidationObserver ref="addFieldObserver" v-slot="{ invalid }">
                                <b-form @submit.prevent="add()" ref='createForm'>
                                    <b-form-group label="Select Field">
                                        <ValidationProvider name="Status" rules="required" v-slot="{ errors }">
                                            <b-form-select plain v-model="fieldType"
                                                :class="(errors.length > 0 ? ' is-invalid' : '')">
                                                <template v-slot:first>
                                                    <b-form-select-option :value="'predefined'" >
                                                        Predefined 
                                                    </b-form-select-option>
                                                    <b-form-select-option :value="'custom'" >
                                                        Custom 
                                                    </b-form-select-option>
                                                </template>
                                            </b-form-select>
                                            <div class="invalid-feedback">
                                                <span>{{ errors[0] }}</span>
                                            </div>
                                            <div class="invalid-feedback d-block"></div>
                                        </ValidationProvider>
                                    </b-form-group>
                                   
                                    <b-form-group label="Input Type" v-if="fieldType == 'custom'">
                                        <ValidationProvider name="type" rules="required" v-slot="{ errors }">
                                            <b-form-select plain v-model="inputType"
                                                :class="(errors.length > 0 ? ' is-invalid' : '')">
                                                <template v-slot:first>
                                                    <b-form-select-option value="text" >
                                                        Text
                                                    </b-form-select-option>
                                                    <b-form-select-option value="select" >
                                                        Select/Dropdown
                                                    </b-form-select-option>
                                                    <b-form-select-option value="checkbox" >
                                                        Checkbox
                                                    </b-form-select-option>
                                                     <b-form-select-option value="radio" >
                                                        Radio Button 
                                                    </b-form-select-option>
                                                     <b-form-select-option value="date" >
                                                        Date Picker
                                                    </b-form-select-option>
                                                    <b-form-select-option value="hidden" >
                                                        Hidden input
                                                    </b-form-select-option>
                                                </template>
                                            </b-form-select>
                                            <div class="invalid-feedback">
                                                <span>{{ errors[0] }}</span>
                                            </div>
                                            <div class="invalid-feedback d-block" ></div>
                                        </ValidationProvider>
                                    </b-form-group>
                                     <b-form-group label="Predefined Input" v-if="fieldType == 'predefined'">
                                        <ValidationProvider name="type" rules="required" v-slot="{ errors }">
                                            <b-form-select plain v-model="predefinedFieldIndex"
                                                :class="(errors.length > 0 ? ' is-invalid' : '')">
                                                <template v-slot:first>
                                                    <b-form-select-option 
                                                        :value="index"
                                                        v-for="(field, index) in predefinedFields"
                                                        :key="index">
                                                        {{field.label}} - {{field.type}}
                                                    </b-form-select-option>
                                                </template>
                                            </b-form-select>
                                            <div class="invalid-feedback">
                                                <span>{{ errors[0] }}</span>
                                            </div>
                                            <div class="invalid-feedback d-block" ></div>
                                        </ValidationProvider>
                                    </b-form-group>
                                    <div class="d-flex justify-content-end">
                                        <b-button variant=" iq-bg-primary" class="iq-waves-effect" @click="closeModal('field')">Cancel</b-button>
                                        <b-button variant="primary ml-2" class="iq-waves-effect" type="submit" :disabled="invalid || loader">
                                             Add
                                            <div v-if="loader" class="spinner-border spinner-border-sm text-secondary" role="status"></div>
                                        </b-button>
                                    </div>
                                </b-form>
                            </ValidationObserver>
                        </b-modal>
                        <b-modal id="section_model" centered :title="'Add Section'" hide-footer>
                            <ValidationObserver ref="addSectionObserver" v-slot="{ invalid }">
                                <b-form @submit.prevent="addSection()" ref='createForm'>
                                    <b-form-group
                                    class="row"
                                        label-cols-sm="3"
                                        label="Section Title"
                                        label-for="section_title" >
                                        <ValidationProvider name="section_title" rules="required" v-slot="{ errors }">
                                            <b-form-input name="section_title" placeholder="Title for the section" 
                                            v-model="SectionTitle"
                                            :class="(errors.length > 0 ? ' is-invalid' : '')"></b-form-input>
                                                <div class="invalid-feedback">
                                                    <span>{{ errors[0] }}</span>
                                                </div>
                                        </ValidationProvider>
                                    </b-form-group>
                                     <b-form-group
                                        class="row"
                                        label-cols-sm="3"
                                        label="Hide section title"
                                        label-for="hide_title" >
                                    
                                        <b-form-checkbox name="hide_title" class="mt-2"
                                        v-model="HideSectionTitle"
                                        value="1"
                                        ></b-form-checkbox>
                                            
                                    </b-form-group>
                                    <div class="d-flex justify-content-end">
                                        <b-button variant=" iq-bg-primary" class="iq-waves-effect" @click="closeModal('section')">Cancel</b-button>
                                        <b-button variant="primary ml-2" class="iq-waves-effect" type="submit" :disabled="invalid || loader">
                                             Add
                                            <div v-if="loader" class="spinner-border spinner-border-sm text-secondary" role="status"></div>
                                        </b-button>
                                    </div>
                                </b-form>
                            </ValidationObserver>
                        </b-modal>
                         <b-modal id="section_update_model" centered :title="'Update Section'" hide-footer>
                            <ValidationObserver ref="updateSectionObserver" v-slot="{ invalid }">
                                <b-form @submit.prevent="updateSection()" ref='createForm'>
                                    <b-form-group
                                        class="row"
                                        label-cols-sm="3"
                                        label="Section Title"
                                        label-for="section_title" >
                                        <ValidationProvider name="section_title" rules="required" v-slot="{ errors }">
                                            <b-form-input name="section_title" placeholder="Title for the section" 
                                            v-model="SectionTitle"
                                            :class="(errors.length > 0 ? ' is-invalid' : '')"></b-form-input>
                                                <div class="invalid-feedback">
                                                    <span>{{ errors[0] }}</span>
                                                </div>
                                        </ValidationProvider>
                                    </b-form-group>
                                    <b-form-group
                                        class="row"
                                        label-cols-sm="3"
                                        label="Hide section title"
                                        label-for="hide_title" >
                                    
                                        <b-form-checkbox name="hide_title" class="mt-2"
                                        v-model="HideSectionTitle"
                                        value="1"
                                        ></b-form-checkbox>
                                            
                                    </b-form-group>
                                    <div class="d-flex justify-content-end">
                                        <b-button variant=" iq-bg-primary" class="iq-waves-effect" @click="closeModal('section_update')">Cancel</b-button>
                                        <b-button variant="primary ml-2" class="iq-waves-effect" type="submit" :disabled="invalid || loader">
                                             Update
                                            <div v-if="loader" class="spinner-border spinner-border-sm text-secondary" role="status"></div>
                                        </b-button>
                                    </div>
                                </b-form>
                            </ValidationObserver>
                        </b-modal>
                    </b-col>
                </b-row>
                <b-row>
                    <b-col lg="12">
                          <div class="iq-edit-list-data">
                        <iq-card class="p-3 mt-3" v-if="landingForm.sections.length ">
                            <ValidationObserver ref="formObserver" >
                                <form novalidate  @submit.prevent="createlandingForm()" >
                                    
                                    <div class="accordion career-style faq-style iq-accordion mt-4 mb-3" role="tablist" 
                                        style="background-color: #efeefd; padding: 15px; border-radius: 20px;">
                                        <h4>Form settings </h4>
                                        <b-card no-body class="mb-1 iq-accordion-block mt-3" style="cursor:auto">
                                            <b-card-header header-tag="header" class="py-1 col-12 border-0" role="tab">
                                                <span style="line-height: 2.2; color:black; ">Setup Form submission url and method</span>
                                                <span class="float-right">
                                                    <b-link  v-b-toggle="'accordion-url'" class="btn btn-default text-success px-0 " >
                                                        <i class="fa fa-pen" />
                                                    </b-link> 
                                                </span>     
                                                    
                                            </b-card-header>

                                            <b-collapse :id="'accordion-url'"  accordion="my-accordion" role="tabpanel">
                                                <b-card-body>
                                                    <div class="border py-3 rounded mx-0 row ">
                                                        <div class="col-md-8">
                                                            <b-form-group  label="Form Title" label-for="input"   
                                                                class="row" label-cols-sm="2">
                                                                <ValidationProvider name="title"  :rules="{required: true}" v-slot="{ errors }">
                                                                    <b-form-input  type="text" v-model="landingForm.title"
                                                                        placeholder="Form Title"
                                                                        :class="(errors.length > 0 ? ' is-invalid' : '')"></b-form-input>
                                                                    <div class="invalid-feedback">
                                                                        <span>{{ errors[0] }}</span>
                                                                    </div>
                                                                </ValidationProvider>
                                                            </b-form-group>
                                                            <b-form-group label="Method" label-for="method" 
                                                                class="row" label-cols-sm="2">
                                                                <ValidationProvider name="method" rules="required" v-slot="{ errors }">
                                                                    <b-form-select plain v-model="landingForm.submission_method"
                                                                        :class="(errors.length > 0 ? ' is-invalid' : '')">
                                                                        <template v-slot:first>
                                                                            <b-form-select-option value="GET" >
                                                                                GET
                                                                            </b-form-select-option>
                                                                            <b-form-select-option value="POST" >
                                                                                POST
                                                                            </b-form-select-option>
                                                                        </template>
                                                                    </b-form-select>
                                                                    <div class="invalid-feedback">
                                                                        <span>{{ errors[0] }}</span>
                                                                    </div>
                                                                    <div class="invalid-feedback d-block" ></div>
                                                                </ValidationProvider>
                                                            </b-form-group>
                                                             <b-form-group label="Data Type" label-for="data_type" 
                                                                class="row" label-cols-sm="2">
                                                                <ValidationProvider name="data_type" rules="required" v-slot="{ errors }">
                                                                    <b-form-select plain v-model="landingForm.data_type"
                                                                        :class="(errors.length > 0 ? ' is-invalid' : '')">
                                                                        <template v-slot:first>
                                                                            <b-form-select-option value="json" >
                                                                                Json
                                                                            </b-form-select-option>
                                                                            <b-form-select-option value="form" >
                                                                                Form-data
                                                                            </b-form-select-option>
                                                                        </template>
                                                                    </b-form-select>
                                                                    <div class="invalid-feedback">
                                                                        <span>{{ errors[0] }}</span>
                                                                    </div>
                                                                    <div class="invalid-feedback d-block" ></div>
                                                                </ValidationProvider>
                                                            </b-form-group>
                                                                        
                                                            <b-form-group  label="Submission url" label-for="input"   
                                                                class="row" label-cols-sm="2">
                                                                <ValidationProvider name="url"  :rules="{required: true, regex: /^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/}" v-slot="{ errors }">
                                                                    <b-form-input  type="text" v-model="landingForm.submission_link"
                                                                        placeholder="submission url"
                                                                        :class="(errors.length > 0 ? ' is-invalid' : '')"></b-form-input>
                                                                    <div class="invalid-feedback">
                                                                        <span>{{ errors[0] }}</span>
                                                                    </div>
                                                                </ValidationProvider>
                                                            </b-form-group>
                                                            <b-form-group  label="Button Text" label-for="input"   
                                                                class="row" label-cols-sm="2">
                                                                <ValidationProvider name="btn_text"  :rules="{}" v-slot="{ errors }">
                                                                    <b-form-input  type="text" v-model="landingForm.btn_text"
                                                                        placeholder="Form Button Text"
                                                                        :class="(errors.length > 0 ? ' is-invalid' : '')"></b-form-input>
                                                                    <div class="invalid-feedback">
                                                                        <span>{{ errors[0] }}</span>
                                                                    </div>
                                                                </ValidationProvider>
                                                            </b-form-group>
                                                            <b-row class="m-0">
                                                                <b-col lg="2" class="pl-0"><label class="mt-1">Button Color</label></b-col>
                                                                <b-col lg="8" class="pl-0">
                                                                    <b-form-group>
                                                                        <ValidationProvider name="btn_color"  :rules="{}" v-slot="{ errors }">
                                                                            <b-form-input  type="text" v-model="landingForm.btn_color"
                                                                                placeholder="Form Button Color"
                                                                                :class="(errors.length > 0 ? ' is-invalid' : '')"></b-form-input>
                                                                                
                                                                            <div class="invalid-feedback">
                                                                                <span>{{ errors[0] }}</span>
                                                                            </div>
                                                                        </ValidationProvider>
                                                                    </b-form-group>
                                                                </b-col>
                                                                <b-col lg="2 p-0">
                                                                    <b-form-input  type="color" v-model="landingForm.btn_color" placeholder="Form Title">
                                                                    </b-form-input>
                                                                </b-col>
                                                            </b-row>
                                                             <b-row class="m-0">
                                                                <b-col lg="2" class="pl-0"><label class="mt-1">Button Background Color</label></b-col>
                                                                <b-col lg="8" class="pl-0">
                                                                    <b-form-group>
                                                                        <ValidationProvider name="btn_color"  :rules="{}" v-slot="{ errors }">
                                                                            <b-form-input  type="text" v-model="landingForm.btn_bg_color"
                                                                                placeholder="Form Button Color"
                                                                                :class="(errors.length > 0 ? ' is-invalid' : '')"></b-form-input>
                                                                                
                                                                            <div class="invalid-feedback">
                                                                                <span>{{ errors[0] }}</span>
                                                                            </div>
                                                                        </ValidationProvider>
                                                                    </b-form-group>
                                                                </b-col>
                                                                <b-col lg="2 p-0">
                                                                    <b-form-input  type="color" v-model="landingForm.btn_bg_color" placeholder="Form Title">
                                                                    </b-form-input>
                                                                </b-col>
                                                            </b-row>
                                                            <Header v-for="(header, index) in landingForm.headers"
                                                                @removeHeader="removeHeader"
                                                                :key="index"
                                                                :headerCounter="index"
                                                                :header="header"
                                                            ></Header>
                                                            <b-button class=" mb-4" variant="primary" 
                                                            @click="addHeader()" >Add Header</b-button>
                                                        
                                                        </div>
                                                        <div class="col-md-4 text-right">
                                                            <b-button class=" mb-4" variant="success" :disabled="requestLoader"
                                                            @click="testFormSubmission()" >Test Response
                                                            <div v-if="requestLoader" class="spinner-border spinner-border-sm text-secondary" role="status"></div>
                                                            </b-button>
                                                            <div>
                                                            <span @click="clearError()" v-if="testRequest" :class="testRequest=='success' ? 'text-success' : 'text-danger'"><i class="fas fa-times"></i></span>
                                                            <span :class="testRequest=='success' ? 'text-success' : 'text-danger'">{{testRequestMessage}}</span>
                                                            <span class="text-dark d-block" >{{testRequestResponse }}</span>
                                                           
                                                        </div>
                                                        </div>
                                                    </div>
                                                </b-card-body>
                                            </b-collapse>
                                        </b-card> 


                                         
                                           
                                            <b-card-header header-tag="header" class="py-1 col-12 border-2" role="tab">
                                                <span style="line-height: 2.2; color:black; ">Setup Acceptence Criteria.</span>
                                                <span class="float-right">
                                                    <b-link  v-b-toggle="'acceptence-url'" class="btn btn-default text-success px-0 " >
                                                        <i class="fa fa-pen" />
                                                    </b-link> 
                                                </span>     
                                                    
                                            </b-card-header>
                                            <b-collapse :id="'acceptence-url'"  accordion="my-accordion" role="tabpanel">
                                                <b-card-body> 
                                                    <b-card > 
                                                    <acceptenceCriteria :criteria="criteria"></acceptenceCriteria>
                                                
                                                    </b-card> 
                                                </b-card-body>
                                            </b-collapse>
                                    </div>
                                    <draggable  
                                        :list="landingForm.sections"  
                                        class="list-group" 
                                        ghost-class="ghost"
                                        v-bind="dragOptions" 
                                        group="sections" 
                                        :animation="200">
                                        <Section 
                                            @showModal="showModal" 
                                            @removeField="removeField" 
                                            @removeSection="removeSection"
                                            :landingForm="landingForm" 
                                            v-for="(section,index) in landingForm.sections" 
                                            :key="index" 
                                            :section="section"
                                            :sectionCounter="index"> 
                                        </Section>
                                    </draggable>
                                   
                                      <b-button type="submit" variant="success" class="mr-2 mt-3" :disabled="loader">
                                        Save<div v-if="loader" class="spinner-border spinner-border-sm text-secondary"
                                            role="status"></div>
                                        </b-button>
                                        <span class="font-italic align-bottom text-dark font-weight-bold mr-2" v-if="(!formSaved)">Save your changes</span>
                                   
                                    <div class="float-right">
                                         <b-button class=" mb-4 mt-3" variant="primary" @click="nextStep()" >Next</b-button>
                                    </div>
                                       
                                  
                                </form>
                            </ValidationObserver>
                        </iq-card>
                       
                      

                        <iq-card  class="p-3 mt-3" v-else>
                            <div class="text-center">
                                <img :src="require('../../assets/images/static-website-animate.svg')" class="img-fluid mb-0"
                                    alt="logo" width="360px">
                                <h2 class="mb-3 mt-0">Lets' start creating the form</h2>
                                <b-button @click="showModal('create_section')" class="mb-3" variant="primary" >Get
                                    Started
                                </b-button>
                            </div>
                        </iq-card>
                          </div>
                    </b-col>
                </b-row>
            </div>
        </div>
    </b-container>
</template>

<script>
    import { core } from "../../config/pluginInit";
    import VerticleLayout from "../../layouts/VerticleLayout";
    import { ValidationProvider, extend } from 'vee-validate';
    import { required,alpha_dash } from 'vee-validate/dist/rules';
    import Header from './Elements/Header.vue';
    import Text from './Elements/Text.vue';
    import HiddenText from './Elements/Hidden.vue';
    import Date from './Elements/Date.vue';
    import Select from './Elements/Select.vue';
    import Checkbox from './Elements/Checkbox.vue';
    import Radio from './Elements/Radio.vue';
    import draggable from 'vuedraggable'
    import Section from './Section.vue';
    import Navbar from "../Landing/Navbar.vue";
    import acceptenceCriteria from "./acceptenceCriteria.vue";
    const lodashClonedeep = require('lodash.clonedeep');

    extend('required', {
        ...required,
        message: 'This field is required'
    });

    extend('alpha_dash', {
        ...alpha_dash,
        message: 'Name attribute must be alphanumeric without spaces'
    });

    export default {
        name: "Index",
        layout: VerticleLayout,
        components: {
            ValidationProvider,
            draggable,
            Section,
            Header,
            Navbar,
            acceptenceCriteria,
        },       
        beforeMount(){
         
        },
        mounted() {
            core.index();           
            this.addFields();   
            this.saved();              
        }, 

        computed: {
            dragOptions() {
                return {
                    animation: 200,
                    group: "description",
                    disabled: false,
                    ghostClass: "ghost"
                };
            },            
        },
        props:{
            form:Object,
            landing:Object,
            criteria:Object,
            sections:Array,
            predefinedFields:Array,
            url:String,
        },
        data() {
            return {
                loader: false,
                hasAccess: false,
                permissionsArray: this.$page.props.auth.user.permissions,  
                formSaved:true,
                fieldType:'',
                inputType:'',
                SectionTitle:'',
                HideSectionTitle:false,
                predefinedFieldIndex:null,
                requestLoader:false,
                testRequest:'',
                testRequestMessage:'',
                testRequestResponse:'',
                components: [],       
                landingForm:{
                    headers:this.form.headers,
                     _method: 'put',
                    title:this.form.title,
                    submission_link:this.form.submission_link,
                    submission_method:this.form.method,
                    data_type:this.form.data_type,
                    btn_text:this.form.btn_text,
                    btn_bg_color:this.form.btn_bg_color,
                    btn_color:this.form.btn_color,
                    sections:[],
                    criteria:[],
                },  
            }
        },
        methods: {
            clearError(){
                this.testRequest='';
                this.testRequestMessage='';
                this.testRequestResponse='';
            },
            addHeader(){
                this.landingForm.headers.push({
                    key:'key',
                    value:'value'                    
                });
            },
            addSection(){
                this.landingForm.sections.push({
                    title:this.SectionTitle,
                    hide_title:this.HideSectionTitle,
                    fields:[]                    
                });
                this.closeModal('section');
            },
            updateSection(){
                this.landingForm.sections[this.currentSection].title = this.SectionTitle;
                this.landingForm.sections[this.currentSection].hide_title = this.HideSectionTitle;
                this.closeModal('section_update');
            },
            add () {
                var $newField;
                var fieldType;

                if(this.fieldType == 'custom'){
                    fieldType = this.inputType;
                    $newField = {
                        type:fieldType,
                        label: '',
                        hideLabel:false,
                        defaultValue:'',
                        placeholder: '',
                        nameAttribute:'', 
                        required:false,
                        component:'',
                        validationRule:'contains',
                        validInput:'',
                        options:[
                                {value:'option', valid:1},
                                {value:'option', valid:1},
                                {value:'option', valid:1},
                            ],
                        csv:null,
                        allValid: 1,
                        validDateFrom: null,
                        validDateTo: null
                    }
                }
                if(this.fieldType == 'predefined'){
                    
                    var predefinedField = this.$page.props.predefinedFields[this.predefinedFieldIndex];
                    fieldType = predefinedField.type;

                    $newField = {
                        type:predefinedField.type,
                        label: predefinedField.label,
                        hideLabel:false,
                        defaultValue:'',
                        placeholder: predefinedField.placeholder,
                        nameAttribute:predefinedField.attribute_name, 
                        required:predefinedField.required,
                        component:'',
                        validationRule:predefinedField.validation_rule,
                        validInput:predefinedField.valid_input,
                        options:predefinedField.options,
                        csv:null,
                        allValid: 1,
                        validDateFrom: null,
                        validDateTo: null
                    }
                }
                switch(fieldType) {
                    case 'text':
                        $newField.component=Text;
                        $newField.options =[]
                        break;
                    case 'hidden':
                        $newField.component=HiddenText;
                        $newField.options =[]
                        break;
                    case 'date':
                        $newField.component=Date;
                        $newField.options =[]
                        break;
                    case 'select':
                        $newField.component=Select;
                        break;
                    case 'checkbox':
                        $newField.component=Checkbox;
                        break;
                    case 'radio':
                        $newField.component=Radio;
                        break;
                }                   
                this.landingForm.sections[this.currentSection].fields.push($newField);
                this.closeModal('fields');
            },
             removeHeader(headerCounter){
                this.landingForm.headers.splice(headerCounter,1);  
            },
            removeSection(sectionCounter){
                this.$confirm({
                    title: 'Are you sure you?',
                    message: "Are you sure you wan't to delete this section? (All the fields of this section will also be removed). This action can not be reverted once saved",
                    button: {
                        yes: 'Yes',
                        no: 'Cancel'
                    },
                    /**
                     * Callback Function
                     * @param {Boolean} confirm 
                     */
                    callback: confirm => {
                        if (confirm) {
                             this.landingForm.sections.splice(sectionCounter,1);
                        } else {
                            
                        }
                    },
                })
                
            },
             removeField(sectionCounter,counter){
                 this.$confirm(
                {
                    title: 'Are you sure you?',
                    message: "Are you sure you wan't to delete this field. This action can not be reverted once saved",
                    button: {
                        yes: 'Yes',
                        no: 'Cancel'
                    },
                    /**
                     * Callback Function
                     * @param {Boolean} confirm 
                     */
                    callback: confirm => {
                        if (confirm) {
                             this.landingForm.sections[sectionCounter].fields.splice(counter,1);
                        } else {
                            
                        }
                    },
                }
            )
               
            },
            closeModal(type) {
                if(type=='fields'){
                    this.$bvModal.hide('field_model')
                    this.fieldType = '';
                    this.inputType = '';
                    requestAnimationFrame(() => {
                        this.$refs.addFieldObserver.reset();
                    })
                }
                if(type=='section'){
                    this.$bvModal.hide('section_model')
                    this.SectionTitle = '';
                    requestAnimationFrame(() => {
                        this.$refs.addSectionObserver.reset();
                    })
                }
                if(type=='section_update'){
                    this.$bvModal.hide('section_update_model')
                    this.SectionTitle = '';
                    requestAnimationFrame(() => {
                        this.$refs.updateSectionObserver.reset();
                    })
                }
                
            },
            showModal(type, sectionCounter) {  
                if (type == 'create') {
                    this.$bvModal.show('field_model')
                    this.currentSection = sectionCounter;
                }
                if (type == 'create_section') {
                    this.SectionTitle = ''
                    this.HideSectionTitle = false
                    this.$bvModal.show('section_model')
                }
                if(type=='update_section'){
                    this.$bvModal.show('section_update_model')
                    this.SectionTitle = this.landingForm.sections[sectionCounter].title
                    this.HideSectionTitle = this.landingForm.sections[sectionCounter].hide_title
                    this.currentSection = sectionCounter;
                }
            },
            async createlandingForm() {
              
                // this.isLoading(true)
                 const isValid = await this.$refs.formObserver.validate()
                if (isValid) {
                  
                    let data =lodashClonedeep(this.landingForm);
                    data.sections.forEach((section)=>{
                    
                        section.fields.forEach((field)=>{
                        field.component=null
                        })
                    })
                    this.$inertia.post(this.route('client.forms.update',this.form.id), data, {
                        onSuccess: () => {
                            core.showSnackbar("success", "Form has been updated successfully.&nbsp");
                            this.isLoading(false);
                            this.formSaved = true;
                        },
                        onError: () => {
                            this.isLoading(false);
                        },
                        errorBag: 'checkLanding',
                    });
                }else{
                  this.checkError();
                }
            },
            isLoading(value) {
                this.loader = value;
            },
            isRequestLoading(value) {
                this.requestLoader= value;
            },
            checkError(){
                this.$root.$emit('bv::toggle::collapse', document.getElementsByClassName('is-invalid')[0].closest(".collapse").id);

            },

            checkUserPermissions(value) {
                return this.permissionsArray.includes(value);
            },
            addFields(){
                this.sections.forEach((section)=>{
                    
                    var existingSection = {
                        title:section.title,
                        hide_title:section.hide_title,
                        fields:[]
                    }
                    section.fields.forEach((field)=>{

                        var existingField ={
                            type:field.type,
                            label: field.label,
                            hideLabel:field.hide_label,
                            placeholder: field.placeholder,
                            defaultValue: field.default_value,
                            nameAttribute:field.attribute_name, 
                            required:field.required,
                            component:'',
                            options:field.options, 
                            validationRule:field.validation_rule,
                            validInput:field.valid_input,
                            csv:null,
                            allValid: field.all_valid,
                            validDateFrom: field.valid_date_from,
                            validDateTo: field.valid_date_to
                        };
                        switch(field.type) {
                        case 'text':
                            existingField.component=Text;
                            existingField.options =[]
                            break;
                        case 'hidden':
                            existingField.component=HiddenText;
                            existingField.options =[]
                            break;
                        case 'date':
                            existingField.component=Date;
                            existingField.options =[]
                            break;
                        case 'select':
                            existingField.component=Select;
                            break;
                        case 'checkbox':
                            existingField.component=Checkbox;
                            break;
                        case 'radio':
                            existingField.component=Radio;
                            break;
                        }
                        existingSection.fields.push(existingField);
                    })
                    this.landingForm.sections.push(existingSection);
                });
            },
            async  testFormSubmission(){
                 const isValid = await this.$refs.formObserver.validate()
                if (isValid) {
               this.isRequestLoading(true)
               let testData = lodashClonedeep(this.landingForm);
                    testData.sections.forEach((section)=>{
                    
                        section.fields.forEach((field)=>{
                        field.component=null
                        })
                    })
                axios({
                    method: 'post',
                    url:this.route('client.landing.test_response'),
                    data:{
                            method: this.landingForm.submission_method,
                            link: this.landingForm.submission_link, 
                            headers: this.landingForm.headers,
                            data_type: this.landingForm.data_type,
                            sections: testData.sections
                        },  
                    })
                .then((response)=> {
                    this.testRequest = response.data.status;
                    this.testRequestMessage = response.data.message;
                    this.testRequestResponse = response.data.response;
                    this.isRequestLoading(false);
                });
                }else{
                     this.checkError();
                }
                
            },
            saved() {
                setTimeout(() => this.formSaved = true, 500);
            },
            nextStep(){
                if( this.formSaved){
                    this.$inertia.get(route('client.landing.tracking', this.landing.id))
                }else{
                     this.$confirm(
                    {
                        title: 'Unsaved Changes?',
                        message: "Are you sure you wan't to leave this page without saving the form?",
                        button: {
                            yes: 'Yes',
                            no: 'Cancel'
                        },
                        /**
                         * Callback Function
                         * @param {Boolean} confirm 
                         */
                        callback: confirm => {
                            if (confirm) {
                                this.$inertia.get(route('client.landing.tracking', this.landing.id))
                            } else {
                            }
                        },
                    });
                }
            }
        },
         
         watch: {
            landingForm: {
                handler: function(val, oldVal) {
                    this.formSaved= false;
                },
                deep: true,
            }
        },
    }
</script>

