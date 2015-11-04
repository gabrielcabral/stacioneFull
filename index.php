<script src="bootstrap/js/bootstrap.min.js" ></script>
<link rel="stylesheet" href="bootstrap/css/bootstrap.css" />
<link rel="stylesheet" href="bootstrap/css/font-awesome.min.css" />

<div class="container">
    <div class="row text-center ">
        <div class="col-md-12">
            <br /><br />
            <h2></h2>
            <img src="bootstrap/img/logo.JPG" style="width: 200px; height: 200px">
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
                    <form role="form" action="autenticacao.php" method="POST">
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

                        <button class="btn btn-primary btn-lg" type="submit" id="login" ><span class="glyphicon glyphicon-arrow-right"></span> Entrar</button>
                        <hr />
                        <!--                                    Not register ? <a href="registeration.php" >click here </a>-->
                    </form>
                </div>

            </div>
        </div>


    </div>
</div>

