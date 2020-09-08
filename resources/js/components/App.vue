<template>
    <div class="Polaris-Page">
    <div class="Polaris-Page-Header">
        <div class="Polaris-Page-Header__MainContent">
            <div class="Polaris-Page-Header__TitleActionMenuWrapper">
            <div>
            <div class="Polaris-Header-Title__TitleAndSubtitleWrapper">
                <div class="Polaris-Header-Title">
                    <h1 class="Polaris-DisplayText Polaris-DisplayText--sizeLarge">Installed Widgets</h1>
                </div>
            </div>
            </div>
            </div>
            <div class="Polaris-Page-Header__PrimaryActionWrapper">
                <a href="create" class="Polaris-Button addwidget"><span class="Polaris-Button__Content"><span class="Polaris-Button__Text">Start Creating Widgets</span></span></a>
            </div>
        </div>
    </div>
    <div class="Polaris-Page__Content">
      <div class="Polaris-Card">
        <div class="Polaris-Card__Section">
            <!--  -->
            <div class="Polaris-ResourceList__ResourceListWrapper">
              <ul class="Polaris-ResourceList" aria-live="polite">
                <div class="Polaris-ResourceList__SpinnerContainer" style="padding-top: 42px;" v-if="loading"><span class="Polaris-Spinner Polaris-Spinner--colorTeal Polaris-Spinner--sizeLarge"><svg viewBox="0 0 44 44" xmlns="http://www.w3.org/2000/svg">
                <path d="M15.542 1.487A21.507 21.507 0 00.5 22c0 11.874 9.626 21.5 21.5 21.5 9.847 0 18.364-6.675 20.809-16.072a1.5 1.5 0 00-2.904-.756C37.803 34.755 30.473 40.5 22 40.5 11.783 40.5 3.5 32.217 3.5 22c0-8.137 5.3-15.247 12.942-17.65a1.5 1.5 0 10-.9-2.863z"></path>
                </svg></span><span role="status"><span class="Polaris-VisuallyHidden">Items are loading</span></span></div>
                <div class="Polaris-ResourceList__LoadingOverlay" v-if="loading"></div>
                <li class="Polaris-ResourceList__ItemWrapper" v-if="widgets.length == 0">
                  <div class="Polaris-ResourceItem" data-href="">
                    <div class="Polaris-ResourceItem__Container">
                      No widgets installed.
                  </div>
                  </div>
                </li>
                <li class="Polaris-ResourceList__ItemWrapper" v-for="widget in widgets" :key="widget.id">
                  <div class="Polaris-ResourceItem" data-href="">
                    <a aria-describedby="341" aria-label="View details for Mae Jemison" class="Polaris-ResourceItem__Link" tabindex="0" id="PolarisResourceListItemOverlay63" href="customers/341" data-polaris-unstyled="true"></a>
                    <div class="Polaris-ResourceItem__Container" id="widget.id">
                      <!--  -->
                      <div class="Polaris-ResourceItem__Owned">
                        <div class="Polaris-ResourceItem__Media"><span aria-label="Mae Jemison" role="img" class="Polaris-Avatar Polaris-Avatar--sizeMedium"><span class="Polaris-Avatar__Initials"><i class="zmdi zmdi-puzzle-piece"></i><!-- <svg class="Polaris-Avatar__Svg" viewBox="0 0 40 40">
                                <path fill="currentColor" d="M8.28 27.5A14.95 14.95 0 0120 21.8c4.76 0 8.97 2.24 11.72 5.7a14.02 14.02 0 01-8.25 5.91 14.82 14.82 0 01-6.94 0 14.02 14.02 0 01-8.25-5.9zM13.99 12.78a6.02 6.02 0 1112.03 0 6.02 6.02 0 01-12.03 0z"></path>
                              </svg> --></span></span></div>
                      </div>
                      <div class="Polaris-ResourceItem__Content">
                            <h3><span v-on:click="addidvalue(widget.id)" class="Polaris-TextStyle--variationStrong title">{{widget.text}}</span></h3>
                            <div>{{widget.position}}</div>
                      </div>
                     <!--   -->
                      <div class="icons_div"><i class="zmdi zmdi-delete delet_button" v-on:click="deletewidge(widget.id)"></i><!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="delet_button" v-on:click="deletewidge(widget.id)"><path fill-rule="evenodd" fill="#637381" d="M17 4h-3V2c0-1.103-.897-2-2-2H8C6.897 0 6 .897 6 2v2H3a1 1 0 1 0 0 2v13a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V6a1 1 0 1 0 0-2zM5 18h10V6H5v12zM8 4h4V2H8v2zm0 12a1 1 0 0 0 1-1V9a1 1 0 1 0-2 0v6a1 1 0 0 0 1 1m4 0a1 1 0 0 0 1-1V9a1 1 0 1 0-2 0v6a1 1 0 0 0 1 1"/></svg> --></div>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
            <!--  -->
        </div>
      </div>
    </div>
</div>
</template>

<script>
    export default {
        data(){
          return {
            widgets: [],
            loading: true,
            url: '/'
          }
        },
        mounted(){
            this.addwidget();
        },
        methods: {
            deletewidge(id){
                var that= this;
                console.log(id);
                this.loading =true;
                axios.get('destroy/'+id).then(function (response) {
                    that.addwidget();
                });   
            },
            addwidget(){
            var that= this;
            axios.get('getwidget').then(function (response) {
               that.widgets =  response.data.widgets;
               that.url = response.data.url;
               sessionStorage.setItem("url",that.url);
               that.loading = false;
             });
            },
            addidvalue(id){
                sessionStorage.setItem("id",id);
                window.location.href = this.url+"/show";
            }
        }
    }
</script>
