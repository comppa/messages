
@extends('app')

@section('content')
<div class="container" style="height: auto;">
  <div class="row justify-content-center">
    <div class="row">
    <div class="col-md-12">
    <div class="card">
        <div class="card-header card-header-primary">
            <h4 class="card-title "> Enviar Link: </h4>
            <p class="card-category"> </p>
        </div>
        <div class="card-body">
            <div class="row">
            </div>
          <form action="" method="post" action="{{ route('message.send_link') }}">

              <!-- CROSS Site Request Forgery Protection -->
              @csrf
            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label>Titulo: </label>
                        <input class="form-control" type="text" name="title" id="">

                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label>Desprición: </label>
                        <input class="form-control" type="text" name="description" id="">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label>image: </label>
                        <input class="form-control" type="text" name="url_thumb" id="">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label>Url: </label>
                        <textarea rows="4" cols="54" class="form-control" name="url" id=""></textarea>

                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <div class="form-group">
                    <br>
                        <input type="submit" name="send" value="Enviar A Whatsapp" class="btn btn-success btn-block">
                    </div>
                </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
