<head>
    <link rel="icon" href="bootstrap/img/logo.JPG" type="image/x-icon"/>
    <link rel="shortcut icon" href="bootstrap/img/logo.JPG" type="image/x-icon"/>
    <title>STACIONE</title>
    <!-- BOOTSTRAP STYLES-->
    <script src="bootstrap/js/jquery-2.1.4.js"></script>
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet"/>
    <!-- FONTAWESOME STYLES-->
    <link href="bootstrap/css/font-awesome.css" rel="stylesheet"/>
    <!-- MORRIS CHART STYLES-->
    <link href="bootstrap/js/morris/morris-0.4.3.min.css" rel="stylesheet"/>
    <!-- CUSTOM STYLES-->
    <link href="bootstrap/css/custom.css" rel="stylesheet"/>
    <script src="bootstrap/js/jquery.maskedinput.js"></script>
    <script src="bootstrap/js/bootstrap-tooltip.js"></script>
    <script src="bootstrap/js/jquery.validate.js"></script>
    <script src="bootstrap/js/prettify.js"></script>
    <script src="bootstrap/js/jquery.bsAlerts.js"></script>
    <script src="bootstrap/js/bootstrap-confirmation.js"></script>
    <script src="bootstrap/js/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="bootstrap/js/bootstrap-datepicker.pt-BR.min.js" type="text/javascript"></script>
    <script src="public/js/login.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>

</head>


<body style="background-color: #c3c3c3" >
<div class="container"  >
    <div class="row text-center ">
        <div class="col-md-12">
            <br /><br />
            <h2></h2>
            <img src="bootstrap/img/logo1.jpg" style="width: 200px; height: 200px">
            <h5></h5>
            <br />
        </div>
    </div>
    <div class="row ">

        <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>   Entre com seu login</strong>
                </div>
                <div class="panel-body">
                    <div data-alerts="alerts" data-fade="3000"></div>
                    <form role="form" action="autenticacao.php" method="POST" id="formLogin">
                        <br />
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
                            <input type="text" id="login" name="login" class="form-control" placeholder="LOGIN" />
                        </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                            <input type="password" class="form-control"  placeholder="SENHA" id="senha" name="senha"/>
                        </div>
                        <div class="form-group">
                            <label class="checkbox-inline">
                                <input type="checkbox" />   Lembrar senha.
                            </label>
<!--                                            <span class="pull-right">-->
<!--                                                   <a href="#" >Esqueceu a senha? </a>-->
<!--                                            </span>-->
                        </div>

                        <button class="btn btn-primary btn-lg" type="button"  id="entrar" ><span class="glyphicon glyphicon-arrow-right"></span> Entrar</button>
                        <hr />
                        <!--                                    Not register ? <a href="registeration.php" >click here </a>-->
                    </form>
                </div>

            </div>
        </div>


    </div>
</div>
</body>
