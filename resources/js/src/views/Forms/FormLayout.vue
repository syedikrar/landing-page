<template>
  <b-container fluid>
    <b-row>
      <b-col lg="6" sm="12">
        <iq-card>
          <template v-slot:headerTitle>
            <h4 class="card-title">Basic Form</h4>
          </template>
          <template v-slot:headerAction>
            <b-link class="text-primary float-right" v-b-toggle.collapse-1>
              <i class="ri-code-s-slash-line" />
            </b-link>
          </template>
          <template v-slot:body>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vulputate, ex ac venenatis mollis, diam nibh finibus leo</p>
            <b-collapse id="collapse-1" class="mb-2">
              <div class="card">
                <kbd class="bg-dark">
                  <pre class="text-white" id="form-1">
                    <code>
 <b-form>
  <b-form-group label="Email address:" label-for="email1">
    <b-form-input id="email1" type="email"></b-form-input>
  </b-form-group>
  <b-form-group label="Password:" label-for="pwd">
    <b-form-input id="pwd" type="password" ></b-form-input>
  </b-form-group>
  <b-form-checkbox class="mb-3">
    Remember me
  </b-form-checkbox>
  <b-button type="submit" variant="primary">Submit</b-button>
  <b-button type="submit" variant="none" class="iq-bg-danger ml-3">Cancle</b-button>
</b-form>
</code></pre>
                </kbd>
              </div>
            </b-collapse>
            <b-form>
              <b-form-group label="Email address:" label-for="email1">
                <b-form-input id="email1" type="email"></b-form-input>
              </b-form-group>
              <b-form-group label="Password:" label-for="pwd">
                <b-form-input id="pwd" type="password" ></b-form-input>
              </b-form-group>
              <b-form-checkbox class="mb-3">
                Remember me
              </b-form-checkbox>
              <b-button type="submit" variant="primary">Submit</b-button>
              <b-button type="submit" variant="none" class="iq-bg-danger ml-3">Cancle</b-button>
            </b-form>
          </template>
        </iq-card>
        <iq-card>
          <template v-slot:headerTitle>
            <h4 class="card-title">Form Grid</h4>
          </template>
          <template v-slot:headerAction>
            <b-link class="text-primary float-right" v-b-toggle.collapse-2>
              <i class="ri-code-s-slash-line" />
            </b-link>
          </template>
          <template v-slot:body>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vulputate, ex ac venenatis mollis, diam nibh finibus leo</p>
            <b-collapse id="collapse-2" class="mb-2">
              <div class="card">
                <kbd class="bg-dark">
                  <pre class="text-white" id="form-2">
                    <code>
<b-form>
  <b-row>
    <b-col>
      <b-form-input type="text" placeholder="First Name"></b-form-input>
    </b-col>
    <b-col>
      <b-form-input type="text" placeholder="Last Name"></b-form-input>
    </b-col>
  </b-row>
</b-form>
</code></pre>
                </kbd>
              </div>
            </b-collapse>
            <b-form>
              <b-row>
                <b-col>
                  <b-form-input type="text" placeholder="First Name"></b-form-input>
                </b-col>
                <b-col>
                  <b-form-input type="text" placeholder="Last Name"></b-form-input>
                </b-col>
              </b-row>
            </b-form>
          </template>
        </iq-card>
        <iq-card>
          <template v-slot:headerTitle>
            <h4 class="card-title">Input</h4>
          </template>
          <template v-slot:headerAction>
            <b-link class="text-primary float-right" v-b-toggle.collapse-3>
              <i class="ri-code-s-slash-line" />
            </b-link>
          </template>
          <template v-slot:body>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vulputate, ex ac venenatis mollis, diam nibh finibus leo</p>
            <b-collapse id="collapse-3" class="mb-2">
              <div class="card">
                <kbd class="bg-dark">
                  <pre class="text-white" id="form-3">
                    <code>
<b-form>
  <b-form-group label="Input Text " label-for="exampleInputText1">
    <b-form-input id="exampleInputText1" type="text" placeholder="Enter Name" value="Mark Jhon"></b-form-input>
  </b-form-group>
  <b-form-group label="Email Input " label-for="exampleInputText3">
    <b-form-input id="exampleInputText3" type="email" value="markjhon@gmail.com" placeholder="Enter Email"></b-form-input>
  </b-form-group>
  <b-form-group label="Url Input" label-for="exampleInputurl">
    <b-form-input id="exampleInputurl" type="url" value="https://getbootstrap.com" placeholder="Enter Url"></b-form-input>
  </b-form-group>
  <b-form-group label="Telephone Input" label-for="exampleInputphone">
    <b-form-input id="exampleInputphone" type="tel" value="1-(555)-555-5555"></b-form-input>
  </b-form-group>
  <b-form-group label="Number Input" label-for="exampleInputNumber1">
    <b-form-input id="exampleInputNumber1" type="number" value="2356"></b-form-input>
  </b-form-group>
  <b-form-group label="Password Input" label-for="exampleInputPassword3">
    <b-form-input id="exampleInputPassword3" type="password" value="markjhon123" placeholder="Enter Password" ></b-form-input>
  </b-form-group>
  <b-form-group label="Date Input" label-for="exampleInputdate">
    <b-form-input id="exampleInputdate" type="date" value="2019-12-18"></b-form-input>
  </b-form-group>
  <b-form-group label="Month Input" label-for="exampleInputmonth">
    <b-form-input id="exampleInputmonth" type="month" value="2019-12"></b-form-input>
  </b-form-group>
  <b-form-group label="Week Input" label-for="exampleInputweek">
    <b-form-input id="exampleInputweek" type="week" value="2019-W46"></b-form-input>
  </b-form-group>
  <b-form-group label="Time Input" label-for="exampleInputtime">
    <b-form-input id="exampleInputtime" type="time" value="13:45"></b-form-input>
  </b-form-group>
  <b-form-group label="Date and Time Input" label-for="exampleInputdatetime">
    <b-form-input id="exampleInputdatetime" type="datetime-local" value="2019-12-19T13:45:00"></b-form-input>
  </b-form-group>
  <b-form-group label="Example textarea" label-for="exampleFormControlTextarea1">
    <b-form-textarea id="exampleFormControlTextarea1" rows="5"></b-form-textarea>
  </b-form-group>
  <b-form-checkbox class="mb-3">
    Remember me
  </b-form-checkbox>
  <b-button type="submit" variant="primary">Submit</b-button>
  <b-button type="submit" variant="none" class="iq-bg-danger ml-3">Cancle</b-button>
</b-form>
</code></pre>
                </kbd>
              </div>
            </b-collapse>
            <b-form>
              <b-form-group label="Input Text " label-for="exampleInputText1">
                <b-form-input id="exampleInputText1" type="text" placeholder="Enter Name" value="Mark Jhon"></b-form-input>
              </b-form-group>
              <b-form-group label="Email Input " label-for="exampleInputText3">
                <b-form-input id="exampleInputText3" type="email" value="markjhon@gmail.com" placeholder="Enter Email"></b-form-input>
              </b-form-group>
              <b-form-group label="Url Input" label-for="exampleInputurl">
                <b-form-input id="exampleInputurl" type="url" value="https://getbootstrap.com" placeholder="Enter Url"></b-form-input>
              </b-form-group>
              <b-form-group label="Telephone Input" label-for="exampleInputphone">
                <b-form-input id="exampleInputphone" type="tel" value="1-(555)-555-5555"></b-form-input>
              </b-form-group>
              <b-form-group label="Number Input" label-for="exampleInputNumber1">
                <b-form-input id="exampleInputNumber1" type="number" value="2356"></b-form-input>
              </b-form-group>
              <b-form-group label="Password Input" label-for="exampleInputPassword3">
                <b-form-input id="exampleInputPassword3" type="password" value="markjhon123" placeholder="Enter Password" ></b-form-input>
              </b-form-group>
              <b-form-group label="Date Input" label-for="exampleInputdate">
                <b-form-input id="exampleInputdate" type="date" value="2019-12-18"></b-form-input>
              </b-form-group>
              <b-form-group label="Month Input" label-for="exampleInputmonth">
                <b-form-input id="exampleInputmonth" type="month" value="2019-12"></b-form-input>
              </b-form-group>
              <b-form-group label="Week Input" label-for="exampleInputweek">
                <b-form-input id="exampleInputweek" type="week" value="2019-W46"></b-form-input>
              </b-form-group>
              <b-form-group label="Time Input" label-for="exampleInputtime">
                <b-form-input id="exampleInputtime" type="time" value="13:45"></b-form-input>
              </b-form-group>
              <b-form-group label="Date and Time Input" label-for="exampleInputdatetime">
                <b-form-input id="exampleInputdatetime" type="datetime-local" value="2019-12-19T13:45:00"></b-form-input>
              </b-form-group>
              <b-form-group label="Example textarea" label-for="exampleFormControlTextarea1">
                <b-form-textarea id="exampleFormControlTextarea1" rows="5"></b-form-textarea>
              </b-form-group>
              <b-form-checkbox class="mb-3">
                Remember me
              </b-form-checkbox>
              <b-button type="submit" variant="primary">Submit</b-button>
              <b-button type="submit" variant="none" class="iq-bg-danger ml-3">Cancle</b-button>
            </b-form>
          </template>
        </iq-card>
        <iq-card>
          <template v-slot:headerTitle>
            <h4 class="card-title">Input Size</h4>
          </template>
          <template v-slot:headerAction>
            <b-link class="text-primary float-right" v-b-toggle.collapse-4>
              <i class="ri-code-s-slash-line" />
            </b-link>
          </template>
          <template v-slot:body>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vulputate, ex ac venenatis mollis, diam nibh finibus leo</p>
            <b-collapse id="collapse-4" class="mb-2">
              <div class="card">
                <kbd class="bg-dark">
                  <pre class="text-white" id="form-4">
                    <code>
<b-form>
  <b-form-group label="Small" label-for="colFormLabelSm">
    <b-form-input type="email" size="sm" id="colFormLabelSm" placeholder="form-control-sm"></b-form-input>
  </b-form-group>
  <b-form-group label="Default" label-for="colFormLabel" class="mb-0">
    <b-form-input type="email" id="colFormLabel" placeholder="form-control"></b-form-input>
  </b-form-group>
  <b-form-group label="Large" label-for="colFormLabelLg">
    <b-form-input type="email" size="lg" id="colFormLabelLg" placeholder="form-control-lg"></b-form-input>
  </b-form-group>
</b-form>
</code></pre>
                </kbd>
              </div>
            </b-collapse>
            <b-form>
              <b-form-group label="Small" label-for="colFormLabelSm">
                <b-form-input type="email" size="sm" id="colFormLabelSm" placeholder="form-control-sm"></b-form-input>
              </b-form-group>
              <b-form-group label="Default" label-for="colFormLabel" class="mb-0">
                <b-form-input type="email" id="colFormLabel" placeholder="form-control"></b-form-input>
              </b-form-group>
              <b-form-group label="Large" label-for="colFormLabelLg">
                <b-form-input type="email" size="lg" id="colFormLabelLg" placeholder="form-control-lg"></b-form-input>
              </b-form-group>
            </b-form>
          </template>
        </iq-card>
      </b-col>
      <b-col lg="6" sm="12">
        <iq-card>
          <template v-slot:headerTitle>
            <h4 class="card-title">Horizontal Form</h4>
          </template>
          <template v-slot:headerAction>
            <b-link class="text-primary float-right" v-b-toggle.collapse-5>
              <i class="ri-code-s-slash-line" />
            </b-link>
          </template>
          <template v-slot:body>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vulputate, ex ac venenatis mollis, diam nibh finibus leo</p>
            <b-collapse id="collapse-5" class="mb-2">
              <div class="card">
                <kbd class="bg-dark">
                  <pre class="text-white" id="form-5">
                    <code>
<b-form>
  <b-form-group
    class="row"
    label-cols-sm="2"
    label="Email:"
    label-for="email"
  >
    <b-form-input id="email" placeholder="Enter Your email"></b-form-input>
  </b-form-group>
  <b-form-group
    class="row"
    label-cols-sm="2"
    label="Password:"
    label-for="pwd1"
  >
    <b-form-input id="pwd1" placeholder="Enter Your password"></b-form-input>
  </b-form-group>
  <b-form-group>
    <b-form-checkbox>Remember me</b-form-checkbox>
  </b-form-group>
  <b-button type="submit" variant="primary">Submit</b-button>
  <b-button type="submit" variant="none" class="iq-bg-danger ml-3">Cancle</b-button>
</b-form>
</code></pre>
                </kbd>
              </div>
            </b-collapse>
            <b-form>
              <b-form-group
                class="row"
                label-cols-sm="2"
                label="Email:"
                label-for="email"
              >
                <b-form-input id="email" placeholder="Enter Your email"></b-form-input>
              </b-form-group>
              <b-form-group
                class="row"
                label-cols-sm="2"
                label="Password:"
                label-for="pwd1"
              >
                <b-form-input id="pwd1" placeholder="Enter Your password"></b-form-input>
              </b-form-group>
              <b-form-group>
                <b-form-checkbox>Remember me</b-form-checkbox>
              </b-form-group>
              <b-button type="submit" variant="primary">Submit</b-button>
              <b-button type="submit" variant="none" class="iq-bg-danger ml-3">Cancle</b-button>
            </b-form>
          </template>
        </iq-card>
        <iq-card>
          <template v-slot:headerTitle>
            <h4 class="card-title">Form row</h4>
          </template>
          <template v-slot:headerAction>
            <b-link class="text-primary float-right" v-b-toggle.collapse-6>
              <i class="ri-code-s-slash-line" />
            </b-link>
          </template>
          <template v-slot:body>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vulputate, ex ac venenatis mollis, diam nibh finibus leo</p>
            <b-collapse id="collapse-6" class="mb-2">
              <div class="card">
                <kbd class="bg-dark">
                  <pre class="text-white" id="form-6">
                    <code>
<b-form-row>
  <b-col>
    <b-form-input type="text" placeholder="First Name"></b-form-input>
  </b-col>
  <b-col>
    <b-form-input type="text" placeholder="Last Name"></b-form-input>
  </b-col>
</b-form-row>
</code></pre>
                </kbd>
              </div>
            </b-collapse>
            <b-form-row>
              <b-col>
                <b-form-input type="text" placeholder="First Name"></b-form-input>
              </b-col>
              <b-col>
                <b-form-input type="text" placeholder="Last Name"></b-form-input>
              </b-col>
            </b-form-row>
          </template>
        </iq-card>
        <iq-card>
          <template v-slot:headerTitle>
            <h4 class="card-title">Input</h4>
          </template>
          <template v-slot:headerAction>
            <b-link class="text-primary float-right" v-b-toggle.collapse-7>
              <i class="ri-code-s-slash-line" />
            </b-link>
          </template>
          <template v-slot:body>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vulputate, ex ac venenatis mollis, diam nibh finibus leo</p>
            <b-collapse id="collapse-7" class="mb-2">
              <div class="card">
                <kbd class="bg-dark">
                  <pre class="text-white" id="form-7">
                    <code>
<b-form>
  <b-form-group
    label-for="exampleInputDisabled1"
    label="Disabled Input">
    <b-form-input type="text" id="exampleInputDisabled1" value="Mark Jhon" disabled></b-form-input>
  </b-form-group>
  <b-form-group
    label-for="exampleInputPlaceholder"
    label="Placeholder">
    <b-form-input type="text" id="exampleInputPlaceholder" placeholder="This is Placeholder"></b-form-input>
  </b-form-group>
  <b-form-group
    label-for="exampleInputReadonly"
    label="Readonly">
    <b-form-input type="text" id="exampleInputReadonly" value="Mark Jhon" readonly></b-form-input>
  </b-form-group>
  <b-form-group
    label-for="exampleInputcolor"
    label="Input color">
    <b-form-input type="color" id="exampleInputcolor" value="#1c67a2"></b-form-input>
  </b-form-group>
  <b-form-group
    label-for="exampleFormControlSelect1"
    label="Select Input">
    <b-form-select plain v-model="selected" :options="options1" id="exampleFormControlSelect1">
      <template v-slot:first>
        <b-form-select-option :value="null" disabled>Select your age</b-form-select-option>
      </template>
    </b-form-select>
  </b-form-group>
  <b-form-group
    label-for="exampleFormControlSelect2"
    label="Example multiple select">
    <b-form-select plain v-model="selected" multiple :options="options2" id="exampleFormControlSelect2">
    </b-form-select>
  </b-form-group>
  <b-form-group
    label-for="customRange1"
    label="Range Input">
    <b-form-input id="customRange1" type="range"></b-form-input>
  </b-form-group>
  <b-form-group>
    <b-form-checkbox>Default checkbox</b-form-checkbox>
    <b-form-checkbox v-model="checked1">Checked</b-form-checkbox>
    <b-form-checkbox disabled>Disabled checkbox</b-form-checkbox>
    <b-form-checkbox v-model="checked2" disabled >Disabled checkbox</b-form-checkbox>
  </b-form-group>
  <b-form-group>
    <b-form-checkbox inline>Default checkbox</b-form-checkbox>
    <b-form-checkbox v-model="checked3" inline>Checked</b-form-checkbox>
    <b-form-checkbox disabled inline>Disabled checkbox</b-form-checkbox>
    <b-form-checkbox v-model="checked2" disabled inline>Disabled checkbox</b-form-checkbox>
  </b-form-group>
  <b-form-group>
    <b-form-radio v-model="radio1" name="customRadio">Default radio</b-form-radio>
    <b-form-radio v-model="radio1" name="customRadio">Default radio</b-form-radio>
    <b-form-radio v-model="radio3" name="customRadio3">Selected radio</b-form-radio>
    <b-form-radio disabled name="customRadio4">disabled radio</b-form-radio>
    <b-form-radio disabled v-model="radio5" name="customRadio5">Selected and  disabled radio</b-form-radio>
  </b-form-group>
  <b-form-group>
    <b-form-radio inline v-model="radio2" name="customRadio1">Default radio</b-form-radio>
    <b-form-radio inline v-model="radio2" name="customRadi1">Default radio</b-form-radio>
    <b-form-radio inline v-model="radio6" name="customRadio6">Selected radio</b-form-radio>
    <b-form-radio inline v-model="radio7" disabled name="customRadio7">disabled radio</b-form-radio>
    <b-form-radio inline disabled v-model="radio8" name="customRadio8">Selected and  disabled radio</b-form-radio>
  </b-form-group>
  <b-form-group>
    <b-form-checkbox name="check-button" switch>Toggle this switch element</b-form-checkbox>
    <b-form-checkbox v-model="switch1" name="check-button" switch>Toggle this switch element</b-form-checkbox>
    <b-form-checkbox disabled name="check-button" switch>Disabled switch element</b-form-checkbox>
  </b-form-group>
  <b-form-group
    label-for="exampleFormControlFile1"
    label="Example file input"
  >
    <b-form-file plain id="exampleFormControlFile1"></b-form-file>
  </b-form-group>
  <b-form-group
    label-for="customFile"
  >
    <b-form-file
      placeholder="Choose a file"
      id="customFile"
    ></b-form-file>
  </b-form-group>
  <b-button type="submit" variant="primary">Submit</b-button>
  <b-button type="submit" variant="none" class="iq-bg-danger ml-3">Cancle</b-button>
</b-form>
</code></pre>
                </kbd>
              </div>
            </b-collapse>
            <b-form>
              <b-form-group
                label-for="exampleInputDisabled1"
                label="Disabled Input">
                <b-form-input type="text" id="exampleInputDisabled1" value="Mark Jhon" disabled></b-form-input>
              </b-form-group>
              <b-form-group
                label-for="exampleInputPlaceholder"
                label="Placeholder">
                <b-form-input type="text" id="exampleInputPlaceholder" placeholder="This is Placeholder"></b-form-input>
              </b-form-group>
              <b-form-group
                label-for="exampleInputReadonly"
                label="Readonly">
                <b-form-input type="text" id="exampleInputReadonly" value="Mark Jhon" readonly></b-form-input>
              </b-form-group>
              <b-form-group
                label-for="exampleInputcolor"
                label="Input color">
                <b-form-input type="color" id="exampleInputcolor" value="#1c67a2"></b-form-input>
              </b-form-group>
              <b-form-group
                label-for="exampleFormControlSelect1"
                label="Select Input">
                <b-form-select plain v-model="selectedAge" :options="options1" id="exampleFormControlSelect1">
                  <template v-slot:first>
                    <b-form-select-option :value="null" disabled>Select your age</b-form-select-option>
                  </template>
                </b-form-select>
              </b-form-group>
              <b-form-group
                label-for="exampleFormControlSelect2"
                label="Example multiple select">
                <b-form-select plain v-model="selected" multiple :options="options2" id="exampleFormControlSelect2">
                </b-form-select>
              </b-form-group>
              <b-form-group
                label-for="customRange1"
                label="Range Input">
                <b-form-input id="customRange1" type="range"></b-form-input>
              </b-form-group>
              <b-form-group>
                <b-form-checkbox>Default checkbox</b-form-checkbox>
                <b-form-checkbox v-model="checked1">Checked</b-form-checkbox>
                <b-form-checkbox disabled>Disabled checkbox</b-form-checkbox>
                <b-form-checkbox v-model="checked2" disabled >Disabled checkbox</b-form-checkbox>
              </b-form-group>
              <b-form-group>
                <b-form-checkbox inline>Default checkbox</b-form-checkbox>
                <b-form-checkbox v-model="checked3" inline>Checked</b-form-checkbox>
                <b-form-checkbox disabled inline>Disabled checkbox</b-form-checkbox>
                <b-form-checkbox v-model="checked2" disabled inline>Disabled checkbox</b-form-checkbox>
              </b-form-group>
              <b-form-group>
                <b-form-radio v-model="radio1" name="customRadio">Default radio</b-form-radio>
                <b-form-radio v-model="radio1" name="customRadio">Default radio</b-form-radio>
                <b-form-radio v-model="radio6" name="customRadio3" value="true">Selected radio</b-form-radio>
                <b-form-radio disabled name="customRadio4">disabled radio</b-form-radio>
                <b-form-radio disabled v-model="radio6" name="customRadio5" value="true">Selected and  disabled radio</b-form-radio>
              </b-form-group>
              <b-form-group>
                <b-form-radio inline v-model="radio2" name="customRadio1">Default radio</b-form-radio>
                <b-form-radio inline v-model="radio2" name="customRadio1">Default radio</b-form-radio>
                <b-form-radio inline v-model="radio6" name="customRadio6" value="true">Selected radio</b-form-radio>
                <b-form-radio inline v-model="radio7" disabled name="customRadio7">disabled radio</b-form-radio>
                <b-form-radio inline disabled v-model="radio8" name="customRadio8" value="dissel">Selected and  disabled radio</b-form-radio>
              </b-form-group>
              <b-form-group>
                <b-form-checkbox name="check-button" switch>Toggle this switch element</b-form-checkbox>
                <b-form-checkbox v-model="switch1" name="check-button" switch>Toggle this switch element</b-form-checkbox>
                <b-form-checkbox disabled name="check-button" switch>Disabled switch element</b-form-checkbox>
              </b-form-group>
              <b-form-group
                label-for="exampleFormControlFile1"
                label="Example file input"
              >
                <b-form-file plain id="exampleFormControlFile1"></b-form-file>
              </b-form-group>
              <b-form-group
                label-for="customFile"
              >
                <b-form-file
                  placeholder="Choose a file"
                  id="customFile"
                ></b-form-file>
              </b-form-group>
              <b-button type="submit" variant="primary">Submit</b-button>
              <b-button type="submit" variant="none" class="iq-bg-danger ml-3">Cancle</b-button>
            </b-form>
          </template>
        </iq-card>
        <iq-card>
          <template v-slot:headerTitle>
            <h4 class="card-title">Select Size</h4>
          </template>
          <template v-slot:headerAction>
            <b-link class="text-primary float-right" v-b-toggle.collapse-8>
              <i class="ri-code-s-slash-line" />
            </b-link>
          </template>
          <template v-slot:body>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vulputate, ex ac venenatis mollis, diam nibh finibus leo</p>
            <b-collapse id="collapse-8" class="mb-2">
              <div class="card">
                <kbd class="bg-dark">
                  <pre class="text-white" id="form-8">
                    <code>
<b-form-group label="small">
  <b-form-select plain v-model="selected" :options="options3" size="sm" class="mb-3">
    <template v-slot:first>
      <b-form-select-option :value="null">Open this select menu</b-form-select-option>
    </template>
  </b-form-select>
</b-form-group>
<b-form-group label="Default">
  <b-form-select plain v-model="selected" :options="options3" class="mb-3">
    <template v-slot:first>
      <b-form-select-option :value="null">Open this select menu</b-form-select-option>
    </template>
  </b-form-select>
</b-form-group>
<b-form-group label="Large">
  <b-form-select plain v-model="selected" :options="options3" size="lg">
    <template v-slot:first>
      <b-form-select-option :value="null">Open this select menu</b-form-select-option>
    </template>
  </b-form-select>
</b-form-group>
</code></pre>
                </kbd>
              </div>
            </b-collapse>
            <b-form-group label="small">
              <b-form-select plain v-model="selected3" :options="options3" size="sm" class="mb-3">
                <template v-slot:first>
                  <b-form-select-option :value="null">Open this select menu</b-form-select-option>
                </template>
              </b-form-select>
            </b-form-group>
            <b-form-group label="Default">
              <b-form-select plain v-model="selected3" :options="options3" class="mb-3">
                <template v-slot:first>
                  <b-form-select-option :value="null">Open this select menu</b-form-select-option>
                </template>
              </b-form-select>
            </b-form-group>
            <b-form-group label="Large">
              <b-form-select plain v-model="selected3" :options="options3" size="lg">
                <template v-slot:first>
                  <b-form-select-option :value="null">Open this select menu</b-form-select-option>
                </template>
              </b-form-select>
            </b-form-group>
          </template>
        </iq-card>
      </b-col>
    </b-row>
  </b-container>
</template>
<script>
import { core } from '../../config/pluginInit'
export default {
  name: 'FormLayout',
  mounted () {
    core.index()
  },
  data () {
    return {
      selectedAge: '0-18',
      selected: ['select-1'],
      selected3: null,
      options1: [
        { value: '0-18', text: '0-18' },
        { value: '18-26', text: '18-26' },
        { value: '26-46', text: '26-46' },
        { value: '46-60', text: '46-60' },
        { value: 'Above 60', text: 'Above 60' }
      ],
      options2: [
        { value: 'select-1', text: 'select-1' },
        { value: 'select-2', text: 'select-2' },
        { value: 'select-3', text: 'select-3' },
        { value: 'select-4', text: 'select-4' },
        { value: 'select-5', text: 'select-5' },
        { value: 'select-6', text: 'select-6' },
        { value: 'select-7', text: 'select-7' },
        { value: 'select-8', text: 'select-8' }
      ],
      checked1: true,
      checked2: true,
      checked3: true,
      radio1: false,
      radio2: true,
      radio3: true,
      radio5: true,
      radio6: 'true',
      radio7: false,
      radio8: 'dissel',
      switch1: true,
      options3: [
        { value: '1', text: 'One' },
        { value: '2', text: 'Two' },
        { value: '3', text: 'Three' }
      ]
    }
  }
}
</script>
