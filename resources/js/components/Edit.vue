<template>
  <div class="Polaris-Page">
    <div class="Polaris-Page-Header">
      <div class="Polaris-Page-Header__MainContent">
        <div class="Polaris-Page-Header__TitleActionMenuWrapper">
          <div>
            <div class="Polaris-Header-Title__TitleAndSubtitleWrapper">
              <div class="Polaris-Header-Title">
                <h1 class="Polaris-DisplayText Polaris-DisplayText--sizeLarge">Edit Widget</h1>
              </div>
            </div>
          </div>
        </div>
        <div class="Polaris-Page-Header__PrimaryActionWrapper">
          <a :href="url" class="Polaris-Button Cancle"><span class="Polaris-Button__Content"><span class="Polaris-Button__Text">Cancel</span></span></a>
        </div>
      </div>
    </div>
    <div class="Polaris-Page__Content">
      <div class="Polaris-Card">
        <div class="Polaris-Card__Section">
          <div class="Polaris-ResourceList__SpinnerContainer" style="padding-top: 42px;" v-if="loading"><span class="Polaris-Spinner Polaris-Spinner--colorTeal Polaris-Spinner--sizeLarge"><svg viewBox="0 0 44 44" xmlns="http://www.w3.org/2000/svg">
                <path d="M15.542 1.487A21.507 21.507 0 00.5 22c0 11.874 9.626 21.5 21.5 21.5 9.847 0 18.364-6.675 20.809-16.072a1.5 1.5 0 00-2.904-.756C37.803 34.755 30.473 40.5 22 40.5 11.783 40.5 3.5 32.217 3.5 22c0-8.137 5.3-15.247 12.942-17.65a1.5 1.5 0 10-.9-2.863z"></path>
                </svg></span><span role="status"><span class="Polaris-VisuallyHidden">Items are loading</span></span></div>
                <div class="Polaris-ResourceList__LoadingOverlay" v-if="loading"></div>
   <form method="post" @submit.prevent="getFormValues">
    <div class="Polaris-FormLayout">
        <div class="Polaris-FormLayout__Item">
            <!-- <span class="Polaris-TextStyle--variationStrong">Widget Type</span>
            <div class="Polaris-Stack">
            <div class="Polaris-Stack__Item">
              <div><label class="Polaris-Choice" for="disabled"><span class="Polaris-Choice__Control"><span class="Polaris-RadioButton">
                <input id="disabled" name="accounts" type="radio" class="Polaris-RadioButton__Input" aria-describedby="disabledHelpText" value="1" checked="" v-model="widget.room" @change="typechange">
                <span class="Polaris-RadioButton__Backdrop"></span><span class="Polaris-RadioButton__Icon"></span></span></span><span class="Polaris-Choice__Label">Client Room</span></label>
              </div>
            </div>
            <div class="Polaris-Stack__Item">
              <div><label class="Polaris-Choice" for="optional"><span class="Polaris-Choice__Control"><span class="Polaris-RadioButton">
                <input id="optional" name="accounts" type="radio" class="Polaris-RadioButton__Input" aria-describedby="optionalHelpText" value="2" v-model="widget.room" @change="typechange">
                <span class="Polaris-RadioButton__Backdrop"></span><span class="Polaris-RadioButton__Icon"></span></span></span><span class="Polaris-Choice__Label">Sample Room</span></label>
              </div>
            </div>
          </div> -->
          <div class="Polaris-Labelled__LabelWrapper">
              <div class="Polaris-Label">
                <label id="PolarisTextField9Label" for="PolarisTextField9" class="Polaris-Label__Text">Name</label></div>
            </div>
            <div class="Polaris-Connected">
              <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                <div class="Polaris-TextField">
                    <input id="PolarisTextField9" class="Polaris-TextField__Input" type="text" aria-labelledby="PolarisTextField8Label" aria-invalid="false" aria-multiline="false" v-model="widget.text" value="" @change="textchange" required="">
                  <div class="Polaris-TextField__Backdrop"></div>
                </div>
              </div>
            </div>
            <div class="">
              <span class="Polaris-TextStyle--variationStrong arttextstyle">Artwork</span>
              <div class="Polaris-Stack artwok-stack">
              <div class="Polaris-Stack__Item">
                <div><label class="Polaris-Choice" for="disabled"><span class="Polaris-Choice__Control"><span class="Polaris-RadioButton">
                  <input id="disabled" name="accounts" type="radio" class="Polaris-RadioButton__Input" aria-describedby="disabledHelpText" value="dynamic" checked="" v-model="widget.room" @change="typechange">
                  <span class="Polaris-RadioButton__Backdrop"></span><span class="Polaris-RadioButton__Icon"></span></span></span><span class="Polaris-Choice__Label">Dynamic</span></label>
                </div>
              </div>
              <div class="Polaris-Stack__Item">
                <div><label class="Polaris-Choice" for="optional"><span class="Polaris-Choice__Control"><span class="Polaris-RadioButton">
                  <input id="optional" name="accounts" type="radio" class="Polaris-RadioButton__Input" aria-describedby="optionalHelpText" value="artwork" v-model="widget.room" @change="typechange">
                  <span class="Polaris-RadioButton__Backdrop"></span><span class="Polaris-RadioButton__Icon"></span></span></span><span class="Polaris-Choice__Label">Not Specified</span></label>
                </div>
              </div>
            </div>
            <!-- <div class="Polaris-Labelled__LabelWrapper">
              <div class="Polaris-Label"><label id="PolarisSelect2Label" for="PolarisSelect2" class="Polaris-Label__Text">Style</label></div>
            </div>
            <div class="Polaris-Select">
                <select id="PolarisSelect2" class="Polaris-Select__Input" aria-invalid="false" v-model="widget.layout" @change="layoutchange">
                <option value="Default Widget">Default Widget</option>
                <option value="Custom Widget">Custom Widget</option>
              </select>
              <div class="Polaris-Select__Content" aria-hidden="true"><span class="Polaris-Select__SelectedOption selecttype">{{widget.layout}}</span><span class="Polaris-Select__Icon"><span class="Polaris-Icon"><svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                      <path d="M13 8l-3-3-3 3h6zm-.1 4L10 14.9 7.1 12h5.8z" fill-rule="evenodd"></path>
                    </svg></span></span></div>
              <div class="Polaris-Select__Backdrop"></div>
            </div>
            <div role="group" class="Polaris-FormLayout--grouped customfields">
              <div class="Polaris-FormLayout__Items">
                <div class="Polaris-FormLayout__Item">
                  <div class="">
                    <div class="Polaris-Labelled__LabelWrapper">
                      <div class="Polaris-Label"><label id="PolarisTextField7Label" for="PolarisTextField7" class="Polaris-Label__Text">Widget Button Background Color</label></div>
                    </div>
                    <div class="Polaris-Connected">
                      <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                        <div class="Polaris-TextField">
                            <input id="PolarisTextField7" class="Polaris-TextField__Input" type="color" aria-labelledby="PolarisTextField7Label" aria-invalid="false" aria-multiline="false" value="#E31E37" v-model="widget.bg_color" @change="colorchange">
                          <div class="Polaris-TextField__Backdrop"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="Polaris-FormLayout__Item">
                  <div class="">
                    <div class="Polaris-Labelled__LabelWrapper">
                      <div class="Polaris-Label">
                        <label id="PolarisTextField8Label" for="PolarisTextField8" class="Polaris-Label__Text">Widget Button Text Color</label></div>
                    </div>
                    <div class="Polaris-Connected">
                      <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                        <div class="Polaris-TextField">
                            <input id="PolarisTextField8" class="Polaris-TextField__Input" type="color" aria-labelledby="PolarisTextField8Label" aria-invalid="false" aria-multiline="false" value="" v-model="widget.txt_color" @change="colorchange">
                          <div class="Polaris-TextField__Backdrop"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="Polaris-FormLayout__Item">
                  <div class="">
                    <div class="Polaris-Labelled__LabelWrapper">
                      <div class="Polaris-Label">
                        <label id="PolarisTextField6Label" for="PolarisTextField6" class="Polaris-Label__Text">Widget Button Border Color</label></div>
                    </div>
                    <div class="Polaris-Connected">
                      <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                        <div class="Polaris-TextField">
                            <input id="PolarisTextField6" class="Polaris-TextField__Input" type="color" aria-labelledby="PolarisTextField6Label" aria-invalid="false" aria-multiline="false" value="" v-model="widget.border_color" @change="colorchange">
                          <div class="Polaris-TextField__Backdrop"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->
            <div class="Polaris-Labelled__LabelWrapper">
              <div class="Polaris-Label"><label id="PolarisTextField4Label" for="PolarisTextField4" class="Polaris-Label__Text">Add Widget HTML Code</label></div>
            </div>
            <div class="Polaris-Connected">
              <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                <div class="Polaris-TextField Polaris-TextField--hasValue Polaris-TextField--multiline">
                    <textarea id="PolarisTextField4" class="Polaris-TextField__Input" aria-labelledby="PolarisTextField4Label" aria-invalid="false" aria-multiline="true" style="height: 108px;" v-model="widget.html_code"  @change="htmlcodechange" required=""></textarea>
                  <div class="Polaris-TextField__Backdrop"></div>
                  <div aria-hidden="true" class="Polaris-TextField__Resizer">
                    <div class="Polaris-TextField__DummyInput"><br></div>
                    <div class="Polaris-TextField__DummyInput"><br><br><br><br></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="Polaris-Labelled__LabelWrapper">
              <div class="Polaris-Label"><label id="PolarisSelect3Label" for="PolarisSelect3" class="Polaris-Label__Text">Widget Position</label></div>
            </div>
            <div class="Polaris-Select">
                <select id="PolarisSelect3" class="Polaris-Select__Input" aria-invalid="false" v-model="widget.position">
                <option value="Above Description">Above Description</option>
                <option value="Below Description">Below Description</option>
                <option value="Floating Sidebar">Floating Sidebar</option>
              </select>
              <div class="Polaris-Select__Content" aria-hidden="true"><span class="Polaris-Select__SelectedOption selectposition">{{widget.position}}</span><span class="Polaris-Select__Icon"><span class="Polaris-Icon"><svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                      <path d="M13 8l-3-3-3 3h6zm-.1 4L10 14.9 7.1 12h5.8z" fill-rule="evenodd"></path>
                    </svg></span></span></div>
              <div class="Polaris-Select__Backdrop"></div>
            </div>
          </div>
          <button type="submit" class="Polaris-Button addwidget"><span class="Polaris-Button__Content"><span class="Polaris-Button__Text">Save Widget</span></span></button>
        </div>
    </div>
  </form>
</div>
</div>
</div>
</div>
</template>

<script>
    export default {
        data(){
          return {
            widget :{
              id: '',
              txt_color:'',
              bg_color:'',
              border_color:'',
              room:'1',
              layout:'',
              html_code:'',
              position:'',
              text: ''
          },
           loading: true,
           url:'/'
          }
        },
        mounted(){
          var that= this;
          this.url = sessionStorage.getItem("url");
          this.widget.id = sessionStorage.getItem("id");
          axios.get('showewidge/'+this.widget.id).then(function (response) {
               that.widget =  response.data.widget;
               that.url = response.data.url;
                if(that.widget.layout == 'Custom Widget'){
                    $( ".customfields" ).show();
                }else{
                    $( ".customfields" ).hide();
                }
               that.loading = false;
             });
        },
        methods: {
            getFormValues(){
              var that= this;
              this.loading = true;
              axios.post('editwidget', this.widget)
             .then(function (response) {
              window.location.href=that.url;
              that.loading = false;
             });
            },
            typechange(){
                if(this.widget.html_code !=''){
                    this.htmltextchange(this.widget.html_code);
                }
            },
            textchange(){
                // if(this.html_code !=''){
                //     this.htmltextchange(this.html_code);
                // }
            },
            colorchange(ev){
               if(this.widget.html_code !=''){
                    this.htmltextchange(this.widget.html_code);
                }
            },
            layoutchange(ev){
                if(ev.target.value == 'Custom Widget'){
                    if(this.widget.html_code !=''){
                        this.htmltextchange(this.widget.html_code);
                    }
                    $( ".customfields" ).show();
                }else{
                    $( ".customfields" ).hide();
                }
            },
            htmlcodechange(ev){
               if(ev.target.value != ''){
                    this.htmltextchange(ev.target.value);
                }
                
            },
            htmltextchange(str){
                // var borderclr = 'bordercolor="'+ this.widget.border_color+'"';
                // var bgcolor = 'bgcolor="'+ this.widget.bg_color+'"';
                // var fontcolor = 'fontcolor="'+ this.widget.txt_color+'"';
                // var room ='type="'+ this.widget.room+'"';
                // var text = 'text="'+ this.widget.text+'"';
                // if(this.widget.layout == 'Custom Widget'){
                //     var position = str.indexOf("bgcolor");
                //     if(position >= 0){
                //       var res = str.substr(position, 17);
                //       var data = str.replace(res, bgcolor);
                //       str = data;
                //     }else{
                //       var pos = str.indexOf("<artplacer");
                //     //  var str = this.widget.html_code;
                //       var res = str.substr(pos, 11);
                //       var data = str.replace(res, "<artplacer "+bgcolor+" ");
                //       str = data;
                //     }

                //     var pos1 = str.indexOf("bordercolor");
                //     if(pos1 >= 0){
                //       //var str = this.widget.html_code;
                //       var res1 = str.substr(pos1, 21);
                //       var data1 = str.replace(res1, borderclr);
                //       str = data1;
                //     }else{
                //       var pos1 = str.indexOf("<artplacer");
                //      // var str = this.widget.html_code;
                //       var res1 = str.substr(pos1, 11);
                //       var data1 = str.replace(res1, "<artplacer "+borderclr+" ");
                //       str = data1;
                //     }
                //     var pos2 = str.indexOf("fontcolor");
                //     if(pos2 >= 0){
                //      // var str = this.widget.html_code;
                //       var res2 = str.substr(pos2, 19);
                //       var data2 = str.replace(res2, fontcolor);
                //       str = data2;
                //     }else{
                //       var pos2 = str.indexOf("<artplacer");
                //      // var str = this.widget.html_code;
                //       var res2 = str.substr(pos2, 11);
                //       var data2 = str.replace(res2, "<artplacer "+fontcolor+" ");
                //       str = data2;
                //     }
                //     var pos3 = str.indexOf("type"); 
                //     if(pos3 >= 0){
                //       var res3 = str.substr(pos3, 8);
                //       var data3 = str.replace(res3, room);
                //       str = data3;
                //     }else{
                //       var pos3 = str.indexOf("<artplacer");
                //       var res3 = str.substr(pos3, 11);
                //       var data3 = str.replace(res3, "<artplacer "+room+" ");
                //       str = data3;
                //     }
                //     this.widget.html_code = str;
                // }else{
                //   // var pos3 = str.indexOf("type"); 
                //   // if(pos3 >= 0){
                //   //     var res3 = str.substr(pos3, 8);
                //   //     var data3 = str.replace(res3, room);
                //   //     str = data3;
                //   //   }else{
                //   //     var pos3 = str.indexOf("<artplacer");
                //   //     var res3 = str.substr(pos3, 11);
                //   //     var data3 = str.replace(res3, "<artplacer "+room+" ");
                //   //     str = data3;
                //   //   }
                //   //   this.widget.html_code = str;
                // }
            }
        }
    }
</script>
