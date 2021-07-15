    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url('/awards') }}?membershipid={{$membershipid}}">Awards</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                <ul class="nav navbar-nav">
                    @for ($i=2; $i<=$stage; $i++)
                        <li class='dropdown'>
                            <a href="{{url('/awards?userStage='.$i)}}&membershipid={{$membershipid}}">Stage {{ $i }}</a>
                        </li>
                    @endfor
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="javascript: history.go(-1)">Go Back</a>
                    </li>

                </ul>

            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>