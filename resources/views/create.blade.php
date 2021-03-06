@extends('shopify-app::layouts.default')
@section ('styles')
<link
  rel="stylesheet"
  href="https://unpkg.com/@shopify/polaris@5.2.1/dist/styles.css"
/>
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="{{ asset('css/custom.css') }}" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
@endsection
@section('content')
<div id="load"></div>
<div id="app">
    <add></add>
</div>
<!--  -->
@endsection
@section('scripts')
    @parent
    <script type="text/javascript"  src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript">
        var AppBridge = window['app-bridge'];
        var actions = AppBridge.actions;
        var TitleBar = actions.TitleBar;
        var Button = actions.Button;
        var Redirect = actions.Redirect;
        var titleBarOptions = {
            title: '',
        };
        var myTitleBar = TitleBar.create(app, titleBarOptions);
    </script>
    <script type="text/javascript">
      function addwidget(){
        $('.firstsection').hide();
        $('.secondsection').show();
      }
      function selecposition(ev){
        $('.selectposition').text(ev.terget.value);
      }
        document.onreadystatechange = function () {
          var state = document.readyState;
          if (state == 'interactive') {
               document.getElementById('app').style.visibility="hidden";
          } else if (state == 'complete') {
              setTimeout(function(){
                 document.getElementById('interactive');
                 document.getElementById('load').style.visibility="hidden";
                 document.getElementById('app').style.visibility="visible";
              },1000);
          }
        }
        </script>
@endsection