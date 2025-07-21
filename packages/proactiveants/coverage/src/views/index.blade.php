<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/png" href="{{url('images/logo.png')}}" />
    <title>Management Portal</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <script src="{{asset('js/vue.js')}}"></script>
    <script src="{{asset('js/axios.min.js')}}"></script>
    <style>
        html, body{
            background-color: #000;
            color: #FFF;
        }
        p{
            color: #FFF;
        }
        .panel{
            border-color: darkolivegreen;
        }
        .panel .panel-body{
            background-color: darkolivegreen;
            
        }
        .orange{
            background-color: darkorange !important ;
        }
        a:hover{
            background-color: none;
        }
        ul.nav li a:hover{
            background-color: transparent;
            color: #FFF;
            font-weight: 700;
        }
        h6 a{
            color: #FFF;
            text-decoration: none;
        }
        h6 a:hover{
            color: #FFF;
            text-decoration: none;
            font-weight: 700;
        }
        h3{
            font-size: 20px;
        }
        :-webkit-full-screen #content{
            width: 100%;
            height: 100%;
        }
        nav a{
            color:#FFF;
        }
        .warning{
            background-color: red !important ;
        }
        .panel-body{
            padding: 5px !important ;
        }
    </style>
</head>
<body id="content">
    <nav class="navbar navbar-default-inverse navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">Bluesmart School</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right" style="margin-right:20px;">
            <li><h3><a href="#" onclick="javascript:window.close()"><i class="glyphicon glyphicon-off"></i></a></h3></li>
        </ul>
        </div>
    </div>
    </nav>
    <div class="container-fluid" id="app" style="margin-top:60px;">
        <div class="row">
            <div class="col-lg-1 col-sm-2" v-for="class_room in class_rooms" v-if="class_room.id>35 && class_room.id<68" >
                <a v-bind:href="'./management/' + class_room.id" style="color:#FFF" >
                    <div class="panel panel-danger" >
                        <div class="panel-body text-left clearfix" v-bind:class="{'orange': class_room.type,'warning': class_room.warning}">
                            {{--<i class="glyphicon glyphicon-ok" style="position: absolute;top:5px; right:0; margin-right:25px;" v-if="class_room.registered"></i>--}}
                            <p style="font-size:12pt; padding:0">@{{class_room.name}} 
                                <i class="fa fa-smile fa-fw" v-if="class_room.best"></i> 
                                <i class="fa fa-meh fa-fw" v-if="class_room.good"></i> 
                                <i class="fa fa-frown fa-fw" v-if="class_room.bad"></i>
                            </p>
                            <p style="font-size:8pt; padding:0">@{{class_room.subject}}<br>
                            @{{class_room.teacher}}</p>
                            <p style="font-size:8pt; position: absolute;bottom:15px; left:0; margin-left:20px;">
                                <i class="glyphicon glyphicon-warning-sign"  v-if="class_room.warning"></i>  
                                <span v-if="class_room.registered">@{{class_room.attendance}}</span>
                            </p>
                            <p style="font-size:8pt; position: absolute;bottom:15px; right:0; margin-right:25px;" v-if="class_room.count>0">@{{class_room.count}} @{{class_room.teacher_role}}</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-1 col-sm-2" v-for="class_room in class_rooms" v-if="class_room.id>67 && class_room.id<84">
                <a v-bind:href="'./management/' + class_room.id" style="color:#FFF">
                    <div class="panel panel-danger">
                        <div class="panel-body text-left clearfix" v-bind:class="{'orange': class_room.type,'warning': class_room.warning}">
                        {{--<i class="glyphicon glyphicon-ok" style="position: absolute;top:5px; right:0; margin-right:25px;" v-if="class_room.registered"></i>--}}
                        <p style="font-size:12pt; padding:0">@{{class_room.name}} 
                            <i class="fa fa-smile fa-fw" v-if="class_room.best"></i>
                            <i class="fa fa-meh fa-fw" v-if="class_room.good"></i> 
                            <i class="fa fa-frown fa-fw" v-if="class_room.bad"></i>
                        </p>
                        <p style="font-size:8pt; padding:0">@{{class_room.subject}}<br>
                        @{{class_room.teacher}}</p>
                        <p style="font-size:8pt; position: absolute;bottom:15px; left:0; margin-left:20px;">
                            <i class="glyphicon glyphicon-warning-sign"  v-if="class_room.warning"></i>  
                            <span v-if="class_room.registered">@{{class_room.attendance}}</span>
                        </p>
                        <p style="font-size:8pt; position: absolute;bottom:15px; right:0; margin-right:25px;" v-if="class_room.count>0">@{{class_room.count}} @{{class_room.teacher_role}}</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-1 col-sm-2" v-for="class_room in class_rooms" v-if="class_room.id>83 && class_room.id<107">
                <a v-bind:href="'./management/' + class_room.id" style="color:#FFF">
                    <div class="panel panel-danger">
                        <div class="panel-body text-left clearfix" v-bind:class="{'orange': class_room.type,'warning': class_room.warning}">
                        {{--<i class="glyphicon glyphicon-ok" style="position: absolute;top:5px; right:0; margin-right:25px;" v-if="class_room.registered"></i>--}}
                        <p style="font-size:12pt; padding:0">@{{class_room.name}} 
                            <i class="fa fa-smile fa-fw" v-if="class_room.best"></i> 
                            <i class="fa fa-meh fa-fw" v-if="class_room.good"></i> 
                            <i class="fa fa-frown fa-fw" v-if="class_room.bad"></i>
                        </p>
                        <p style="font-size:8pt; padding:0">@{{class_room.subject}}<br>
                        @{{class_room.teacher}}</p>
                        <p style="font-size:8pt; position: absolute;bottom:15px; left:0; margin-left:20px;">
                            <i class="glyphicon glyphicon-warning-sign"  v-if="class_room.warning"></i>  
                            <span v-if="class_room.registered">@{{class_room.attendance}}</span>
                        </p>
                        <p style="font-size:8pt; position: absolute;bottom:15px; right:0; margin-right:25px;" v-if="class_room.count>0">@{{class_room.count}} @{{class_room.teacher_role}}</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-1 col-sm-2" v-for="class_room in class_rooms" v-if="class_room.id>120 && class_room.id<130">
                <a v-bind:href="'./management/' + class_room.id" style="color:#FFF">
                    <div class="panel panel-danger">
                        <div class="panel-body text-left clearfix" v-bind:class="{'orange': class_room.type,'warning': class_room.warning}">
                        {{--<i class="glyphicon glyphicon-ok" style="position: absolute;top:5px; right:0; margin-right:25px;" v-if="class_room.registered"></i>--}}
                        <p style="font-size:12pt; padding:0">@{{class_room.name}} 
                            <i class="fa fa-smile fa-fw" v-if="class_room.best"></i> 
                            <i class="fa fa-meh fa-fw" v-if="class_room.good"></i> 
                            <i class="fa fa-frown fa-fw" v-if="class_room.bad"></i>
                        </p>
                        <p style="font-size:8pt; padding:0">@{{class_room.subject}}<br>
                        @{{class_room.teacher}}</p>
                        <p style="font-size:8pt; position: absolute;bottom:15px; left:0; margin-left:20px;">
                            <i class="glyphicon glyphicon-warning-sign"  v-if="class_room.warning"></i>  
                            <span v-if="class_room.registered">@{{class_room.attendance}}</span>
                        </p>
                        <p style="font-size:8pt; position: absolute;bottom:15px; right:0; margin-right:25px;" v-if="class_room.count>0">@{{class_room.count}} @{{class_room.teacher_role}}</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <script>
        var app = new Vue({
            el: '#app',
            data: {
                class_rooms:[]
            },
            mounted: function(){
                axios.get('./management/class_room').then(response => this.class_rooms = response.data);
                setInterval(function(){
                    this.loadData();
                }.bind(this),5000);
            },
            methods:{
                loadData: function(){
                    axios.get('./management/class_room').then(response => this.class_rooms = response.data);
                }
            }
        });
    </script>
    <script>
        var elem = document.getElementById("content");
        function toggleFullScreen(){
            if(!document.mozFullScreen && !document.webkitFullScreen){
                if(elem.mozRequestFullScreen){
                    elem.mozRequestFullScreen();
                }
                else{
                    elem.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
                }
            }
            else{
                if(document.mozCancelFullScreen){
                    document.mozCancelFullScreen();
                }
                else{
                    document.webkitCancelFullScreen();
                }
            }
        }
        document.addEventListener("keydown", function(e){
            if(e.keyCode==13){
                toggleFullScreen();
            }
        }, false);
    </script>
</body>
</html>